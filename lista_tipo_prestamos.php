<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaTipoPrestamo() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_tipo_prestamo AS ID, nombre_tipo_prestamo AS TIPOPRES 
				FROM tipo_de_prestamo ORDER BY id_tipo_prestamo ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_tipo_prestamo = '<option value="" disabled selected>Seleccione el tipo de prestamo...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_tipo_prestamo .= "<option value = '$row[TIPOPRES]'>$row[TIPOPRES]</option>";
	}
	return $lista_tipo_prestamo;
}
echo ListaTipoPrestamo();
?>