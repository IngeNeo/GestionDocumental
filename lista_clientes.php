<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaClientes() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	$consulta = "SELECT id_cliente AS TIPO, razon_social_cliente AS NOMBRE 
				FROM clientes ORDER BY id_cliente ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_clientes = '<option value="" disabled selected>Seleccione el Cliente...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_clientes .= "<option value = '$row[TIPO]'>$row[NOMBRE]</option>";
	}
	return $lista_clientes;
}
echo ListaClientes();
?>