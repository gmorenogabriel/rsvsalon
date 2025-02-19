<?php

include('../conexion/dbConfig.php');
$ruta='../../writeable/rsvsalon.log';

error_log('leerUsuarios.php - Metodo: ' .$_SERVER['REQUEST_METHOD'] . "\n", 3, $ruta);

// Verifica si se han recibido datos por POST o POST
if (!empty($_REQUEST)) {
    // Recorre cada par clave/valor del array $_REQUEST
    foreach ($_REQUEST as $campo => $valor) {
		error_log('leerUsuarios.php - Campo: ' . htmlspecialchars($campo)  . ' Valor: ' . htmlspecialchars($valor) . "\n", 3, $ruta);
        echo "Campo: " . htmlspecialchars($campo) . " - Valor: " . htmlspecialchars($valor) . "<br>";
    }
} else {
    echo "No se han recibido datos por POST o POST.";
	}
	
if (isset($_POST['ced'])) {
    $ced = htmlspecialchars($_POST['ced']);
	error_log('leerUsuarios.php - Campo: ced esta cargado. ' . $ced . "\n", 3, $ruta);

    // Procesa el valor de $ced según sea necesario
} else {
    // Maneja el caso en que 'ced' no está presente en la URL
	error_log('leerUsuarios.php - Campo: ced NO esta cargado. ' . "\n", 3, $ruta);	
    $ced = '1015457229'; // O cualquier valor por defecto que consideres apropiado
}
if (!isset($_POST['nombre'])){
	error_log('leerUsuarios.php - Nombre no vino seteado - Linea 25' . "\n", 3, $ruta);	
	echo "<script>$('#modelId').modal('show');</script>";
}

//$ced = htmlspecialchars($_POST['ced'] ?? 'ced');
$nombre = htmlspecialchars($_POST['nombre'] ?? 'nombre');
$correo = htmlspecialchars($_POST['correo'] ?? 'correo');

error_log('leerUsuarios.php - C.I.:    ' . htmlspecialchars($ced)    . "\n", 3, $ruta);
error_log('leerUsuarios.php - Nombre:  ' . htmlspecialchars($nombre) . " Linea 37 \n", 3, $ruta);
error_log('leerUsuarios.PHP - Correo:: ' . htmlspecialchars($correo) . "\n",3, $ruta);

$consulta="SELECT ci from usuarios where ci=$ced";
$query1=mysqli_query($conn,$consulta);


$i=0;

if($query21=mysqli_fetch_array($query1)){
    $i++;
}

if($i>0){
  echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Cedula ya Existe',
	timer: 3000
  })
  </script>";
}else{
	$ahora = date('Y-m-d H:i:s');
	//$now = Date.now();
	error_log('leerUsuarios.PHP - Correo:: ' . htmlspecialchars($now) . "\n",3, $ruta);
	$agregar="INSERT into Usuarios (ci,password,nombre,email,id_rol,pago,activo, fecha_alta, fecha_edit, fecha_baja)
	  values($ced, 'eldiaquemequieras','$nombre','$correo', 'Usuario Común', null, '1', '$ahora', null, null);";
	 
	error_log('leerUsuarios.php - ' . $agregar . ' - Linea 66 ' . "\n", 3, $ruta);	
	$query=mysqli_query($conn,$agregar);			   
    if($query1){
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Exito',
            text: 'Usuario ' . $ced . ' Guardado',
			timer: 3000,
			showConfirmButton: true
          });</script> ";
    }
}

?>