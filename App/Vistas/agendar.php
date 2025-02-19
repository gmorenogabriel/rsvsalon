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
    <script src='../../public/js/agendar.js'></script>
    <link rel="stylesheet" href="../../public/css/agendar.css">
   
</head>
<body >
 
<header>
<h2 class="titulo">CENTRO DE SALUD ABC</a>
</header>

<div class="navBar" id="navBar">
    <ul class="opcinesNav">
        <li class="nav-item"> 
        <a href="inicio.php" class="nav-link"><i class="icono fa fa-house"></i>
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

<div class="section-2">
<h2>AGENDA TU CITA</h2>
<label for=""> Especialidad</label>
    <select name="especialidad" id="especialidad"> </select>
    <br><br>
    <div name="doctor" id="doctor"> </div>
</div>

<div class="mostrarfecha" id="mostrarfecha">
<button id='fecha_s' class='btn btn-secondary fecha_s'>Seleccionar Fecha </button>
</div>

<div id="Web" class="Web"></div>

<!-- Modal -->
<div class="modal fade" id="modalCita" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Fecha de Cita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
    <div class="modal-body">
     <div class="container-fluid">
      <label ><b> Especialidad</b></label>
      <input type="text" readonly name="espec" id="espec">
      <label ><b> Medico </b></label>
      <input type="text" readonly name="medi" id="medi">
      <label><b>Fecha Escogida</b></label>
     <input type="text" readonly name='inicio' id='inicio'>
     <label><b>Coloca la Hora</b></label>
     <input type="text" placeholder='Ejemplo: 05 o 15 ' minlength='1' maxlength='2' name='hora' id='hora'>
      <input class='btn btn-success' type="submit" id="registrar" value='registrar'>
                </div>
            </div>
        </div>
        </div>
        </div>


    <div class="resultado" id="resultado" ></div>

    
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
        
        </div>
        </div>
    </div>
</div>
</div>

<script>
   
   var fecha=new Date();
    var actual=(fecha.getFullYear()+"-"+(fecha.getMonth()+1)+"-"+(fecha.getDate()));
   
    var calendarEl = document.getElementById('Web');
     var inf=document.getElementById('titulo');
     var FechaInicio=document.getElementById('fechaI');
     var FechaFin=document.getElementById('fechaF');

    $("#fecha_s").on("click",function(){
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale:'es',
          dateClick: function(info) {

          if(Date.parse(info.dateStr)<Date.parse(actual) || Date.parse(info.dateStr)===Date.parse(actual)){
            Swal.fire({
                icon:"error",
                title:"Oopss!",
                text:"La fecha no puede ser menor o igual a la actual"
            });
          }else{
           $('#modalCita').modal('show');
           $('#medi').val($('#med').val());
           $('#espec').val($('#especialidad').val());
           $('#inicio').val(info.dateStr);
        }
        },eventClick:function(info){
            $("#informacion").modal('show');
            inf.innerHTML=info.event.title;
            FechaInicio.innerHTML=info.event.start;
            FechaFin.innerHTML=info.event.end;
        },
          events:'../modelos/citas.php'
        });
        calendar.render();
      });
    

</script>
</body>
</html>