<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
	
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="public/css/login.css">

<!-- jQuery (si es necesario) -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/0273d57df4.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Tu script personalizado -->
<script src="public/js/ValidarUsuario.js"></script>

<?php 
include('App/conexion/dbConfig.php'); 
?>
 
</head>
<body>
<img src="public/img/hospital.jpg" >
<div class="form-login-cabecera">
<form class='form' action="">
    <h2 class="form-header">Login</h2>
    <div class="form-login">
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
      <label ><b>Usuario</b></label>
      <input type="text" placeholder="Ingresa tu nombre completo" name="usuario" id="usuario" required>
      <label ><b>Cedula</b></label>
      <input type="text" placeholder="Ingresa tu cedula" name="ced" id="ced" required>
      <label><b>Tipo de Sangre</b></label>
      <select name="sangre" id="sangre">
      </select>
      <label ><b>Edad</b></label>
      <input type="number" placeholder="Ingresa tu Edad" name="edad" id="edad" required>
      <label ><b>Correo</b></label>
      <input type="text" placeholder="Ingresa tu correo" name="correo" id="correo" required>

      <input class='btn btn-success' type="submit" id="registrar" value='registrar'>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function () {
    // Muestra el modal
    $('#modelId').modal('show');
});
</script>
</body>
</html>