<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaCaras() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
    $estante = $_POST['estante'];
   	$consulta = "SELECT id_cara AS ID, 	descripcion_cara AS CARA 
				FROM cara WHERE Estante_id_estante = $estante 
				ORDER BY id_cara ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_caras = '<option value="" disabled selected>Seleccione la cara...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_caras .= "<option value = '$row[ID]'>$row[CARA]</option>";
	}
	return $lista_caras;
}
echo ListaCaras();
?>