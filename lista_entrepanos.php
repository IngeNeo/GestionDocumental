<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaEntrepano() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
    $piso = $_POST['piso'];
   	$consulta = "SELECT id_entrepano AS ID, descripcion_entrepano AS ENTREPANO 
				FROM entrepano WHERE Piso_id_piso = $piso 
				ORDER BY id_entrepano ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_entrepano = '<option value="" disabled selected>Seleccione el entrepaño...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
		$lista_entrepano .= "<option value = '$row[ID]'>$row[ENTREPANO]</option>";
	}
	return $lista_entrepano;
}
echo ListaEntrepano();
?>