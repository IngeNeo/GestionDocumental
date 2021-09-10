<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaCiudad() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$depto = $_POST['depto'];
	$consulta = "SELECT id_municipio AS ID, municipio AS CIUDAD 
				FROM municipios WHERE Departamento_id_departamento = $depto AND estado = 1 
				ORDER BY municipio ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_ciudad = '<option value="" disabled selected>Seleccione la Ciudad...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_ciudad .= "<option value = '$row[ID]'>$row[CIUDAD]</option>";
	}
	return $lista_ciudad;
}
echo ListaCiudad();
?>