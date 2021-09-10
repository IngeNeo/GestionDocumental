<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$serial = (isset($_POST['serial'])) ? $_POST['serial'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$carpeta = (isset($_POST['carpeta'])) ? $_POST['carpeta'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
	case 1: //alta
		$consulta = "INSERT INTO folio (codigo_folio, desc_folio, Carpeta_id_carpeta, Estado_item_id_estado_item) VALUES
		('$serial', '$descripcion', '$carpeta', 1)";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 2: //modificación
		$consulta = "UPDATE folio SET codigo_folio='$serial', desc_folio ='$descripcion', Carpeta_id_carpeta='$carpeta' 
		WHERE id_folio='$id'";		
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 3://baja
		$consulta = "DELETE FROM folio WHERE id_folio='$id' ";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
