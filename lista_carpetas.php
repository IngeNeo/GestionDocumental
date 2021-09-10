<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaCarpeta() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$caja = $_POST['caja'];
	$consulta = "SELECT id_carpeta AS ID, codigo_carpeta AS CARPETA 
				FROM carpeta WHERE Cajas_id_caja = $caja 
				ORDER BY id_carpeta ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_carpetas = '<option value="" disabled selected>Seleccione la carpeta...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_carpetas .= "<option value = '$row[ID]'>$row[CARPETA]</option>";
	}
	return $lista_carpetas;
}
echo ListaCarpeta();
?>