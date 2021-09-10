<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaBodegas() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_bodega AS ID, nombre_bodega AS BODEGA 
				FROM bodega ORDER BY nombre_bodega ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_bodegas = '<option value="" disabled selected>Seleccione la bodega...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_bodegas .= "<option value = '$row[ID]'>$row[BODEGA]</option>";
	}
	return $lista_bodegas;
}
echo ListaBodegas();
?>