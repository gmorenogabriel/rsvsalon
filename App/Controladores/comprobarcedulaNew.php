<?php
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");  // Permite todos los orígenes. Puedes especificar un origen específico si es necesario.
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  // Permite los métodos GET, POST y OPTIONS
header("Access-Control-Allow-Headers: Content-Type");  // Permite el encabezado Content-Type

// Si la solicitud es OPTIONS (preflight request), finaliza aquí
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

include('../conexion/dbConfig.php');
$cedula=htmlspecialchars($_POST["cedula"]);//recojemos lo seleccionado

$ruta='../../writeable/rsvsalon.log';
$ahora = date('Y-m-d H:i:s');

error_log($ahora . ' - comprobarcedulaNew.php' . " - Linea 9 \n", 3, $ruta);
error_log($ahora . ' - comprobarcedulaNew.php - Vengo desde: ' . $_SERVER['HTTP_REFERER'] . "\n", 3, $ruta); 
//$query=mysqli_query($conn,"SELECT nombre_paciente,cedula,telefono,email FROM paciente WHERE cedula = '" . $cedula . "'");
$consulta = "SELECT ci, nombre, email FROM usuarios WHERE ci='" . htmlspecialchars($cedula, ENT_QUOTES) . "';";
error_log($ahora . ' - comprobarcedulaNew.php - Ejecutamos la consulta de usuarios: ' . $consulta . " - Linea 13 \n", 3, $ruta);

$query=mysqli_query($conn,$consulta);

$row=mysqli_fetch_array($query);

if($row){
	// Retorno al Ajax
	//error_log($ahora . ' - comprobarcedulaNew.php - Row: ' . $row . " - Linea 9 \n", 3, $ruta);
	//error_log($ahora . ' - comprobarcedulaNew.php - Retorna EXISTE ' . "\n", 3, $ruta); 
	echo "EXISTE";
	
}else{
	// Retorno al Ajax
	//error_log($ahora . ' - comprobarcedulaNew.php - Retorna NOEXISTE ' . "\n", 3, $ruta); 
	echo "NOEXISTE";
}
//$query->close();
?>