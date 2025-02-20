<?php
	/*
		Events Model
	
	*/
header('Content-Type: application/json');
include('../conexion/dbConfig.php');

$ruta='../../writeable/rsvsalon.log';
error_log('events.php' . " - Linea 10" . "\n", 3, $ruta);

$consulta="SELECT id, ci, rol_usuario FROM events";
error_log('events.php - ' . $consulta . "\n", 3, $ruta);
$query=mysqli_query($db, "SELECT id, ci, rol_usuario, estado FROM events ");

error_log('events.php' . " - Linea 16 - " . $query . " \n", 3, $ruta);
$array=array();

while($arr=mysqli_fetch_array($query)){
    $array[]=$arr;
}
error_log('events.php' . " - Linea 22 - " . print_r($query) . " \n", 3, $ruta);
echo json_encode($array);
$query->close();
?>