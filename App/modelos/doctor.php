<?php
include('../conexion/dbConfig.php');

$medico=htmlspecialchars($_POST['medico']);
$consulta="SELECT me.id_medico,m.nombre 
FROM medico_especialidad me 
join especialidad e on e.id_especialidad=me.id_especialidad 
join medico m on m.id_medico=me.id_medico 
where me.id_especialidad='$medico'";

$query=mysqli_query($db,$consulta);
$cadena="<label>Médico</label>
<select id='med' name='med'>
<option selected='true' disabled>Escoge el doctor</option>";
while($arr=mysqli_fetch_array($query)){
    $cadena=$cadena.'<option value='.$arr[0].'>'.utf8_encode($arr[1]).'</option>';
}
echo $cadena."</select>";
?>