<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaModulo() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
    $cara = $_POST['cara'];
   	$consulta = "SELECT id_modulo AS ID, descripcion_modulo AS MODULO 
				FROM modulo WHERE Cara_id_cara = $cara 
				ORDER BY id_modulo ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_modulos = '<option value="" disabled selected>Seleccione el modulo...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_modulos .= "<option value = '$row[ID]'>$row[MODULO]</option>";
	}
	return $lista_modulos;
}
echo ListaModulo();
?>