<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaPrioridadPrestamo() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_prioridad AS ID, nombre_prioridad AS NOMPRI 
				FROM prioridad_prestamo ORDER BY id_prioridad ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_prioridad_prestamo = '<option value="" disabled selected>Seleccione la prioridad del prestamo...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_prioridad_prestamo .= "<option value = '$row[NOMPRI]'>$row[NOMPRI]</option>";
	}
	return $lista_prioridad_prestamo;
}
echo ListaPrioridadPrestamo();
?>