<?php
ob_start();
session_start();
require_once 'config.php'; 
if(!isset($_SESSION['logged_in'])){
	header('Location: index.php');
}
$ClaseUsuario = $_SESSION['Tipos_de_usuario_id_Tipo_usuario'];
$Gestor = $_SESSION['Clientes_id_cliente'];
$Nombre_Gestor = $_SESSION['nombre_usuario'];
$Apellido_Gestor = $_SESSION['apellido_usuario'];
include_once 'conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
if($ClaseUsuario == "1"){//Administrador
	$consulta = "SELECT P.id_prestamo, P.objeto_prestamo, P.id_objeto, P.fecha_solicitud, P.fecha_entrega, P.estado_prestamo, U.nombre_usuario, U.apellido_usuario, P.Tipo_de_prestamo, P.Prioridad_prestamo
				 FROM prestamo P, usuarios U
				 WHERE P.estado_prestamo = 'Abierto'
				 AND P.Usuarios_id_usuario = U.id_usuario
				 ORDER BY id_prestamo";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}if ($ClaseUsuario == '2'){//Archivador
	$consulta1 = "SELECT P.id_prestamo, P.objeto_prestamo, P.id_objeto, P.fecha_solicitud, P.fecha_entrega, P.estado_prestamo, U.nombre_usuario, U.apellido_usuario, P.Tipo_de_prestamo, P.Prioridad_prestamo
				  FROM prestamo P, usuarios U
				  WHERE P.estado_prestamo = 'Abierto'
				  AND P.Usuarios_id_usuario = U.id_usuario
				  AND  U.Clientes_id_cliente = $Gestor
				  ORDER BY id_prestamo";
	$resultado = $conexion->prepare($consulta1);
	$resultado->execute();
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}
if ($ClaseUsuario == '3'){//Cliente
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
		<title>Modulo Devoluciones</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!--datables CSS básico-->
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
				<h1 class="titulos text-center text-uppercase">Devoluciones</h1>
			</div>
		</div>
	</header>
	<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id="tablaDevoluciones" class="table table-striped table-bordered table-condensed"
						style="width:100%">
						<thead class="text-center">
							<tr>
								<th>ID</th>
								<th>Objeto Prestamo</th>
								<th>ID Objeto</th>
								<th>Fecha Solicitud</th>
								<th>Fecha Entrega</th>
								<th>Estado del Prestamo</th>
								<th>Usuario Solicitud</th>
								<th>Tipo de prestamo</th>
								<th>Prioridad prestamo</th>                                
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($data as $dat) {
							?>
							<tr>
								<td><?php echo $dat['id_prestamo'] ?></td>
								<td><?php echo $dat['objeto_prestamo'] ?></td>
								<td><?php echo $dat['id_objeto'] ?></td>
								<td><?php echo $dat['fecha_solicitud'] ?></td>								
								<td><?php echo $dat['fecha_entrega'] ?></td>
								<td><?php echo $dat['estado_prestamo'] ?></td>
								<td><?php echo $dat['nombre_usuario']."    ".$dat['apellido_usuario']?></td>
								<td><?php echo $dat['Tipo_de_prestamo'] ?></td>
								<td><?php echo $dat['Prioridad_prestamo'] ?></td>
								<td nowrap></td>
							</tr>
							<?php
								}
							?>
						</tbody>
						<tfoot class="text-center">
							<tr>
								<th>ID</th>
								<th>Objeto Prestamo</th>
								<th>ID Objeto</th>
								<th>Fecha Solicitud</th>
								<th>Fecha Entrega</th>
								<th>Estado del Prestamo</th>
								<th>Usuario Solicitud</th>
								<th>Tipo de prestamo</th>
								<th>Prioridad prestamo</th>  
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
				<form id="formDevoluciones">
					<div class="modal-body">
						<input type="hidden" class="form-control" id="gestor" value="<?php echo $Gestor; ?>">
						<input type="hidden" class="form-control" id="nombre_gestor" value="<?php echo $Nombre_Gestor; ?>">
						<input type="hidden" class="form-control" id="apellido_gestor" value="<?php echo $Apellido_Gestor; ?>">
						<input type="hidden" class="form-control" id="id_prestamo" value="<?php echo $dat['id_prestamo']; ?>">
						<input type="hidden" class="form-control" id="id_objeto" value="<?php echo $dat['id_objeto']; ?>">
						<input type="hidden" class="form-control" id="objeto_prestamo" value="<?php echo $dat['objeto_prestamo'] ?>">
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
	<script type="text/javascript" src="js/main_devoluciones.js"></script>

	<footer>
		<div class="container-fluid">
			<p class="text-center" style="margin-top:65px;">Copyright by <a href="#" target="_blank">Easy Solutions</a> <?php echo date("Y")?></p>
		</div>
	</footer>

</body>

</html>