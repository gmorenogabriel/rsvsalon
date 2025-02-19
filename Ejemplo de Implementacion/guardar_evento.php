//
//  El campo bloqueado = 1 indica que el evento NO puede modificarse.
// se debe modificar por si el ROL_USUARIO es COMUN No pueda modificarse el EVENTO
<?php
include 'conexion.php';
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

$sql = "INSERT INTO eventos (title, start, end, bloqueado) VALUES ('$title', '$start', '$end', 1)";
mysqli_query($conn, $sql);
?>
