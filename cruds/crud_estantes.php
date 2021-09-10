<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$cara = (isset($_POST['cara'])) ? $_POST['cara'] : '';
$modulo = (isset($_POST['modulo'])) ? $_POST['modulo'] : '';
$piso = (isset($_POST['piso'])) ? $_POST['piso'] : '';
$entrepano = (isset($_POST['entrepano'])) ? $_POST['entrepano'] : '';
$bodega = (isset($_POST['bodega'])) ? $_POST['bodega'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
	case 1: //alta
		$consulta = "INSERT INTO estante (cara, modulo, piso, entrepano, Bodega_id_bodega) VALUES
		('$cara', '$modulo', '$piso', '$entrepano', '$bodega')";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 2: //modificación
		$consulta = "UPDATE estante SET cara='$cara', modulo='$modulo', piso='$piso', entrepano='$entrepano', Bodega_id_bodega='$bodega' 
		WHERE id_estante='$id'";		
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;
	case 3://baja
		$consulta = "DELETE FROM estante WHERE id_estante='$id' ";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
	break;}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
