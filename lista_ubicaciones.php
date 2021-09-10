<?php

$fecha = date('Y-m-d');
$anio = date("Y", strtotime($fecha));

function ListaUbicaciones() {
	include_once 'conexion/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
    $entrepano = $_POST['entrepano'];
    $consulta = "SELECT id_ubicacion_caja AS ID, ubicacion_X AS X, ubicacion_Y AS Y, ubicacion_Z AS Z 
				FROM ubicacion_caja WHERE Entrepano_id_entrepano = $entrepano and estado_ubicacion = '1'
				ORDER BY id_ubicacion_caja ASC";
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	$lista_ubicaciones = '<option value="" disabled selected>Seleccione la ubicación para la caja...</option>';
	while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $lista_ubicaciones .= "<option value = '$row[ID]'>Ubicaciones en XYZ - $row[X]- $row[Y] - $row[Z]</option>";
	}
	return $lista_ubicaciones;
}
echo ListaUbicaciones();
?>