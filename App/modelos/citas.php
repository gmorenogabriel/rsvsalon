<?php
include('../conexion/dbConfig.php');
include('../conexion/seguridad.php');

$cedula=$_SESSION['cedula'];

$consulta="SELECT es.nombre as especialidad,m.nombre as medico, c.id_cita,c.fecha_inicio,c.fecha_fin from cita c
join medico m on m.id_medico=c.id_me
join medico_especialidad me on me.id_medico=m.id_medico
join especialidad es on es.id_especialidad=me.id_especialidad
join paciente p on p.id_paciente=c.id_paciente
where p.cedula='$cedula'";

$query=mysqli_query($db,$consulta);
$array=array();

while($arr=mysqli_fetch_array($query)){
    $array[]=array(
        'id' => $arr['id_cita'],
        'title'=>$arr['especialidad'].' con '.$arr['medico'],
        'start'=>$arr['fecha_inicio'],
        'end'=>$arr['fecha_fin']
    );
}
echo json_encode($array);
?>

