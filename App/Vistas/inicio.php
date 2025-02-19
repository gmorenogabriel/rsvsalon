
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/estilo.css">
    <title>Document</title>
    <?php 
    include('../conexion/dbConfig.php');
    include('../conexion/seguridad.php');
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
 
    <script src="https://kit.fontawesome.com/0273d57df4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   
</head>
<body >
<header>
<h2 class="titulo">CENTRO DE SALUD ABC</a>
</header>

<div class="navBar" id="navBar">
    <ul class="opcinesNav">
        <li class="nav-item"> 
        <a href="" class="nav-link"><i class="icono fa fa-house"></i>
        Inicio
        </a>
    </li>
        <li class="nav-item"> 
        <a href="" class="nav-link"><i class="icono fa fa-house"></i>
        Nosotros
        </li></a>
        <li class="nav-item"> 
        <a href="../Controladores/cerrar.php" class="nav-link"><i class="icono fa fa-power-off"></i>
        Cerrar Sesion
        </li></a>
    </ul>
  
</div>

<div class="vista"> 
<h5><strong>Paciente:</strong> <?php echo $_SESSION['paciente']; ?></h5>
<h5><strong>Cedula:</strong> <?php echo $_SESSION['cedula']; ?></h5>
</div>

<div class="section-2">
<button id="agendar" class="btn btn-warning">Agendar Cita</button>
<button id="cancelar" class="btn btn-primary">Cancelar Cita</button>
</div>

<script>
    
    $(document).ready(function(){
        $("#agendar").on("click",function(){
            window.location.href='agendar.php';
        });
    });
    $(document).ready(function(){
        $("#cancelar").on("click",function(){
            window.location.href='cancelar.php';
        });
    });

</script>

</body>

</html>

