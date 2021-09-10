<?php
ob_start();
session_start();
require_once 'config.php'; 
if(!isset($_SESSION['logged_in'])){
	header('Location: index.php');
}

$ClaseUsuario = $_SESSION['Tipos_de_usuario_id_Tipo_usuario'];
$Gestor = $_SESSION['Clientes_id_cliente'];
include_once 'conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
if($ClaseUsuario == "1"){//Administrador
	$consulta = "SELECT B.id_bodega, B.nombre_bodega, B.direccion_bodega, B.telefono_bodega, M.municipio 
				 FROM bodega B, municipios M 
				 WHERE  B.Municipios_id_municipio = M.id_municipio 
				 ORDER BY nombre_bodega";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
} if ($ClaseUsuario == '2' or $ClaseUsuario == '3'){//Archivador
	echo "<script = 'javaScript'>
	alert('Usuario sin privilegios !!!!')
	window.location.href='home.php';
	</script>";
}
?>

<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="#" />  
		<title>Modulo Bodegas</title>
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
				<h1 class="titulos text-center text-uppercase">Administración de Bodegas</h1>
			</div>
		</div>
	</header>
	<br>	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<br>
				<?php if ($ClaseUsuario == '1' || $ClaseUsuario == '2'){
				echo "<button id='btnNuevo' type='button' class='btn btn-success' data-toggle='modal'>
				<i class='icono1 fas fa-plus-circle'></i> Nueva Bodega</button>";} ?>
			</div>
		</div>
	</div>
	<br>
	<div class="container-fluid">
		<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table id="tablaBodegas" class="table table-striped table-bordered table-condensed" style="width:100%">
						<thead class="text-center">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>Ciudad</th>
								<?php if ($ClaseUsuario == '1' || $ClaseUsuario == '2') { ?>
								<th>Acciones</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($data as $dat) {
							?>
							<tr>
								<td><?php echo $dat['id_bodega'] ?></td>
								<td><?php echo $dat['nombre_bodega'] ?></td>
								<td><?php echo $dat['direccion_bodega'] ?></td>
								<td><?php echo $dat['telefono_bodega'] ?></td>
								<td><?php echo $dat['municipio'] ?></td>
								<?php if ($ClaseUsuario == '1' || $ClaseUsuario == '2') { ?>
									<td nowrap></td>
								<?php } ?>
							</tr>
							<?php
								}
							?>
						</tbody>
						<tfoot class="text-center">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>Ciudad</th>
								<? if ($ClaseUsuario == '1' || $ClaseUsuario == '2') { ?>
								<th style="display:none;"></th>
								<? } ?>
							</tr>
						</tfoot>
						</table>
					</div>
				</div>
		</div>
	</div>
	  
	<!--Modal para CRUD-->
	<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
					</button>
				</div>
			<form id="formBodegas">
				<div class="modal-body">
					<input type="hidden" class="form-control" id="gestor" value="<?php echo $ClaseUsuario; ?>">
					<input type="hidden" class="form-control" id="id_bodega">
					<div class="form-group">
						<label for="nombre_bodega class="col-form-label">Nombre:</label>
						<input type="text" class="form-control" id="nombre_bodega">
					</div>
					<div class="form-group">
						<label for="direccion_bodega" class="col-form-label">Dirección:</label>
						<input type="text" class="form-control" id="direccion_bodega">
					</div>
					<div class="form-group">
						<label for="telefono_bodega" class="col-form-label">Teléfono:</label>
						<input type="text" class="form-control" id="telefono_bodega">
					</div>
					<div class="form-group">
						<label for="lista_depto" class=" col-form-label">Departamento:</label>
						<select class="form-control" id="lista_depto" name="lista_depto" required></select>
					</div>
					<div class="form-group">
						<label for="lista_ciudad" class=" col-form-label">Ciudad:</label>
						<select class="form-control" id="lista_ciudad" name="lista_ciudad" required></select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icono1 fas fa-times-circle"></i> Cancelar</button>
					<button type="submit" id="btnGuardar" class="btn btn-dark"><i class="icono1 fas fa-check-circle"></i> Guardar</button>
				</div>
			</form>
			</div>
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
	 
	<script type="text/javascript" src="js/main_bodegas.js"></script>

	<footer>
		<div class="container-fluid">
			<p class="text-center" style="margin-top:65px;">Copyright by <a href="#" target="_blank">Easy Solutions</a> <?php echo date("Y")?></p>
		</div>
	</footer>

</body>
</html>
