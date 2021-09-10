<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaCajas() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_caja AS ID, serial_caja AS CAJA 
				FROM cajas ORDER BY serial_caja ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_cajas = '<option value="" disabled selected>Seleccione la caja...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_cajas .= "<option value = '$row[ID]'>$row[CAJA]</option>";
	}
	return $lista_cajas;
}
echo ListaCajas();
?>