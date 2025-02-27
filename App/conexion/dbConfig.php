<?php
// Database configuration  
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'gmoreno'); 
define('DB_PASSWORD', 'morega'); 
define('DB_NAME', 'reservasalon'); 
  
// Create database connection  
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);  
  
// Verificar la conexión
if (!$conn) {
    die("La conexión ha fallado: " . $conn->connect_error);
}
// echo "Conexión exitosa a la base de datos.";
?>