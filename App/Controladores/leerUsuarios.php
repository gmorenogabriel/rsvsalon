<?php

include('../conexion/dbConfig.php');
$ruta='../../writeable/rsvsalon.log';
$ahora = date('Y-m-d H:i:s');

error_log($ahora . ' - leerUsuarios.php - Metodo: ' .$_SERVER['REQUEST_METHOD'] . "\n", 3, $ruta);

// Verifica si se han recibido datos por POST o POST
if (!empty($_REQUEST)) {
    // Recorre cada par clave/valor del array $_REQUEST
    foreach ($_REQUEST as $campo => $valor) {
		error_log($ahora . ' - leerUsuarios.php - Campo: ' . htmlspecialchars($campo)  . ' Valor: ' . htmlspecialchars($valor) . "\n", 3, $ruta);
         // echo "Campo: " . htmlspecialchars($campo) . " - Valor: " . htmlspecialchars($valor) . "<br>";
    }
} else {
    // echo "No se han recibido datos por POST o POST.";
	}
	
if (isset($_POST['ced'])) {
    $ced = htmlspecialchars($_POST['ced']);
	error_log($ahora . ' - leerUsuarios.php - Campo: ced esta cargado. ' . $ced . "\n", 3, $ruta);

    // Procesa el valor de $ced según sea necesario
	} else {
    // Maneja el caso en que 'ced' no está presente en la URL
	error_log($ahora . ' - leerUsuarios.php - Campo: ced NO esta cargado. ' . "\n", 3, $ruta);	
    $ced = '1015457229'; // O cualquier valor por defecto que consideres apropiado
}
if (!isset($_POST['nombre'])){
	error_log($ahora . ' - leerUsuarios.php - Nombre no vino seteado - Linea 25' . "\n", 3, $ruta);	
	echo "<script>$('#modelId').modal('show');</script>";
}

//$ced = htmlspecialchars($_POST['ced'] ?? 'ced');
$nombre = htmlspecialchars($_POST['nombre'] ?? 'nombre');
$correo = htmlspecialchars($_POST['correo'] ?? 'correo');

error_log($ahora . ' - leerUsuarios.php - C.I.:    ' . htmlspecialchars($ced)    . "\n", 3, $ruta);
error_log($ahora . ' - leerUsuarios.php - Nombre:  ' . htmlspecialchars($nombre) . "\n", 3, $ruta);
error_log($ahora . ' - leerUsuarios.PHP - Correo:: ' . htmlspecialchars($correo) . "\n", 3, $ruta);

$consulta="SELECT ci from usuarios where ci=$ced";
error_log($ahora . ' - leerUsuarios.PHP - Select Usuarios: ' . htmlspecialchars($consulta) . "\n",3, $ruta);
$query1=mysqli_query($conn,$consulta);

$i=0;

if($query21=mysqli_fetch_array($query1)){
    $i++;
}

if($i>0){
	// Retorno al Ajax
	echo "EXISTE";
  // MAL "echo" "<script>  Swal.fire({    icon: 'error',    title: 'Oops...',    text: 'Cedula ya Existe',	timer: 3000  })  </script>";
}else{
	error_log($ahora . ' - leerUsuarios.PHP - La Cedula No Existe: ' . htmlspecialchars($ced) . "\n",3, $ruta);
	
	// $agregar="INSERT into Usuarios (ci,password,nombre,email,id_rol,pago,activo, fecha_alta, fecha_edit, fecha_baja)
	  // values($ced, 'eldiaquemequieras','$nombre','$correo', 'Usuario Común', null, '1', '$ahora', null, null);";
	 
	// error_log($ahora . ' - leerUsuarios.php - ' . $agregar . "\n", 3, $ruta);	
	// $query=mysqli_query($conn,$agregar);			   
    // if($query1){
        // echo "<script>Swal.fire({
            // icon: 'success',
            // title: 'Exito',
            // text: 'Usuario ' . $ced . ' Guardado',
			// timer: 3000,
			// showConfirmButton: true
          // });</script> ";
    // }
	error_log($ahora . ' - leerUsuarios.php - Volvemos a index.php al Modal #modelId a cargar Cedula, Nombre, Correo, Telefono.' . "\n", 3, $ruta);	
	// Retorno al Ajax
	echo "NOEXISTE";
}
$query1->close();
if(isset($query21)){
	//$query21->close();
}

?>