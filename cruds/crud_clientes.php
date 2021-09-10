<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nit = (isset($_POST['nit'])) ? $_POST['nit'] : '';
$razon = (isset($_POST['razon'])) ? $_POST['razon'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
	case 1: //alta
		$consulta = "INSERT INTO clientes (nit_cliente, razon_social_cliente, direccion_cliente, telefono_cliente,
		email_cliente, Municipios_id_municipio) VALUES
		('$nit','$razon','$direccion','$telefono','$email', $ciudad)";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 2: //modificación
		$consulta = "UPDATE clientes SET nit_cliente='$nit', razon_social_cliente='$razon', 
		direccion_cliente='$direccion', telefono_cliente='$telefono', email_cliente='$email', 
		Municipios_id_municipio='$ciudad' 
		WHERE id_cliente='$id'";		
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 3://baja
		$consulta = "DELETE FROM clientes WHERE id_cliente='$id' ";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
