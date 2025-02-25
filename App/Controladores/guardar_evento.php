<?php
$config = include('../conexion/rutaLog.php'); // Cargar configuración
error_log($config['ahora'] . " - guardar_evento.php" . " - linea 3 \n", 3, $config['ruta']);

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'gmoreno');
define('DB_PASSWORD', 'morega');
define('DB_NAME', 'reservasalon');

// Crear la conexión con la base de datos
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if (!$conn) {
    error_log($config['ahora'] . " - guardar_evento.php" . " - Error en la conexion a la BD. \n", 3, $config['ruta']);
    die("La conexión ha fallado: " . $conn->connect_error);
}
error_log($config['ahora'] . " - guardar_evento.php" . " - Hay conexion a la BD. \n", 3, $config['ruta']);

    error_log($config['ahora'] . " - guardar_evento.php" . " - try - Ingrese. \n", 3, $config['ruta']);

    $cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : "";
    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : "";
    $celular = isset($_POST['celular']) ? htmlspecialchars($_POST['celular']) : "";
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : "";
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : "";
    $url = isset($_POST['url']) ? htmlspecialchars($_POST['url']) : "";

    $start = isset($_POST['start']) ? htmlspecialchars($_POST['start']) : "";
    $end = isset($_POST['end']) ? htmlspecialchars($_POST['end']) : "";

    if (!strtotime($start) || !strtotime($end)) {
        die("Error: Formato de fecha incorrecto.");
    }

    // Convertir a objetos DateTime
    $startTime = new DateTime($start);
    $endTime = new DateTime($end);
    //print_r($startTime->format('Y-m-d H:i:s'));
    //print_r($endTime->format('Y-m-d H:i:s'));

    // Intervalo de 1 hora
    $interval = new DateInterval('PT5H');

    // Convertir las horas a objetos DateTime para comparación de franjas horarias
    $hora_start = DateTime::createFromFormat('Y-m-d\TH:i:sP', $start);
    // $hora_Minuto_Start = $hora_start->format('H:i');

	// Verifica que $hora_start sea un objeto DateTime válido
	$hora_start = DateTime::createFromFormat('Y-m-d\TH:i:sP', $start);
	if (!$hora_start) {
		die("Error: Formato de fecha incorrecto en 'start'.");
	}
	$hora_Minuto_Start = $hora_start->format('H:i');

    error_log($config['ahora'] . " - guardar_evento.php" . " - hora_Minuto_Start H:i : " . $hora_Minuto_Start . " \n", 3, $config['ruta']);

// Verifica que $hora_start sea un objeto DateTime válido
$hora_start = DateTime::createFromFormat('Y-m-d\TH:i:sP', $start);
if (!$hora_start) {
    die("Error: Formato de fecha incorrecto en 'start'.");
}
$hora_Minuto_Start = $hora_start->format('H:i');

// Definir franjas horarias correctamente
$ini_startMatutina = DateTime::createFromFormat('H:i', "11:00");
$fin_startMatutina = DateTime::createFromFormat('H:i', "16:59");
$ini_startNocturna = DateTime::createFromFormat('H:i', "19:00");
$fin_startNocturna = DateTime::createFromFormat('H:i', "23:59");

if (!$ini_startMatutina || !$fin_startMatutina || !$ini_startNocturna || !$fin_startNocturna) {
    die("Error: Formato de hora incorrecto en las franjas horarias.");
}

// Inicializar $sql antes de usarlo
$sql = "";
$start_format = $hora_start->format('Y-m-d H:i:s');
// $end_format = $endTime->format('Y-m-d H:i:s'); // Así estaba


if ($hora_Minuto_Start >= $ini_startMatutina->format('H:i') && $hora_Minuto_Start <= $fin_startMatutina->format('H:i')) {
    $end_format = $fin_startMatutina->format('Y-m-d H:i:s');
    $sql = "INSERT INTO events (ci, nombre, celular, title, description, url, start, end)
            VALUES ('$cedula', '$nombre', '$celular', '$title', '$description', '$url', '$start_format', '$end_format')";

    error_log($config['ahora'] . " - guardar_evento.php Matutino - Sql : " . $sql . " \n", 3, $config['ruta']);
} elseif ($hora_Minuto_Start >= $ini_startNocturna->format('H:i') && $hora_Minuto_Start <= $fin_startNocturna->format('H:i')) {
    $end_format = $fin_startNocturna->format('Y-m-d H:i:s');
    $sql = "INSERT INTO events (ci, nombre, celular, title, description, url, start, end)
            VALUES ('$cedula', '$nombre', '$celular', '$title', '$description', '$url', '$start_format', '$end_format')";

    error_log($config['ahora'] . " - guardar_evento.php Nocturno - Sql : " . $sql . " \n", 3, $config['ruta']);
} else {
    error_log($config['ahora'] . " - guardar_evento.php No es ni Matutino ni Nocturno. \n", 3, $config['ruta']);
}

// Ejecutar SQL si se definió
if (!empty($sql)) {
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        echo "ok";
    } else {
        echo "Error al guardar el evento: " . $stmt->error;
    }
} else {
    echo "Error: No se pudo determinar la franja horaria.";
}

$conn->close();