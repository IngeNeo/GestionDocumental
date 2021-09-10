<?php
ob_start();
session_start();
require_once 'config.php'; 
if(!isset($_SESSION['logged_in'])){
	header('Location: index.php');
}
?>
<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="#" />  
		<title>Modulo Prestamos</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!--datables CSS básico-->
		<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
		<!--datables estilo bootstrap 4 CSS-->  
		<link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
		<link rel="stylesheet" href="css/estilos.css">
	</head>
	
<body> 
	<header>
		<div class="row fondo">
			<div class="col-sm-1 col-md-1">
				<a href="home.php"><i class="icono fas fa-home"></i></a>
			</div>
			<div class="col-sm-11 col-md-11 col-lg-11">
				<h1 class="titulos text-center text-uppercase">Prestamos</h1>
			</div>
		</div>
	</header>
	<div class="container justify-content-center align-items-center">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<form id="formCarpetas">
					<label for="tipo_item" class=" col-form-label">Seleccione el item a prestar:</label>
					<select class="form-control"onchange="location.href=this.options[this.selectedIndex].value" name="elige" size="1">
						<option value="#" selected>Elija un item</option>
						<option value="prestamos_cajas.php">Cajas</option>
						<option value="prestamos_carpetas.php">Carpetas</option>
						<option value="prestamos_folios.php">Folios</option>
					</select>
				</form>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>
	<!-- jQuery, Popper.js, Bootstrap JS -->
	<script src="jquery/jquery-3.3.1.min.js"></script>
	<script src="popper/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	  
	<!-- datatables JS -->
	<script type="text/javascript" src="datatables/datatables.min.js"></script>
	<!-- Botones para usar en dataTables -->
	<script src="Buttons/js/dataTables.buttons.min.js"></script>
	<script src="Buttons/js/buttons.html5.min.js"></script>
	<script src="JSZip/jszip.min.js"></script>
	<script src="pdfmake/pdfmake.min.js"></script>
	<script src="pdfmake/vfs_fonts.js"></script>
	 
	<script>
		$('#tipo_item').on('change', function () {
			var seleccion = $('#tipo_item').val();
			if (seleccion == "cajas") {
				//window.location = "/ prestamos_cajas.php";
				document.location.href="prestamos_carpetas.php";
			}
		}
	});
	
	</script>

	<footer>
		<div class="container-fluid">
			<p class="text-center" style="margin-top:65px;">Copyright by <a href="#" target="_blank">Easy Solutions</a> <?php echo date("Y")?></p>
		</div>
	</footer>

</body>

</html>
