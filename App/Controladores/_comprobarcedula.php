<?php

include('../conexion/dbConfig.php');
$cedula=htmlspecialchars($_POST["cedula"]);//recojemos lo seleccionado

$ruta='../../writeable/rsvsalon.log';
$ahora = date('Y-m-d H:i:s');

error_log($config['ahora'] . ' - comprobarcedula.php' . " - Linea 9 \n", 3, $config['ruta']);

//$query=mysqli_query($conn,"SELECT nombre_paciente,cedula,telefono,email FROM paciente WHERE cedula = '" . $cedula . "'");
$consulta = "SELECT ci, nombre, email FROM usuarios WHERE ci='" . htmlspecialchars($cedula, ENT_QUOTES) . "';";
error_log($config['ahora'] . ' - comprobarcedula.php - Ejecutamos la consulta de usuarios: ' . $consulta . " - Linea 13 \n", 3, $config['ruta']);
$query=mysqli_query($conn,$consulta);

$row=mysqli_fetch_array($query);
if($row){
	error_log($config['ahora'] . ' - comprobarcedula.php' . ' Hay row ' . " \n", 3, $config['ruta']);
    session_start();
    $_SESSION['paciente']=$row['nombre'];
    $_SESSION['cedula']=$row['ci'];
	error_log($config['ahora'] . ' - comprobarcedula.php - Inicializamos la SESSION ' . " \n", 3, $config['ruta']);
	error_log($config['ahora'] . ' - comprobarcedula.php - referenciamos ./App/Vistas/inicio.php ' . " \n", 3, $config['ruta']);
	echo "<script>window.location.href='./App/Vistas/inicio.php'</script>";
}else{
	error_log($config['ahora'] . ' - comprobarcedula.php' . ' NO Hay row  LLAMAMOS AL MODAL #modelId ' . "\n", 3, $config['ruta']);
    echo "<script>$('#modelId').modal('show');</script>";
	
}

$query->close();
?>