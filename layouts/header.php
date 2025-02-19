<!DOCTYPE html>
<!-- Header -->
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" type="text/css" media="screen">
        <title>PDV - SB Admin</title>
		<link href="css/style.min.css" rel="stylesheet" />
		<link type="text/css" href="css/styles.css" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
	
	<link href="css/datatables.min.css" rel="stylesheet" >
	<link href="public/assets/fontawesome/css/all.min.css" rel="stylesheet" >
	<link href="public/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet" >
	</head>
	<body>
		<div id="layoutSidenav_content" style=" height: 25px;"> 
			<main>
				<div class="container-fluid">
					<!-- Mediodia -------------------------->
					<div class="row"> 
						<div class="col-6 col-md-4">
							<div class="card text-white bg-primary">
								<div class="card-body">
									<i class="fa-regular fa-eye" aria-hidden="true"></i> Solicitud Reserva al Mediodía:
								</div>
								<a class="card-footer text-black" style=" height: 450px;"  <?php require './configuraciones/configMediodia.php'; ?>
							</div>
						</div>
						
					<!-- Noche -------------------------->
					
						<div class="col-6 col-md-4">
							<div class="card text-white bg-success">
								<div class="card-body"> 
									<i class="fa fa-shopping-cart" aria-hidden="true"></i> Solicitud Reserva a la Noche:
								</div>
								<a class="card-footer text-black" style=" height: 450px;"  <?php require './configuraciones/configNoche.php'; ?>
							</div>
						</div>
					</div>
				</div>
