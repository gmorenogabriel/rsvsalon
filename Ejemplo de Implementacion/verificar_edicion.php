//
// Si el evento está bloqueado (bloqueado = 1), no se podrá editar ni eliminar.
//
<?php
include 'conexion.php';
$id = $_POST['id'];
$sql = "SELECT bloqueado FROM eventos WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo ($row['bloqueado'] == 1) ? 'bloqueado' : 'permitido';
?>
