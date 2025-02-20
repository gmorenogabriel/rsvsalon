<?php
// -------------------------	
// --> altaUsuario.php    --
// -------------------------
include('../conexion/dbConfig.php');
include('../conexion/rutaLog.php');
//$ruta='../../writeable/rsvsalon.log';
//$ahora = date('Y-m-d H:i:s');

error_log($ahora . ' - Controladores\altaUsuario.php.php - Metodo: ' .$_SERVER['REQUEST_METHOD'] . "\n", 3, $ruta);

// Verifica si se han recibido datos por POST o POST
if (!empty($_REQUEST)) {
    // Recorre cada par clave/valor del array $_REQUEST
    foreach ($_REQUEST as $campo => $valor) {
		error_log($ahora . ' - App\Vista\altaUsuario.php - Campo: ' . htmlspecialchars($campo)  . ' Valor: ' . htmlspecialchars($valor) . "\n", 3, $ruta);
         // echo "Campo: " . htmlspecialchars($campo) . " - Valor: " . htmlspecialchars($valor) . "<br>";
    }
} else {
    // echo "No se han recibido datos por POST o POST.";
	error_log($ahora . ' - Controladores\altaUsuario.php.php - No se recibieron datos por POST.' . "\n", 3 , $ruta);
	}
	
if (isset($_POST['cedula'])) {
    $cedula		= htmlspecialchars($_POST['cedula']);
	$nombre		= htmlspecialchars($_POST['usuario']);
	$correo		= htmlspecialchars($_POST['correo']);
	$telefono	= htmlspecialchars($_POST['telefono']);
	
	error_log($ahora . ' - Controladores\altaUsuario.php.php - cedula: ' . $cedula . "\n", 3, $ruta);
	error_log($ahora . ' - Controladores\altaUsuario.php.php - nombre: ' . $nombre . "\n", 3, $ruta);
	error_log($ahora . ' - Controladores\altaUsuario.php.php - correo: ' . $correo . "\n", 3, $ruta);
	error_log($ahora . ' - Controladores\altaUsuario.php.php - telefono: ' . $telefono . "\n", 3, $ruta);
	
} else {
    // Maneja el caso en que 'cedula' no está presente en la URL
	error_log($ahora . ' - Controladores\altaUsuario.php.php - Campo: ced NO esta cargado. ' . "\n", 3, $ruta);	
    $cedula = '';
	$nombre = '';
	$correo = '';
	$telefono = '';
}

if (!isset($_POST['nombre'])){
	error_log($ahora . ' - Controladores\altaUsuario.php.php - Nombre no vino seteado - Linea 25' . "\n", 3, $ruta);	
	echo "<script>$('#modelId').modal('show');</script>";
}

$consulta="SELECT ci from usuarios where ci=$cedula";
error_log($ahora . ' - Controladores\altaUsuario.PHP - Select Usuarios: ' . htmlspecialchars($consulta) . "\n",3, $ruta);
$query1=mysqli_query($conn, $consulta);

if ($query1){
	
	// Obtener el número de filas retornadas
    $num_rows = mysqli_num_rows($query1);

    if (!$num_rows > 0) {
	
		error_log($ahora . ' - altaUsuario.PHP - No hay registros de esa Cedula en Usuarios - No Existe: ' . htmlspecialchars($cedula) . "\n",3, $ruta);
		// Insertamos en la base
		$agregar="INSERT into Usuarios (ci,password,   nombre,    email, rol_usuario, pago, activo, fecha_alta, fecha_edit, fecha_baja)
							   values('$cedula',  '$cedula','$nombre','$correo',     'COMUN', null,    '1',   '$ahora',       null,       null);";
		 
		error_log($ahora . ' - Controladores\altaUsuario.php.php - ' . $agregar . "\n", 3, $ruta);	
		try{
			// Ejecutamos la consulta en la BD
			$query=mysqli_query($conn, $agregar);			   
			if($query1){
				echo "<script>Swal.fire({
					icon: 'success',
					title: 'Exito',
					text: 'Usuario Guardado!!!',
					timer: 3000,
					showConfirmButton: true
				  });</script> ";
			}
			session_start();
			$_SESSION['paciente']=$nombre;
			$_SESSION['cedula']	=$cedula;
			
			error_log($ahora . " - " . $cedula . " - " . $nombre . "\n", 3, $ruta);
			error_log($ahora . ' - Controladores\altaUsuario.php.php - Volvemos a index.php.' . "\n", 3, $ruta);	
			// Cerrar la conexión si está establecida
			if (isset($conn) && $conn->ping()) {
				$query1->close();
				$conn->close();
				error_log($ahora . ' - Controladores\altaUsuario.php.php - Cerramos las conexiones. \n', 3, $ruta);
			}
			error_log($ahora . ' - Controladores\altaUsuario.php.php - Volvemos a index.php.' . "\n", 3, $ruta);	
			// Ya creamos el Usuario podemos avanzar con la Reserva
			header("Location: http://localhost:8084/rsvsalon/solicitudReserva1.php");
			exit(); // Asegura que el script no siga ejecutándose


		} catch (mysqli_sql_exception $e) {
				echo "<script>Swal.fire({
					icon: 'danger',
					title: 'Error',
					text:  'Error al crear el usuario !!!,
					timer: 3000,
					showConfirmButton: true
				  });</script> ";
			// Manejar errores específicos de MySQLi
			echo "Error en la consulta: " . $e->getMessage();
		} catch (Exception $e) {
			// Manejar otros tipos de excepciones
			echo "Se produjo un error: " . $e->getMessage();
		} finally {
			// Cerrar la conexión si está establecida
			if (isset($conn) && $conn->ping()) {
				$query->close();
				$query1->close();
				$conn->close();
			}
		}
	}
}

?>
