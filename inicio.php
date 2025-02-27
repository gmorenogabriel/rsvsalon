<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/login.css">

<?php 
	include('App/conexion/dbConfig.php'); 
    $config = include('App/conexion/rutaLog.php'); // Cargar configuración
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 
</head>
<body>
<img src="./public/img/hospital.jpg" >
<div class="form-login-cabecera">
<?php
	$config = include('App/conexion/rutaLog.php'); // Cargar configuración
	error_log($config['ahora'] . " - inicio.php" . " - linea 25 \n", 3, $config['ruta']);
?>
<!--
<form class='form' action="">
    <h2 class="form-header">Login</h2>
    <div class="form-login">

        <label for="cedula">Cedula</label>
        <input type="text" id='cedula' placeholder="ingresa tu cedula" autofocus>
    </div>

</form>
-->
</div>
<!--
<div id="resultado" class="resultado"></div>
<div id="resultado2" class="resultado2"></div>
-->
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
                <form id="eventFormCedula">
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
                <h5 class="modal-title" id="eventModalLabel">Verificar Datos del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <input type="hidden" id="start">
                    <input type="hidden" id="end">

                    <div class="mb-3">
                        <label for="cedula2" class="form-label">Nro. Cédula</label>
                        <input type="text" class="form-control" id="cedula2" required>
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
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
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
    var myModal = new bootstrap.Modal(document.getElementById("eventCedula"));
    myModal.show();

    // Agregar un listener al formulario para capturar la cédula y hacer el fetch
    //document.getElementById('eventForm').addEventListener('submit', function(event) {
    document.getElementById('eventFormCedula').addEventListener('submit', function(event) {

        // Prevenir el envío predeterminado del formulario (recarga de página)
        event.preventDefault();

        // Obtener el valor de la cédula del input
        //var cedula = document.getElementById('cedula').value;
        var cedula = document.querySelector('#eventCedula input[id="cedula"]').value;
        // Realizar la solicitud fetch
       // fetch('./App/Controladores/comprobarcedulaNew.php', {
        fetch('./App/Controladores/verificar_cedula.php', {
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

            if (data && !data.error) {
                console.log('estoy en el 1er MODAL');
                console.log('Respuesta del servidor:', data); // Depuración
                console.log('Valor de existe:', data.existe);
                console.log('Respuesta completa:', data);
                console.log('Cedula:', data.cedula);
                console.log('Nombre:', data.nombre);
                console.log('Telefono:', data.telefono);
                console.log('Email:', data.email);
            }
            if (!data || Object.keys(data).length === 0 || data.existe === false) {
             // Voy al Alta de Usuario
                // Si no existen datos o el backend devuelve "existe: false"
                window.location.href = "./App/Vistas/altaUsuario.php?cedula=" + encodeURIComponent(cedula);

            } else {
                myModal.hide();
                var eventModal = new bootstrap.Modal(document.getElementById("eventModal"), { keyboard: false });
                eventModal.show();

                setTimeout(() => {
                    //document.querySelector('#eventModal #cedula2').value = data.cedula;
                    document.getElementById('cedula2').value = cedula;
                    //document.getElementById('cedula').value = data.cedula;
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('telefono').value = data.telefono;
                    document.getElementById('email').value = data.email;
                }, 500);
            }
        })
        .catch(error => {
            console.error('Error en fetch:', error);
            alert("Hubo un error al procesar la solicitud. Intente nuevamente.");
        });
    });
    // -----------------------------------------------------------------------------------------------
    // Agregar un listener al formulario del segundo modal
    // -----------------------------------------------------------------------------------------------
     document.getElementById('eventModal').querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado del formulario (recarga de página)
         // Obtener el valor del primer modal
        let cedula = document.getElementById("cedula").value;

        // Pasar el valor al segundo modal
        document.getElementById("cedula2").value = cedula;

        // -----------------------------------------------------------------------------------------------
        console.log('1-Mando la cedula del primer modal: ', encodeURIComponent(cedula));
        window.location.href = "./App/Vistas/altaUsuario.php?cedula=" + encodeURIComponent(cedula);
        // -----------------------------------------------------------------------------------------------
        // Continuamos con el flujo de trabajo y pasamos a mostrar 
        // la Solicitud de Reserva
        // -----------------------------------------------------------------------------------------------
        window.location.href = "/rsvsalon/solicitudReserva1.php";
        // -----------------------------------------------------------------------------------------------
        // var cedula = document.querySelector('#eventCedula input[id="cedula"]').value;
      //  fetch('./App/Controladores/verificar_cedula.php', {
        fetch('./App/Controladores/verificar_cedula.php', {
            method: 'POST',
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `cedula=${encodeURIComponent(cedula2)}`
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            return response.json();  // Parsear la respuesta como JSON
        })
        .then(data => {
            console.log('estoy en el 2do MODAL');
            console.log('Respuesta del servidor:', data); // Depuración
            console.log('Valor de existe:', data.existe);
            console.log('Respuesta completa:', data);
            console.log('Cedula:', data.cedula);
            console.log('Nombre:', data.nombre);
            console.log('Telefono:', data.telefono);
            console.log('Email:', data.email);

            if (!data || Object.keys(data).length === 0 || data.existe === false) {
                // Voy al Alta de Usuario
                // Si no existen datos o el backend devuelve "existe: false"
                console.log('2-Voy a mandar la ceula del primer modal: ', encodeURIComponent(cedula));
                window.location.href = "./App/Vistas/altaUsuario.php?cedula=" + encodeURIComponent(cedula);

            }else{
                // Redirigir a solicitudReserva1.php después de enviar el formulario
                window.location.href = "/rsvsalon/solicitudReserva1.php";
            }
        });
    });
});
</script>

</body>
</html>