<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Información sobre el Salón</title>
	<style>
        .custom-list li{
            list-style-position: inside; /* Hace que los puntos estén dentro del contenido */
            padding-left: 40px; /* Ajusta el espaciado */
        }
	</style>	
   <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
	
	<link href="../css/datatables.min.css" rel="stylesheet" >
	<link href="../public/assets/fontawesome/css/all.min.css" rel="stylesheet" >
	<link href="../public/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet" >
	</head>
	<body>
		<div id="layoutSidenav_content" style=" height: 150px;"> 
			<main>
				<div class="container-fluid">
				<br/>
          <div class="row">			  
	<div class="col-12">
<!--		<div class="card bg-info text-white mb-4"> -->
		<div class="card bg-primary text-white mb-4">

		    <h3 class="text-center"><div class="card-body fs-5">Solicitud Reserva:</div></h3> 
			<!-- <div class="card-footer d-flex align-items-center justify-content-between">  
				 <a class="small text-black stretched-link" href='configuraciones/configMediodia.php'> Ver Detalles</a> 
				<div class="small text-white"><i class="fas fa-angle-right"></i></div>
					-->
			<h4 class="fs-5">Consideraciones:</h4>
				<div class="custom-list fs-6">
					<li>El horario disponible al Mediodía corresponde desde las 11:00 a las 17:59.</li>
					<li>La cantidad máxima de personas en el Salón es de 20 personas.</li>
					<li>El costo del Salón es de <strong>$U 2.500,00</strong></li>
				</div>
				<br/>
			<h5 class="fs-5">3-Pasos a seguir para confirmar la reserva:</h5>				
			<br/>
			
				<ul class="custom-list">
				<p><i class="fas fa-check-circle"></i> 1-Luego de realizada la solicitud, tiene dos opciones para abonar la seña en:</p>
					   <li>Abitab - Cuenta 272348400</li>
					   <li>Transferencia Bancaria - Scotiabank, Cuenta 272348400, C.Ahorro $U Suc. 24.</li>
					</ul>
				
				<ul class="custom-list">
					<p><i class="fas fa-check-circle"></i> 2-Enviar por correo electrónico el comprobante resultante del pago al correo:</p>
					   <li>gmorenogabriel@gmail.com</li>
					   <li>Indicando Fecha de la Reserva</li>
					   <li>Cédula de Identidad</li>
					   <li>Nro.Apartamento</li>
					   <li>Nombre completo</li>
					   <li>Celular de contacto</li>
					</ul>		
				<ul class="custom-list">
					<p><i class="fas fa-check-circle"></i> 3-Una vez confirmado la recepción del pago, se responderá al correo recibido con la Confirmación de la Reserva</p>
            </div>
			

<div class="d-flex justify-content-between mt-3">
    <button class="btn btn-secondary" onclick="history.back();">
        <i class="fas fa-arrow-left"></i> Volver Atrás
    </button>

    
<!--	<a href="http://localhost:8084/codexworld/" class="btn btn-primary"> -->
    <a href="../App/Controladores/calendario.php" class="btn btn-primary">
		<i class="fas fa-calendar-check"></i> Reservar
    </a>
</div>



</body>
</html>
	