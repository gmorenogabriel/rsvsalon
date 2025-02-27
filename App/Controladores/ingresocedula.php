<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de Cedula de Identidad</title>
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
    

<!-- Solo Cedula  -->
<!-- Modal para Capturar Datos -->
<div class="modal fade" id="eventCedula" tabindex="-1" aria-labelledby="eventModalCedula" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalCedula">Ingreso de Cedula de Identidad</h5>
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
                    <button type="submit" class="btn btn-primary">Buscar Cedula</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Segundo Modal cargando Mas campos -->
<!-- Modal para Capturar Datos -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Verificar datos del Usuario</h5>
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
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="telefono" required>
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

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Mostrar la ventana modal
    let myModal = new bootstrap.Modal(document.getElementById("eventCedula"));
    myModal.show();

    // Agregar un listener al formulario para capturar la cédula y hacer el fetch
    document.getElementById('eventForm').addEventListener('submit', function(event) {
        // Prevenir el envío predeterminado del formulario (recarga de página)
        event.preventDefault();
        
        // Obtener el valor de la cédula del input
        var cedula = document.getElementById('cedula').value;

        // Realizar la solicitud fetch
        fetch('verificar_cedula.php', {
            method: 'POST',
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `cedula=${encodeURIComponent(cedula)}`
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            return response.json();  // Parsear la respuesta como JSON
        })
        .then(data => {
            // Mostrar el segundo modal con los datos recibidos
            let eventModal = new bootstrap.Modal(document.getElementById("eventModal"));
            eventModal.show();

            // Llenar los campos del segundo modal con los datos
            document.querySelector('#eventModal #cedula').value = data.cedula; // esto es porque hay dos id=cedula
            //document.getElementById('cedula').value = data.cedula;  // Asumiendo que el backend devuelve 'cedula'
            document.getElementById('nombre').value = data.nombre;
            document.getElementById('telefono').value = data.telefono;
            document.getElementById('title').value = data.title;  // Asumiendo que el backend devuelve 'title'
        })
        .catch(error => console.error('Error en fetch:', error));
    });
});
</script>

</body>
</html>