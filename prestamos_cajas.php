<?php
ob_start();
session_start();
require_once 'config.php'; 
if(!isset($_SESSION['logged_in'])){
	header('Location: index.php');
}
$ClaseUsuario = $_SESSION['Tipos_de_usuario_id_Tipo_usuario'];
$Gestor = $_SESSION['Clientes_id_cliente'];
$id_usuario = $_SESSION['id_usuario'];
$Nombre_Gestor = $_SESSION['nombre_usuario'];
$Apellido_Gestor = $_SESSION['apellido_usuario'];
include_once 'conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

if($ClaseUsuario == "1"){//Administrador
	$consulta = "SELECT CJ.id_caja, CJ.serial_caja, CJ.descripcion_caja, UC.ubicacion_X, UC.ubicacion_Y, UC.ubicacion_Z, EI.nombre_estado_item, TC.nombre_tipo_caja, C.razon_social_cliente
			 FROM cajas CJ, estado_item EI, ubicacion_caja UC, tipo_caja TC, clientes C
			 WHERE CJ.Estado_item_id_estado_item = EI.id_estado_item
			 AND CJ.Tipo_caja_id_tipo_caja = TC.id_tipo_caja
			 AND CJ.Ubicacion_caja_id_ubicacion_caja = UC.id_ubicacion_caja
			 AND CJ.Clientes_id_cliente = C.id_cliente
			 AND CJ.Estado_item_id_estado_item = '1'
			 ORDER BY id_caja";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
} if ($ClaseUsuario == '2' or $ClaseUsuario == '3'){//Archivador
	$consulta1 = "SELECT CJ.id_caja, CJ.serial_caja, CJ.descripcion_caja, UC.ubicacion_X, UC.ubicacion_Y, UC.ubicacion_Z, EI.nombre_estado_item, TC.nombre_tipo_caja, C.razon_social_cliente
			 FROM cajas CJ, estado_item EI, ubicacion_caja UC, tipo_caja TC, clientes C
			 WHERE CJ.Estado_item_id_estado_item = EI.id_estado_item
			 AND CJ.Tipo_caja_id_tipo_caja = TC.id_tipo_caja
			 AND CJ.Ubicacion_caja_id_ubicacion_caja = UC.id_ubicacion_caja
			 AND CJ.Clientes_id_cliente = C.id_cliente
			 AND CJ.Clientes_id_cliente = '$Gestor'
			 AND CJ.Estado_item_id_estado_item = '1'
			 ORDER BY id_caja";
	$resultado = $conexion->prepare($consulta1);
	$resultado->execute();
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#" />
	<title>Modulo Prestamos Cajas</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!--datables CSS b??sico-->
	<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
	<!--datables estilo bootstrap 4 CSS-->
	<link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
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
				<h1 class="titulos text-center text-uppercase">Prestamos Cajas</h1>
			</div>
		</div>
	</header>
	<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tablaPrestamos" class="table table-striped table-bordered table-condensed"
						style="width:100%">
						<thead class="text-center">
							<tr>
								<th>ID</th>
								<th>Serial</th>
								<th>Descripci??n</th>
								<th>Ubicaci??n</th>
								<th>Estado</th>
								<th>Tipo caja</th>
								<th>Propietario</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($data as $dat) {
							?>
							<tr>
								<td><?php echo $dat['id_caja'] ?></td>
								<td><?php echo $dat['serial_caja'] ?></td>
								<td><?php echo $dat['descripcion_caja'] ?></td>
								<td><?php echo $dat['ubicacion_X'].$dat['ubicacion_Y'].$dat['ubicacion_Z']?></td>
								<td><?php echo $dat['nombre_estado_item'] ?></td>
								<td><?php echo $dat['nombre_tipo_caja'] ?></td>
								<td><?php echo $dat['razon_social_cliente'] ?></td>
								<td nowrap></td>
							</tr>
							<?php
								}
							?>
						</tbody>
						<tfoot class="text-center">
							<tr>
								<th>ID</th>
								<th>Serial</th>
								<th>Descripci??n</th>
								<th>Ubicaci??n</th>
								<th>Estado</th>
								<th>Tipo caja</th>
								<th>Propietario</th>
								<th style="display:none;"></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!--Modal para CRUD-->
	<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
							aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="formPrestamos">
					<div class="modal-body">
						<input type="hidden" class="form-control" id="gestor" value="<?php echo $Gestor; ?>">
						<input type="hidden" class="form-control" id="id_usuario" value="<?php echo $id_usuario; ?>">
						<input type="hidden" class="form-control" id="nombre_gestor" value="<?php echo $Nombre_Gestor; ?>">
						<input type="hidden" class="form-control" id="apellido_gestor" value="<?php echo $Apellido_Gestor; ?>">
						<input type="hidden" class="form-control" id="id_caja">
						<div class="form-group">
							<label for="serial_caja" class="col-form-label" disabled >Serial Caja:</label>
							<input type="text" class="form-control" id="serial_caja">
						</div>
						<div class="form-group">
							<label for="fecha_entrega" class="col-form-label">Fecha de entrega:</label>
							<input type="date" class="form-control" id="fecha_entrega">
						</div>
						<div class="form-group">
							<label for="lista_tipo_prestamos" class=" col-form-label">Tipo de prestamo:</label>
							<select class="form-control" id="lista_tipo_prestamos" name="lista_tipo_prestamos" required></select>
						</div>
						<div class="form-group">
							<label for="lista_prioridad_prestamo" class=" col-form-label">Prioridad de prestamo:</label>
							<select class="form-control" id="lista_prioridad_prestamo" name="lista_prioridad_prestamo" required></select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i
								class="icono1 fas fa-times-circle"></i> Cancelar</button>
						<button type="submit" id="btnGuardar" class="btn btn-dark"><i
								class="icono1 fas fa-check-circle"></i> Guardar</button>
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
	<script type="text/javascript" src="js/main_prestamos_cajas.js"></script>

	<footer>
		<div class="container-fluid">
			<p class="text-center" style="margin-top:65px;">Copyright by <a href="#" target="_blank">Easy Solutions</a> <?php echo date("Y")?></p>
		</div>
	</footer>

</body>

</html>