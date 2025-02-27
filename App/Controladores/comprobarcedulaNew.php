<?php
include('../conexion/dbConfig.php');
$config = include('../conexion/rutaLog.php'); // Cargar configuración

// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");  // Permite todos los orígenes. Puedes especificar un origen específico si es necesario.
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  // Permite los métodos GET, POST y OPTIONS
header("Access-Control-Allow-Headers: Content-Type");  // Permite el encabezado Content-Type

// Si la solicitud es OPTIONS (preflight request), finaliza aquí
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
if (isset($_POST['cedula'])) {
    $ced = htmlspecialchars($_POST['cedula']);
	error_log($config['ahora'] . ' - comprobarcedulaNew.php - Campo: ced esta cargado. ' . $ced . "\n", 3, $config['ruta']);
}
$cedula=htmlspecialchars($_POST["cedula"]);//recojemos lo seleccionado

$ruta='../../writeable/rsvsalon.log';
$ahora = date('Y-m-d H:i:s');
error_log($config['ahora'] . " - comprobarcedulaNew.php" . " - linea 3 \n", 23, $config['ruta']);
error_log($config['ahora'] .' - comprobarcedulaNew.php' . " - Linea 9 \n", 24, $config['ruta']);

//$query=mysqli_query($conn,"SELECT nombre_paciente,cedula,telefono,email FROM paciente WHERE cedula = '" . $cedula . "'");
$consulta = "SELECT ci, nombre, telefono, email FROM usuarios WHERE ci='" . htmlspecialchars($cedula, ENT_QUOTES) . "';";
$query=mysqli_query($conn,$consulta);
$row=mysqli_fetch_array($query);
if($row){
	// Retorno al Ajax
	//error_log($config['ahora'] .' - comprobarcedulaNew.php - Row: ' . $row . " - Linea 9 \n", 3, $config['ruta']);
	//error_log($config['ahora'] .' - comprobarcedulaNew.php - Retorna EXISTE ' . "\n", 3, $config['ruta']); 
	//echo "EXISTE";
	echo json_encode([
		            'cedula'   => $row['ci'],
		            'nombre'   => $row['nombre'],
		            'telefono' => $row['telefono'],
		            'email'    => $row['email']	
					]);
}else{
	// Retorno al Ajax
	//error_log($config['ahora'] .' - comprobarcedulaNew.php - Retorna NOEXISTE ' . "\n", 3, $config['ruta']); 
	echo "NOEXISTE";
}
//$query->close();
?>