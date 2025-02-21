<!DOCTYPE html>
<html lang="en-US">
<head>
<title>PHP Event Calendar with FullCalendar JS Library</title>
<meta charset="utf-8">

<!-- Custom stylesheet -->
<link href="../../css/style.css" rel="stylesheet" />

<!-- Sweetalert2 -->
<script src="../../js/sweetalert2.all.min.js"></script>

<!-- Include FullCalendar JS & CSS library -->
<link href="../../js/fullcalendar/lib/main.css" rel="stylesheet" />
<script src="../../js/fullcalendar/lib/main.js"></script>
<!--
		validRange: {
		start: new Date() // Restringe las fechas anteriores a hoy
	}
		selectAllow: function(selectInfo) {
		return selectInfo.start >= new Date(); // Evita seleccionar fechas pasadas
	}	

-->
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

		var calendarEl = document.getElementById('calendar');
		var today = new Date();
		today.setHours(0, 0, 0, 0); // Asegurar que la comparación sea solo de fechas


  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 650,
    events: 'fetchEvents.php',
    
    selectable: true,
		selectAllow: function(selectInfo) {
			return selectInfo.start >= new Date(); // Evita seleccionar fechas pasadas
		},

		dayCellDidMount: function(info) {
		var cellDate = new Date(info.date);
		cellDate.setHours(0, 0, 0, 0); // Normalizar

			if (cellDate < today) {
				info.el.style.backgroundColor = "#f8d7da"; // Color rojo claro
				info.el.style.opacity = "0.5"; // Reducir opacidad
			}
		},
    select: async function (start, end, allDay) {
      const { value: formValues } = await Swal.fire({
        title: 'Add Event',
        confirmButtonText: 'Submit',
        showCloseButton: true,
		    showCancelButton: true,
        html:
          '<input id="swalEvtTitle" class="swal2-input" placeholder="Enter title">' +
          '<textarea id="swalEvtDesc" class="swal2-input" placeholder="Enter description"></textarea>' +
          '<input id="swalEvtURL" class="swal2-input" placeholder="Enter URL">',
        focusConfirm: false,
        preConfirm: () => {
          return [
            document.getElementById('swalEvtTitle').value,
            document.getElementById('swalEvtDesc').value,
            document.getElementById('swalEvtURL').value
          ]
        }
      });

      if (formValues) {
        // Add event
        fetch("eventHandler.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ request_type:'addEvent', start:start.startStr, end:start.endStr, event_data: formValues}),
        })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            Swal.fire('Event added successfully!', '', 'success');
          } else {
            Swal.fire(data.error, '', 'error');
          }

          // Refetch events from all sources and rerender
          calendar.refetchEvents();
        })
        .catch(console.error);
      }
    },

    eventClick: function(info) {
      info.jsEvent.preventDefault();
      
      // change the border color
      info.el.style.borderColor = 'red';
      
      Swal.fire({
        title: info.event.title,
        //text: info.event.extendedProps.description,
        icon: 'info',
        html:'<p>'+info.event.extendedProps.description+'</p><a href="'+info.event.url+'">Visit event page</a>',
        showCloseButton: true,
        showCancelButton: true,
        showDenyButton: true,
        cancelButtonText: 'Close',
        confirmButtonText: 'Delete',
        denyButtonText: 'Edit',
      }).then((result) => {
        if (result.isConfirmed) {
          // Delete event
          fetch("eventHandler.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ request_type:'deleteEvent', event_id: info.event.id}),
          })
          .then(response => response.json())
          .then(data => {
            if (data.status == 1) {
              Swal.fire('Event deleted successfully!', '', 'success');
            } else {
              Swal.fire(data.error, '', 'error');
            }

            // Refetch events from all sources and rerender
            calendar.refetchEvents();
          })
          .catch(console.error);
        } else if (result.isDenied) {
          // Edit and update event
          Swal.fire({
            title: 'Edit Event',
            html:
              '<input id="swalEvtTitle_edit" class="swal2-input" placeholder="Enter title" value="'+info.event.title+'">' +
              '<textarea id="swalEvtDesc_edit" class="swal2-input" placeholder="Enter description">'+info.event.extendedProps.description+'</textarea>' +
              '<input id="swalEvtURL_edit" class="swal2-input" placeholder="Enter URL" value="'+info.event.url+'">',
            focusConfirm: false,
            confirmButtonText: 'Submit',
            preConfirm: () => {
            return [
              document.getElementById('swalEvtTitle_edit').value,
              document.getElementById('swalEvtDesc_edit').value,
              document.getElementById('swalEvtURL_edit').value
            ]
            }
          }).then((result) => {
            if (result.value) {
              // Edit event
              fetch("eventHandler.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ request_type:'editEvent', start:info.event.startStr, end:info.event.endStr, event_id: info.event.id, event_data: result.value})
              })
              .then(response => response.json())
              .then(data => {
                if (data.status == 1) {
                  Swal.fire('Event updated successfully!', '', 'success');
                } else {
                  Swal.fire(data.error, '', 'error');
                }

                // Refetch events from all sources and rerender
                calendar.refetchEvents();
              })
              .catch(console.error);
            }
          });
        } else {
          Swal.close();
        }
      });
    }
  });

  calendar.render();
});
</script>

</head>
<body>
<div class="container">
  <div class="wrapper">

    <!-- Calendar container -->
    <div id="calendar"></div>
    
  </div>
</div>
</body>
</html>