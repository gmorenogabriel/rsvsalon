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
 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='../../node_modules/fullcalendar/main.css' rel='stylesheet' />
    <script src='../../node_modules/fullcalendar/main.js'></script>
    <script src='../../node_modules/fullcalendar/locales/es.js'></script>
    <script src="https://kit.fontawesome.com/0273d57df4.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   
    <link rel="stylesheet" href="../../public/css/agendar.css">
    <script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>


</head>
<body>
<header>
<h2 class="titulo">CENTRO DE SALUD ABC</a>
</header>

<div class="navBar" id="navBar">
    <ul class="opcinesNav">
        <li class="nav-item"> 
        <a href="index.php" class="nav-link"><i class="icono fa fa-house"></i>
        Inicio
        </a>
        </li>
        <li class="nav-item"> 
        <a href="#" class="nav-link"><i class="icono fa fa-house"></i>
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

<div class="titulo">
<h2> <Strong> Cancela tus citas</Strong></h2>
</div>


<div id="CalendarioWeb" class="CalendarioWeb"></div>


<!-- Modal -->
<div class="modal fade" id="informacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Datos de la Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
        <div class="modal-body">
        <div class="container-fluid">
        Cita:
        <div id="titulo"></div>
        Inicio:
        <div id="fechaI"></div>
        Fin:
        <div id="fechaF"></div>
        <input type="button" id="Eliminar" class="btn btn-warning" Value="Eliminar">
        </div>
        </div>
    </div>
</div>
</div>
    <div class="resultado" id="resultado" ></div>


<script src='../../public/js/cancelar.js'></script>
</body>
</html>