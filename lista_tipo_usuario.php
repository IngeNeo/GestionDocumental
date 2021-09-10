<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaTipoUsuario() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_tipo_usuario AS TIPO, nombre_tipo_usuario AS NOMBRE 
				FROM tipos_de_usuario ORDER BY nombre_tipo_usuario ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_tipo_usuario = '<option value="" disabled selected>Seleccione el Tipo...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_tipo_usuario .= "<option value = '$row[TIPO]'>$row[NOMBRE]</option>";
	}
	return $lista_tipo_usuario;
}
echo ListaTipoUsuario();
?>