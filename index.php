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
    <script src="node_modules/sweetalertw/dist/sweetalert2.js"></script>
    <script src="public/js/ValidarUsuario.js"></script>
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 
    <?php 
    include('App/conexion/dbConfig.php'); 
    ?>
 
</head>
<body>
<img src="./public/img/hospital.jpg" >
<div class="form-login-cabecera">
<form class='form' action="">
    <h2 class="form-header">Login</h2>
    <div class="form-login">
<?php
	$ruta='./writeable/rsvsalon.log';
	error_log('inicio.php' . " - linea 37 \n", 3, $ruta);
?>
        <label for="">Cedula</label>
        <input type="text" id='cedula' placeholder="ingresa tu cedula" autofocus>
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
 		<label for="cedula">Cedula</label>
		<input type="text" placeholder="Ingresa tu cedula" name="ced" id="ced" required />

		<label for="nombre">Nombre</label>
		<input type="text" placeholder="Ingresa tu nombre completo" name="usuario" id="usuario" required />

		<label for="correo">Correo</label>
		<input type="text" placeholder="Ingresa tu correo" name="correo" id="correo" required />


		<label for="telefono">Telefono</label>
		<input type="text" placeholder="Ingresa tu teléfono" name="telefono" id="telefono" required />
	  <br/>    

      <input class='btn btn-success' type="submit" id="registrar" value='registrar'>
                </div>
            </div>
        </div>
    </div>

	
<script>
$(document).ready(function(){
    
	var modal2=document.getElementById('modelId');
	
    $('#cedula').on("change",function(){
		alert('se modifica cedula funcion para comprobarcedulaNew');
        let cedula=$(this).val();
       alert('Cedula: ' + cedula);
        if(!(/^\d{10}$/.test(cedula))){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Cedula deben ser 10 digitos',
				timer: 3000
              });
        }else{
			alert('disparo el ajax de comprobardcedulaNew');
            $.ajax({
                url:"./App/Controladores/comprobarcedulaNew.php",
                type:"POST",
                data:{ cedula:cedula},
                success:function(respuesta){
                    console.log('Respuesta: ' + respuesta);
                    document.getElementById('resultado').innerHTML = respuesta;
					alert('Respuesta: ' + respuesta);
                    if (respuesta === "EXISTE")                         
						window.location.assign("http://localhost:8084/rsvsalon/solicitudReserva1.php");
                    } else {
						//console.log('Mostrando el modal para solicitar más datos.');
						alert('Voy a llamar al modelId: ' + respuesta);
						var myModal = new bootstrap.Modal(document.getElementById('modelId'));
						myModal.show();
                        $('#modelId').modal('show');
						alert('Dsps llamada al modelId: ' + respuesta);
                    }
                },
                // error: function(err) {
                    // console.error('Error en la solicitud AJAX:', err);
					// }
				error:function(err,msg){
					alert(msg);	
					}
				})
			}
		})
});

/*
$(document).ready(function () {
    // Muestra el modal
    $('#modelId').modal('show');
});
*/
</script>

</body>
</html>