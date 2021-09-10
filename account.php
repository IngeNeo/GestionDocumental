<?php
ob_start();
session_start();
require_once 'config.php';
require_once 'Cl/User.php';
require_once 'Cl/DBclass.php';

if(!isset($_SESSION['logged_in'])){
	header('Location: index.php');
}

if( !empty( $_POST )){
    try {
        $user_obj = new Cl_User();
        $data = $user_obj->account( $_POST );
        if($data)$success = PASSOWRD_CHANAGE_SUCCESS;
    } catch (Exception $e) {
        $error = $e->getMessage();
    } 
}
?>
<!doctype html>
<html lang="es">
  <head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="#" />  
	<title>Mi Cuenta</title>
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
				<h1 class="titulos text-center text-uppercase">Mi cuenta</h1>
			</div>
		</div>
	</header>
	<div class="content">
     	<div class="container">
     		<div class="col-md-8 col-sm-8 col-xs-12">
     			<?php require_once 'message.php';?>
     			<h1>Mi cuenta:</h1><br>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="account-form" method="post" class="form-horizontal myaccount" role="form">
					<div class="form-group">
						<span for="inputEmail3" class="col-sm-4 control-span">Nombres</span>
						<div class="col-sm-8">
							<p> <?php echo $_SESSION['nombre_usuario'];  ?> </p>
						</div>
					</div>
					<div class="form-group">
						<span for="inputPassword3" class="col-sm-4 control-span">Correo electrónico</span>
						<div class="col-sm-8">
							<p> <?php echo $_SESSION['email_usuario']; ?> </p>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<span for="inputPassword3" class="col-sm-4 control-span">Contraseña Actual</span>
						<div class="col-sm-8">
							<input name="old_password" id="old_password" type="text">
							<span class="help-block"></span>
						</div>
					</div>
					
					<div class="form-group">
						<span for="inputPassword3" class="col-sm-4 control-span"> Nueva Contraseña</span>
						<div class="col-sm-8">
							<input name="password" id="password" type="text">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<span for="inputPassword3" class="col-sm-4 control-span"> Confirmar Contraseña</span>
						<div class="col-sm-8">
							<input name="confirm_password" id="confirm_password" type="text">
							<span class="help-block"></span>
						</div>
					</div>
					<input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
					<input type="hidden" id="email" value="<?php echo $_SESSION['email_usuario']; ?>" />
					
					
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<button type="submit" class="btn btn-default" id="submit_btn" data-loading-text="Cambiando contraseña....">Cambiar Contraseña</button>
						</div>
					</div>
				</form>
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
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/account.js"></script> 
</body>
</html>