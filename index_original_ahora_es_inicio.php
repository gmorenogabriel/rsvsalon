<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/login.css">
    <script src="https://kit.fontawesome.com/0273d57df4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="public/js/ValidarUsuario.js"></script>
    <?php 
    include('App/conexion/dbConfig.php'); 
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 
</head>
<body>
<img src="public/img/hospital.jpg" >
<div class="form-login-cabecera">
<form class='form' action="">
    <h2 class="form-header">Login</h2>
    <div class="form-login">
<?php
	$ruta='./writeable/rsvsalon.log';
	error_log('index.php' . " - linea 32 \n", 3, $config['ruta']);
?>
        <label for="">Cedula</label>
        <input type="text" id='cedula' placeholder="ingresa tu cedula" >
    </div>
	
</form>
</div>

<div id="resultado" class="resultado"></div>
<div id="resultado2" class="resultado2"></div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Registro de Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
    <div class="modal-body">

     <div class="container-fluid">
      <label ><b>Cedula</b></label>
      <input type="text" placeholder="Ingresa tu cedula" name="ced" id="ced" required>
      <label ><b>Nombre</b></label>
      <input type="text" placeholder="Ingresa tu nombre completo" name="usuario" id="usuario" required>
	  <label ><b>Correo</b></label>
      <input type="text" placeholder="Ingresa tu correo" name="correo" id="correo" required>

<!--
		<label><b>Tipo de Sangre</b></label>
      <select name="sangre" id="sangre">
      </select>
-->
	  <label ><b>Nro. Teléfono</b></label>
      <input type="text" placeholder="Ingresa tu teléfono" name="telefono" id="telefono" required>
	  <br/>    
      <input class='btn btn-success' type="submit" id="registrar" value='registrar'>
                </div>
            </div>
        </div>
    </div>
	<script>
		$(document).ready(function(){
		  
			var modal2=document.getElementById('modelId');
			var ci=document.getElementById('ced');
				//let usuario='El Patito Feo';
				//let correo='El Correo';
			//console.log(ci, usuario, correo);
			
			// if( ced==null || usuario==null ){
					// Swal.fire({
						// icon: 'error',
						// title: 'Oops...',
						// text: 'Cedula deben ser 10 digitos',
						// timer: 3000, //Demora
						// showConfirmButton: true
					// });
				// }else{
					// Swal.fire({
						// icon: 'success',
						// title: 'Cedula ',
						// text: 'Cedula se cargo con exito',
						// timer: 3000, //Demora
						// showConfirmButton: true
					// });				
				// }
			$('#cedula').on("change",function(e){
				e.preventDefault();
				let cedula=$(this).val();
				let accion='MiAccion';
				let usuario='El Patito Feo';
				let correo='El Correo';
				console.log(cedula, "-", usuario, "-",  correo, "-",  accion);

				$.ajax({
						url:"./App/Controladores/leerUsuarios.php",
						type:"POST",
						data:{ ced:cedula, nombre:usuario, correo:correo, accion:accion},
						success:function(respuesta){
							console.log(respuesta);
							document.getElementById('resultado').innerHTML=respuesta;
							//alert(respuesta);
							// $("#resultado").html(respuesta);
							if(respuesta==="0"){ //no Existe el Usuario
							   $('#modelId').modal('show');
							}else{
									windows.localtion.href = "http://localhost:8084/rsvsalon/solicitudReserva1.php";
							}
						
						},
						error:function(err,msg){
							alert(msg);
						}
					})
			});
			// $('#cedula').on("change",function(){
				// var cedula=$(this).val();
			   
				// if(!(/^\d{10}$/.test(cedula))){
					// Swal.fire({
						// icon: 'error',
						// title: 'Oops...',
						// text: 'Cedula deben ser 10 digitos',
						// timer: 3000, //Demora
						// showConfirmButton: true
						
					  // });
				// }else{
					// $.ajax({
						// url:"./App/Controladores/comprobarcedula.php",
						// type:"POST",
						// data:{ cedula:cedula},
						// success:function(respuesta){
						   // $("#resultado").html(respuesta);
						// },
						// error:function(err,msg){
							// alert(msg);
						// }
					// })
				// }
		// })
		});
</script>
</body>
</html>



