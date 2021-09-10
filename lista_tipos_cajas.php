<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaTipoCaja() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_tipo_caja AS ID, nombre_tipo_caja AS NOMBRE 
				FROM tipo_caja ORDER BY id_tipo_caja ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_tipo_cajas = '<option value="" disabled selected>Seleccione el tipo de caja...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_tipo_cajas .= "<option value = '$row[ID]'>$row[NOMBRE]</option>";
	}
	return $lista_tipo_cajas;
}
echo ListaTipoCaja();
?>