<?php

include('../conexion/dbConfig.php');
$cedula=htmlspecialchars($_POST["cedula"]);//recojemos lo seleccionado

$ruta='../../writeable/rsvsalon.log';
error_log('comprobarcedula.php' . " - Linea 7 \n", 3, $ruta);

//$query=mysqli_query($conn,"SELECT nombre_paciente,cedula,telefono,email FROM paciente WHERE cedula = '" . $cedula . "'");
$query=mysqli_query($conn,"SELECT ci, nombre, email FROM usuarios WHERE ci = '" . $cedula . "'");
error_log('comprobarcedula.php' . $query . "\n", 3, $ruta);

print_r($query);
die();
$row=mysqli_fetch_array($query);
if($row){
	error_log('comprobarcedula.php' . ' Hay row ' . "\n", 3, $ruta);

    session_start();
    $_SESSION['paciente']=$row['nombre'];
    $_SESSION['cedula']=$row['ci'];
   echo "<script>window.location.href='./App/Vistas/inicio.php'</script>";
}else{
    echo "<script>$('#modelId').modal('show');</script>";
	error_log('comprobarcedula.php' . ' NO Hay row ' . "\n", 3, $ruta);

}


?>