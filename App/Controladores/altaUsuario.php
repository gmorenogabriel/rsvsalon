<?php
// -------------------------
// --> altaUsuario.php    --
// -------------------------
require('../conexion/dbConfig.php');
$config = include('../conexion/rutaLog.php'); // Cargar configuración
error_log($config['ahora'] . ' - inicio.php' . " - linea 32 \n", 3, $config['ruta']);

error_log($config['ahora'] . ' - Controladores\altaUsuario.php - Metodo: ' .$_SERVER['REQUEST_METHOD'] . "\n", 3, $config['ruta']);


// Verifica si se han recibido datos por POST o POST
if (!empty($_REQUEST)) {
    // Recorre cada par clave/valor del array $_REQUEST
    foreach ($_REQUEST as $campo => $valor) {
		error_log($config['ahora'] . ' - App\Vista\altaUsuario.php - Campo: ' . htmlspecialchars($campo)  . ' Valor: ' . htmlspecialchars($valor) . "\n", 3, $config['ruta']);
    }
} else {
    // echo "No se han recibido datos por POST o POST.";
		error_log($config['ahora'] . ' - Controladores\altaUsuario.php.php - No se recibieron datos por POST.' . "\n", 3 , $config['ruta']);
	}

if (isset($_GET['cedula'])) {
    $cedula		= htmlspecialchars($_GET['cedula']);
	$nombre		= htmlspecialchars($_GET['nombre']);
	$telefono	= htmlspecialchars($_GET['telefono']);
	$correo		= htmlspecialchars($_GET['correo']);
	error_log($config['ahora'] . ' - Controladores\altaUsuario.php - cedula: ' . $cedula   . "\n", 3, $config['ruta']);
	error_log($config['ahora'] . ' - Controladores\altaUsuario.php - nombre: ' . $nombre   . "\n", 3, $config['ruta']);
	error_log($config['ahora'] . ' - Controladores\altaUsuario.php - telefo: ' . $telefono . "\n", 3, $config['ruta']);
	error_log($config['ahora'] . ' - Controladores\altaUsuario.php - correo: ' . $correo   . "\n", 3, $config['ruta']);
} else {
    // Maneja el caso en que 'cedula' no está presente en la URL
	error_log($config['ahora'] . ' - Controladores\altaUsuario.php.php - Campo: ced NO esta cargado. ' . "\n", 3, $config['ruta']);
    $cedula   = '';
	$nombre   = '';
	$correo   = '';
	$telefono = '';
}

error_log($config['ahora'] . ' - Controladores\altaUsuario.php - ' . $_GET['nombre'] .  "\n", 3, $config['ruta']);
if (!isset($_GET['nombre'])){
	error_log($config['ahora'] . ' - Controladores\altaUsuario.php - Nombre no vino seteado - Linea 25' . "\n", 3, $config['ruta']);
	//echo "<script>$('#modelId').modal('show');</script>";
}

error_log($config['ahora'] . ' - Controladores\altaUsuario.php - CEDULA <> 0 ' .  "\n", 3, $config['ruta']);
if(isset($cedula) && $cedula>"0"){  //si Cedula me llega cargado entonces continuo

	error_log($config['ahora'] . ' - Controladores\altaUsuario.php - ' . $cedula .  "\n", 3, $config['ruta']);
	
	$consulta = "SELECT ci, nombre, telefono, email FROM usuarios WHERE ci='" . $cedula . "';";
	error_log($config['ahora'] . ' - Controladores\altaUsuario.php - ' . $consulta .  "\n", 3, $config['ruta']);

	// Ejecutar la consulta
	$resultado = mysqli_query($conn, $consulta);

	if ($resultado) {
		// Obtener el número de filas devueltas
		$num_filas = mysqli_num_rows($resultado);
		error_log($config['ahora'] . ' - Controladores\altaUsuario.php - Numero de Filas: ' . $num_filas .  "\n", 3, $config['ruta']);

		if (!$num_filas > 0) {
			// Mostrar los resultados
			error_log($config['ahora'] . ' - Controladores\altaUsuario.php - No Existe esa Cedula en Usuarios - La vamos a crear: ' . htmlspecialchars($cedula) . "\n",3, $config['ruta']);
			// Insertamos en la base
			$agregar="INSERT into Usuarios (ci,     password,   nombre,  telefono,    email, rol_usuario, pago, activo, fecha_alta, fecha_edit, fecha_baja)
								values('$cedula',  '$cedula','$nombre','$telefono', '$correo',     'COMUN', null,    '1',   '$ahora',       null,       null);";

			mysqli_query($conn, $agregar);

			error_log($config['ahora'] . ' - Controladores\altaUsuario.php - ' . $agregar . "\n", 3, $config['ruta']);
			try{
				if($resultado){
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

				error_log($config['ahora'] . " - " . $cedula . " - " . $nombre . "\n", 3, $config['ruta']);
				error_log($config['ahora'] . ' - Controladores\altaUsuario.php - Volvemos a index.php.' . "\n", 3, $config['ruta']);
				// Cerrar la conexión si está establecida
				if (isset($conn) && $conn->ping()) {
					//$query1->close();
					$conn->close();
					error_log($config['ahora'] . ' - Controladores\altaUsuario.php - Cerramos las conexiones. \n', 3, $config['ruta']);
				}
				error_log($config['ahora'] . ' - Controladores\altaUsuario.php - Volvemos a index.php.' . "\n", 3, $config['ruta']);
				// Ya creamos el Usuario podemos avanzar con la Reserva
				header("Location: ./rsvsalon/solicitudReserva1.php");
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
					//$query1->close();
					$conn->close();
				}
			}
		}
	}
}
?>
