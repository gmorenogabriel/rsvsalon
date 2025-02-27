<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/estilo.css">
    <title>Document</title>
    <?php 
		include('../conexion/dbConfig.php');
		//include('../conexion/seguridad.php');
		$config = include('../conexion/rutaLog.php'); // Cargar configuración
		error_log($config['ahora'] . ' - inicio.php' . " - linea 32 \n", 3, $config['ruta']);
	?>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0273d57df4.js" crossorigin="anonymous"></script>
sudo
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="/rsvsalon/public/assets/fontawesome/css/all.min.css" rel="stylesheet" >
    <link href="/rsvsalon/public/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../../public/css/agendar.css">


<header>
<h2 class="titulo">Alta de Usuario</a>
</header>

<div class="navBar" id="navBar">
    <ul class="opcinesNav">
        <li class="nav-item"> 
        <a href="index.php" class="nav-link"><i class="icono fa fa-house"></i>
        Inicio
        </a>
        </li>
        <li class="nav-item"> 
        <a href="#" class="nav-link"><i class="icono fa fa-house"></i>
        Nosotros
        </li></a>
        <li class="nav-item"> 
        <a href="../Controladores/cerrar.php" class="nav-link"><i class="icono fa fa-power-off"></i>
        Cerrar Sesion
        </li></a>
    </ul>
</div>
	<?php 
		//$config['ruta']='../../writeable/rsvsalon.log';
		//$config['ahora'] = date('Y-m-d H:i:s');
		error_log($config['ahora'] . ' - App/Vistas/altaUsuario.php - Vengo desde: ' . $_SERVER['HTTP_REFERER'] . "\n", 3, $config['ruta']); 

		if (isset($_GET['cedula'])){
			$cedula = $_GET['cedula'];
			$_SESSION['cedula'] = $cedula;
				error_log($config['ahora'] . ' - App/Vistas/altaUsuario.php - Cedula: ' . $cedula . "\n", 3, $config['ruta']); 
		}
	?>

<div class="vista"> 
	 <!-- <h5><strong>Usuario:</strong> <?php echo $_SESSION['']; ?></h5> -->
	<h5><strong>Cedula:</strong> <?php echo $cedula; ?></h5>
</div>

</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Usuario</h2>
        <form action="../Controladores/altaUsuario.php?cedula=" + $cedula method="POST">
            <div class="row">
			    <div class="col-md-4">
					<label for="ced">Cédula</label>
					<input type="text" class="form-control" id="cedula" name="cedula" value="<?php echo $cedula; ?>" required>
				</div>
				<div class="col-md-6">
					<label for="usuario">Nombre</label>
					<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu nombre completo" required>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-md-6">
					<label for="correo">Correo</label>
					<input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu correo" required>
				</div>
            	<div class="col-md-4">
					<label for="telefono">Teléfono</label>
					<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" required>
				</div>
			</div>
			
            <button type="submit" class="btn btn-success mt-3">Registrar</button>
        </form>
    </div>

    <!------------------------------- -->
    <!-- Carga de archivos JavaScript -->
    <!------------------------------- -->
    <!-- Librerías externas primero   -->
    <!-- Bootstrap core JavaScript    -->
    <!------------------------------- -->
    <script src="/rsvsalon/js/jquery-3.7.0.min.js"></script>
    <script src="/rsvsalon/js/bootstrap.bundle.min.js"></script>
    <script src="/rsvsalon/js/datatables.min.js"></script>  <!-- DataTables -->
    <script src="/rsvsalon/configuraciones/node_modules/sweetalert2/dist/sweetalert2.js"></script>
    
    <!-- Enlace a los scripts de JavaScript de Bootstrap (opcional) 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	-->
</body>
</html>

