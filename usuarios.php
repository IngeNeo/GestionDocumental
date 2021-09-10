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
	$consulta = "SELECT U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.cedula_usuario, U.telefono_usuario, U.email_usuario, TU.nombre_tipo_usuario, C.razon_social_cliente 
				 FROM usuarios U, tipos_de_usuario TU, clientes C 
				 WHERE  U.Tipos_de_usuario_id_Tipo_usuario = TU.id_Tipo_usuario AND U.Clientes_id_cliente=C.id_cliente 
				 ORDER BY id_usuario";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
} if ($ClaseUsuario == '2' or $ClaseUsuario == '3'){//Archivador
		$consulta1 = "SELECT U.id_usuario, U.nombre_usuario, U.apellido_usuario, U.cedula_usuario, U.telefono_usuario, U.email_usuario, TU.nombre_tipo_usuario, C.razon_social_cliente 
					  FROM usuarios U, tipos_de_usuario TU, clientes C 
					  WHERE  U.Tipos_de_usuario_id_Tipo_usuario = TU.id_Tipo_usuario AND U.Clientes_id_cliente=C.id_cliente
					  AND  U.Clientes_id_cliente = $Gestor
					  ORDER BY id_usuario";
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
	<title>Modulo Usuarios</title>
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
				<h1 class="titulos text-center text-uppercase">Administración de Usuarios</h1>
			</div>
		</div>
	</header>
	<BR>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<br>
				<?php if ($ClaseUsuario == '1' || $ClaseUsuario == '2'){
				echo "<button id='btnNuevo' type='button' class='btn btn-success' data-toggle='modal'>
				<i class='icono1 fas fa-plus-circle'></i> Nuevo Usuario</button>";} ?>
			</div>
		</div>
	</div>
	<br>
	<div class="container-fluid">
		<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
						<thead class="text-center">
							<tr>
								<th>ID</th>
								<th>Identificación</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Teléfono</th>
								<th>E-mail</th>
								<th>Tipo</th>
								<th>Cliente</th>
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
								<td><?php echo $dat['id_usuario'] ?></td>
								<td><?php echo $dat['cedula_usuario'] ?></td>
								<td><?php echo $dat['nombre_usuario'] ?></td>
								<td><?php echo $dat['apellido_usuario'] ?></td>
								<td><?php echo $dat['telefono_usuario'] ?></td>
								<td><?php echo $dat['email_usuario'] ?></td>
								<td><?php echo $dat['nombre_tipo_usuario'] ?></td>
								<td><?php echo $dat['razon_social_cliente'] ?></td>
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
								<th>Identificación</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Teléfono</th>
								<th>E-mail</th>
								<th>Tipo</th>
								<th>Cliente</th>
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
			<form id="formPersonas">
				<div class="modal-body">
					<input type="hidden" class="form-control" id="gestor" value="<?php echo $ClaseUsuario; ?>">
					<div class="form-group">
						<label for="id_usuario" class="col-form-label">ID:</label>
						<input type="text" class="form-control" id="id_usuario" disabled>
					</div>
					<div class="form-group">
						<label for="cedula_usuario" class="col-form-label">Cedula:</label>
						<input type="text" class="form-control" id="cedula_usuario">
					</div>
					<div class="form-group">
						<label for="nombre_usuario" class="col-form-label">Nombres:</label>
						<input type="text" class="form-control" id="nombre_usuario">
					</div>
					<div class="form-group">
						<label for="apellido_usuario" class="col-form-label">Apellidos:</label>
						<input type="text" class="form-control" id="apellido_usuario">
					</div>
					<div class="form-group">
						<label for="telefono_usuario" class="col-form-label">Teléfono:</label>
						<input type="text" class="form-control" id="telefono_usuario">
					</div>
					<div class="form-group">
						<label for="email_usuario" class="col-form-label">E-mail:</label>
						<input type="mail" class="form-control" id="email_usuario">
					</div>
					<div class="form-group">
						<label for="tipo_usuario" class=" col-form-label">Tipo de usuario:</label>
						<select class="form-control" id="tipo_usuario" name="tipo_usuario" required></select>
					</div>
					<div class="form-group">
						<label for="nombre_cliente" class=" col-form-label">Cliente:</label>
						<select class="form-control" id="nombre_cliente" name="nombre_cliente" required></select>
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
	<!-- <script src="jquery/jquery-3.4.1.js"></script> -->
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
	 
	<script type="text/javascript" src="js/main_usuarios.js"></script>

	<footer>
		<div class="container-fluid">
			<p class="text-center" style="margin-top:65px;">Copyright by <a href="#" target="_blank">Easy Solutions</a> <?php echo date("Y")?></p>
		</div>
	</footer>

</body>

</html>
