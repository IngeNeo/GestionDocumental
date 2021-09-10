<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaDeptos() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_departamento AS ID, departamento AS DEPTO 
				FROM departamento ORDER BY departamento ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_deptos = '<option value="" disabled selected>Seleccione el Departamento...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_deptos .= "<option value = '$row[ID]'>$row[DEPTO]</option>";
	}
	return $lista_deptos;
}
echo ListaDeptos();
?>