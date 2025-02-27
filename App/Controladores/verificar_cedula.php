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
if (isset($_GET['cedula'])) {
    $cedula = htmlspecialchars($_GET['cedula']);
	error_log($config['ahora'] . ' - verificar_cedula.php - Campo: cedula esta cargado. ' . $cedula . "\n", 3, $config['ruta']);
	error_log($config['ahora'] . " - verificar_cedula.php" . " - linea 20 \n", 3, $config['ruta']);
	error_log($config['ahora'] . " - verificar_cedula.php" . " - Linea 21 \n", 3, $config['ruta']);
	
	$consulta = "SELECT ci, nombre, telefono, email FROM usuarios WHERE ci='" . $cedula . "';";
	$query=mysqli_query($conn,$consulta);
	$row=mysqli_fetch_array($query);
	if($row){
		// Retorno al Ajax
		//error_log($config['ahora'] .' - verificar_cedula.php - Row: ' . $row . " - Linea 9 \n", 3, $config['ruta']);
		//error_log($config['ahora'] .' - verificar_cedula.php - Retorna EXISTE rows' . "\n", 3, $config['ruta']); 
		//echo "EXISTE";
		echo json_encode([
						'cedula'   => $row['ci'],
						'nombre'   => $row['nombre'],
						'telefono' => $row['telefono'],
						'email'    => $row['email']	
						]);
	}else{
		// Retorno al Ajax
		//error_log($config['ahora'] .' - verificar_cedula.php - Retorna NOEXISTE ' . "\n", 3, $config['ruta']); 
		echo json_encode([
			'error' => 'Usuario no encontrado en la BD.'
			]);
	}

}else{ 
	echo json_encode([
		'error' => 'El Nro. de Cedula llego nulo.'
		]);

}

//$query->close();
?>