<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
	case 1: //alta
		$consulta = "INSERT INTO bodega (nombre_bodega, direccion_bodega, telefono_bodega, 
		Municipios_id_municipio) VALUES
		('$nombre', '$direccion', '$telefono', '$ciudad')";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 2: //modificación
		$consulta = "UPDATE bodega SET nombre_bodega='$nombre', direccion_bodega='$direccion', 
		telefono_bodega='$telefono', Municipios_id_municipio='$ciudad' 
		WHERE id_bodega='$id'";		
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 3://baja
		$consulta = "DELETE FROM bodega WHERE id_bodega='$id' ";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
