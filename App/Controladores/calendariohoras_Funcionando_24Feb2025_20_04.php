<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario con FullCalendar</title>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <!-- Bootstrap CSS (para la ventana modal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .fc-timegrid-slot[data-time="17:00:00"],
        .fc-timegrid-slot[data-time="17:30:00"],
        .fc-timegrid-slot[data-time="18:00:00"],
        .fc-timegrid-slot[data-time="18:30:00"] {
            background-color: #d3d3d3 !important; /* Fondo gris */
            pointer-events: none; /* No permite selección */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div id="calendar"></div>
	<div id="error-message" style="
		display: none; 
		position: fixed; 
		top: 10px; 
		right: 10px; 
		background-color: #dc3545; 
		color: white; 
		padding: 10px 20px; 
		border-radius: 5px; 
		font-size: 14px;
		z-index: 1000;">
		Error: No puedes seleccionar fuera del horario permitido.
	</div>
</div>

<!-- Modal para Capturar Datos -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Nuevo Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <input type="hidden" id="start">
                    <input type="hidden" id="end">

                    <div class="mb-3">
                        <label for="cedula" class="form-label">Nro. Cédula</label>
                        <input type="text" class="form-control" id="cedula" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celular" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Título del Evento</label>
                        <input type="text" class="form-control" id="title" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Evento</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (para la ventana modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- FullCalendar Script -->
<!-- Contenedor del mensaje de error -->

<script>
document.addEventListener("DOMContentLoaded", function () {
var calendarEl = document.getElementById("calendar");
var alertShown = false; // Bandera para evitar múltiples alertas

// Definir horarios permitidos por día
var horariosPermitidos = {
    weekdaysMorning: { start: "11:00", end: "16:59" }, // Lunes a Viernes - Mañana
    weekdaysEvening: { start: "19:00", end: "23:59" }, // Lunes a Viernes - Tarde
    weekEndMorning: { start: "11:00", end: "16:59" },  // Sabados y Domingos - Mañana
    weekEndEvening: { start: "19:00", end: "23:59" }, // Sabados y Domingos - Tarde
};

// Detectar el día actual y establecer los slots correctos
var today = new Date().getDay(); // 0 = Domingo, 1 = Lunes, ..., 6 = Sábado

var slotMinTime, slotMaxTime;

if (today >= 1 && today <= 5) { // Lunes a Viernes
    slotMinTime = horariosPermitidos.weekdaysMorning.start;
    slotMaxTime = horariosPermitidos.weekdaysEvening.end;
} else { // Sábado y Domingo
    slotMinTime = horariosPermitidos.weekEndMorning.start;
    slotMaxTime = horariosPermitidos.weekEndEvening.end;
}

var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "timeGridWeek",
	slotDuration: "01:00:00", // Intervalos de 1 hora en la vista
    slotMinTime: slotMinTime,  // Hora mínima en la vista
    slotMaxTime: slotMaxTime,  // Hora máxima en la vista
    locale: 'es', // Para idioma español
    timeZone: 'local', // Asegura que respete la zona horaria
    slotLabelFormat: { // Formato de horas en la columna de horarios
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    },
    slotMinTime: "11:00:00", // Inicio del horario permitido
    slotMaxTime: "23:59:59", // Fin del horario permitido
    // -----------------------------------------------------------------------
    selectAllow: function(selectInfo) {
            let startHour = selectInfo.start.getHours();
            return startHour !== 18; // Bloquea la selección en la hora 18:00
        },
    // -----------------------------------------------------------------------
    eventTimeFormat: { // Formato de horas en los eventos
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    },
    events: [
        {
            title: "Horario Mañana",
            start: "2025-02-22T11:00:00",
            end: "2025-02-22T17:00:00",
            color: "#28a745" // Verde
        },
        {
            title: "Horario Tarde",
            start: "2025-02-22T19:00:00",
            end: "2025-02-22T23:59:59",
            color: "#4FC3F7" // Celeste Pastel
        }
    ],
    selectable: true,
  businessHours: [
        { // Horario Mañana (Lunes a Viernes)
            daysOfWeek: [1, 2, 3, 4, 5], 
            startTime: "11:00",
            endTime: "16:59"
        },
        { // Horario Tarde (Lunes a Viernes)
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: "19:00",
            endTime: "23:59"
        },
        { // Horario Mañana (Sábados y Domingos)
            daysOfWeek: [0, 6],
            startTime: "11:00",
            endTime: "16:59"
        },
        { // Horario Mañana (Sábados y Domingos)
            daysOfWeek: [0, 6],
            startTime: "19:00",
            endTime: "23:59"
        }
    ],
    selectAllow: function(selectInfo) {
        let start = selectInfo.start;
        let day = start.getDay(); // 0 = Domingo, 1 = Lunes, ..., 6 = Sábado
        let hour = start.getHours();

        // Definir los rangos permitidos
        let isWeekdayMorning = (day >= 1 && day <= 5) && (hour >= 11 && hour < 17);
        let isWeekdayEvening = (day >= 1 && day <= 5) && (hour >= 19 && hour < 24);
        let isWeekendMorning = (day === 0 || day === 6) && (hour >= 11 && hour < 17);
		let isWeekendEvening = (day === 0 || day === 6) && (hour >= 19 && hour < 24);

		//isWeekend) {
        if (isWeekdayMorning || isWeekdayEvening || isWeekendMorning || isWeekendEvening) {
            alertShown = false; // Resetear la bandera si la selección es válida
            return true; // Permite la selección
        } else {
		    mostrarError("Error: No puedes seleccionar fuera del horario permitido.");
            return false; // Bloquea la selección
        }
    },
    select: function(info) {
        // Llenar los campos ocultos con la fecha y hora seleccionada
        document.getElementById("start").value = info.startStr;
        document.getElementById("end").value = info.endStr;

        // Mostrar la ventana modal
        var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
        myModal.show();
    }
});
calendar.render();

    // Capturar datos del formulario y enviarlos a la base de datos
    document.getElementById("eventForm").addEventListener("submit", function(e) {
        e.preventDefault();

        var cedula = document.getElementById("cedula").value;
        var nombre = document.getElementById("nombre").value;
        var celular = document.getElementById("celular").value;
        var title = document.getElementById("title").value;
        var start = document.getElementById("start").value;
        var end = document.getElementById("end").value;
        let fecha;
        var inicio;
        var fin;
        if (start) {
                    // Separar fecha y hora
                    var partes = start.split("T");
                    var fecha2 = partes[0]; // YYYY-MM-DD
                    var tiempo = partes[1].split(":"); // HH:MM
                    var horas = parseInt(tiempo[0], 10);
                    var minutos = parseInt(tiempo[1], 10);

                    // Evaluar si la hora está en el rango 11 a 18
                    if (horas >= 11 && horas <= 18) {
                         // Formatear la nueva fecha y hora
                        fecha = new Date(start);
                        // Establecer la hora de inicio a las 11:00
                        fecha.setHours(11, 0, 0, 0);
                        let inicioN = new Date(fecha);
                        inicio = convertirFecha(inicioN);
                        console.log('Matutino Fecha inicio: ', fin);

                        // Establecer la hora de fin a las 17:00
                        fecha.setHours(16, 59, 0, 0);
                        let finN = new Date(fecha);
                        fin  = convertirFecha(finN);
                        console.log('Matutino Fecha fin: ', fin);

                    }else{
                         // Formatear la nueva fecha y hora
                        fecha = new Date(start);
                        // Establecer la hora de inicio a las 11:00
                        fecha.setHours(19, 0, 0, 0);
                        let inicioN = new Date(fecha);
                        inicio = convertirFecha(inicioN);
                        console.log('Nocturno Fecha inicio: ', fin);

                        // Establecer la hora de fin a las 17:00
                        fecha.setHours(23, 59, 0, 0);
                        let finN = new Date(fecha);
                        fin  = convertirFecha(finN);
                        console.log('Nocturno Fecha fin: ', fin);

                    }
        }
		console.log('Cedula:',  cedula);
		console.log('Start: ',  start);
		console.log('End:   ',  end);
        console.log('Fecha inicio corregida :',  inicio);
        console.log('Fecha fin corregida :',  fin);
		// Enviar datos al backend (AJAX con fetch)
		fetch("guardar_evento.php", {
			method: "POST",
			headers: { "Content-Type": "application/x-www-form-urlencoded" },
			body: `cedula=${encodeURIComponent(cedula)}&nombre=${encodeURIComponent(nombre)}&celular=${encodeURIComponent(celular)}&title=${encodeURIComponent(title)}&start=${encodeURIComponent(inicio)}&end=${encodeURIComponent(fin)}`
		})
		.then(response => {
			if (!response.ok) {
				throw new Error(`Error HTTP: ${response.status}`);
			}
			return response.text();  // Obtener la respuesta como texto
		})
		.then(data => {
			console.log("Respuesta del servidor:", data);  // Ver en consola
			if (data.trim() === "ok") {
                start = inicio;
                end = fin;
				calendar.addEvent({ cedula, celular, title, start, end });
				var modal = bootstrap.Modal.getInstance(document.getElementById("eventModal"));
				modal.hide();
			} else {
				console.log('Respueta recibida desde guardar_evento.php : ',data);
				alert("Error al guardar el evento: " + data);
			}
		})
		.catch(error => console.error("Error en fetch:", error));
	});
});

function convertirFecha(fechaStr) {
    let fecha = new Date(fechaStr);

    // Obtener el desfase horario en minutos y convertirlo a formato ±HH:MM
    let offset = -fecha.getTimezoneOffset();
    let sign = offset >= 0 ? "+" : "-";
    let horasOffset = String(Math.floor(Math.abs(offset) / 60)).padStart(2, '0');
    let minutosOffset = String(Math.abs(offset) % 60).padStart(2, '0');
    let zonaHoraria = `${sign}${horasOffset}:${minutosOffset}`;

    // Formatear la fecha en YYYY-MM-DDTHH:mm:ss±HH:MM
    let fechaISO = fecha.getFullYear() + "-" +
                   String(fecha.getMonth() + 1).padStart(2, '0') + "-" +
                   String(fecha.getDate()).padStart(2, '0') + "T" +
                   String(fecha.getHours()).padStart(2, '0') + ":" +
                   String(fecha.getMinutes()).padStart(2, '0') + ":" +
                   String(fecha.getSeconds()).padStart(2, '0') + 
                   zonaHoraria;

    return fechaISO;
}
</script>

</body>
</html>
