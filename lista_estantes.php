<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaEstantes() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
    $bodega = $_POST['bodega'];
    $consulta = "SELECT id_estante AS ID, descripcion_estante AS ESTANTE 
				FROM estante WHERE Bodega_id_bodega = $bodega 
				ORDER BY id_estante ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_estantes = '<option value="" disabled selected>Seleccione el estante...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_estantes .= "<option value = '$row[ID]'>$row[ESTANTE]</option>";
	}
	return $lista_estantes;
}
echo ListaEstantes();
?>