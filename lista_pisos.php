<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaPiso() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
    $modulo = $_POST['modulo'];
    $consulta = "SELECT id_piso AS ID, descripcion_piso AS PISO 
				FROM piso WHERE Modulo_id_modulo = $modulo 
				ORDER BY id_piso ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_pisos = '<option value="" disabled selected>Seleccione el piso...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_pisos .= "<option value = '$row[ID]'>$row[PISO]</option>";
	}
	return $lista_pisos;
}
echo ListaPiso();
?>