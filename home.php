<?php
ob_start();
session_start();
require_once 'config.php'; 
if(!isset($_SESSION['logged_in'])){
	header('Location: index.php');
}

$ClaseUsuario = $_SESSION['Tipos_de_usuario_id_Tipo_usuario'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Menu Principal</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="datatables/datatables.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
	<link rel="stylesheet" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="Buttons/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>

<body>
	<header>
		<div class="row fondo1">
			<div class="col-sm-8 col-md-8 col-lg-8">
				<h1 class="titulos text-center text-uppercase">Menú principal - Administrador</h1>
			</div>
			<div class="col-sm-2 col-md-2 col-lg-2">
				<a href="account.php" class="btn" style="font-size:20px; text-align: right;"><i class="fa fa-user-alt" title="Mi cuenta"></i>&nbsp;&nbsp;<?php echo $_SESSION['nombre_usuario'];?></a>
			</div>
			<div class="col-sm-2 col-md-2 col-lg-2" style="text-align: right;">
				<a href="logout.php" class="btn"  style="font-size:20px;"><i class="fa fa-sign-out-alt" title="Salir"></i></a>
			</div>
		</div>
	</header>
	
	<div class="container-fluid">

		<?php if ($ClaseUsuario == '1'){
			
			echo "	<div class='usuarios row'>
						<div class='caja_icono col-lg-4 col-md-4 col-sm-12'>
							<a href='usuarios.php' class='btn1'><i class='fas fa-users'></i></a>
							<h3>Usuarios</h3>
						</div>
						<div class='caja_icono col-lg-4 col-md-4 col-sm-12'>
							<a href='clientes.php' class='btn1'><i class='fas fa-sitemap'></i></a>
							<h3>Clientes</h3>
						</div>
						<div class='caja_icono col-lg-4 col-md-4 col-sm-12'>
							<a href='bodegas.php' class='btn1'><i class='fas fa-warehouse'></i></a>
							<h3>Bodega</h3>
						</div>
					</div> ";
		}?>



		<!-- <div class="usuarios row">
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="usuarios.php" class="btn1"><i class="fas fa-users"></i></a>
				<h3>Usuarios</h3>
			</div>
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="clientes.php" class="btn1"><i class="fas fa-sitemap"></i></a>
				<h3>Clientes</h3>
			</div>
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="bodegas.php" class="btn1"><i class="fas fa-warehouse"></i></a>
				<h3>Bodega</h3>
			</div>
		</div> -->

		<div class="usuarios row">
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="cajas.php" class="btn1"><i class="fas fa-box-open"></i></a>
				<h3>Cajas</h3>
			</div>
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="carpetas.php" class="btn1"><i class="far fa-folder-open"></i></a>
				<h3>Carpetas</h3>
			</div>
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="folios.php" class="btn1"><i class="fas fa-file-invoice"></i></a>
				<h3>Folios</h3>
			</div>
		</div>

		<div class="usuarios row justify-content-center">
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="prestamos.php" class="btn1"><i class="fas fa-chalkboard-teacher"></i></a>
				<h3>Prestamos</h3>
			</div>
			<div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="devoluciones.php" class="btn1"><i class="fas fa-chalkboard-teacher"></i></a>
				<h3>Devoluciones</h3>
			</div>
			<!-- <div class="caja_icono col-lg-4 col-md-4 col-sm-12">
				<a href="consultas.php" class="btn1"><i class="fab fa-searchengin"></i></a>
				<h3>Consultas y Reportes</h3>
			</div> -->
		</div>
	</div>
	<script src="jquery/jquery-3.3.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<footer>
		<div class="container-fluid">
			<p class="text-center" style="margin-top:65px;">Copyright by <a href="#" target="_blank">Easy Solutions</a> <?php echo date("Y")?></p>
		</div>
	</footer>
</body>

</html>