<?php
header('Content-Type: application/json');
include('../conexion/dbConfig.php');


$ruta='../../writeable/rsvsalon.log';
error_log('tipoSangre.php' . " - Linea 7" . "\n", 3, $config['ruta']);

$consulta="SELECT id_tipo,tipo_sangre FROM sangre ";
error_log('tipoSangre.php - ' . $consulta . "\n", 3, $config['ruta']);
$query=mysqli_query($db, "SELECT id_tipo,tipo_sangre FROM sangre ");

error_log('tipoSangre.php' . " - Linea 13 - " . $query . " \n", 3, $config['ruta']);
$array=array();

while($arr=mysqli_fetch_array($query)){
    $array[]=$arr;
}
error_log('tipoSangre.php' . " - Linea 19 - " . print_r($query) . " \n", 3, $config['ruta']);
echo json_encode($array);
?>