<?php

include('../conexion/dbConfig.php');
include('../conexion/seguridad.php');

$cedula=$_SESSION["cedula"];
$id_especialidad=htmlspecialchars($_POST['esp']);
$id_medico=htmlspecialchars($_POST['med']);
$fechainicio=htmlspecialchars($_POST['fecha']);
$horainicio=$_POST['hora'].":00:00";
$horafinal=htmlspecialchars(intval($_POST['hora'])+1);
$horafin=$horafinal.":00:00";

$fechainicial=$fechainicio." ".$horainicio;
$fechafinal=$fechainicio." ".$horafin;

$i=0;

$consultafecha="SELECT fecha_inicio,id_me FROM cita where fecha_inicio='$fechainicial' and id_me='$id_medico'";
$queryfecha=mysqli_query($conn,$consultafecha);

while($row=mysqli_fetch_array($queryfecha)){
    $i++;
}

if($i>0){
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oopss...',
        text: 'El Doctor esta ocupada en esa hora y fecha'
      });</script> ";
}else{
 
$consultaid="SELECT id_paciente FROM paciente where cedula='$cedula'";
$querycedula=mysqli_query($conn,$consultaid);
$ced='';
while($raw=mysqli_fetch_array($querycedula)){
    $ced=$raw['id_paciente'];
}

$ingresarCita="INSERT into cita (id_me,fecha_inicio,id_paciente,fecha_fin) values($id_medico,'$fechainicial',$ced,'$fechafinal')";
$query=mysqli_query($conn,$ingresarCita);

if($query){
    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Exito',
        text: 'fechaguardada'
      }); 
      $('#modalCita').modal('hide');</script> ";
}else{
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Error en el servidor'
      })</script>";
}
   
}

?>