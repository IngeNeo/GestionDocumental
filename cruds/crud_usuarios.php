<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
	case 1: //alta
		$consulta = "INSERT INTO usuarios (nombre_usuario, apellido_usuario, cedula_usuario, telefono_usuario,
		email_usuario, password, Tipos_de_usuario_id_Tipo_usuario, Clientes_id_cliente) VALUES
		('$nombres','$apellidos','$cedula','$telefono','$email','', $tipo, $cliente)";			
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 2: //modificación
		$consulta = "UPDATE usuarios SET cedula_usuario='$cedula', nombre_usuario='$nombres', 
		apellido_usuario='$apellidos', telefono_usuario='$telefono', email_usuario='$email', 
		Tipos_de_usuario_id_Tipo_usuario='$tipo', Clientes_id_cliente='$cliente' 
		WHERE id_usuario='$id'";		
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 3://baja
		$consulta = "DELETE FROM usuarios WHERE id_usuario='$id' ";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
