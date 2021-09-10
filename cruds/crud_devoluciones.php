<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$id_objeto = (isset($_POST['id_objeto'])) ? $_POST['id_objeto'] : '';
$objeto_prestamo = (isset($_POST['objeto_prestamo'])) ? $_POST['objeto_prestamo'] : '';

$opcion = '';
if ($objeto_prestamo == 'cajas') {
	$opcion = 1;
} else if ($objeto_prestamo == 'carpeta') {
	$opcion = 2;
} else if ($objeto_prestamo == 'folio') {
	$opcion = 3;
}

switch($opcion){
	
	case 1: //Devolver cajas
		
		$consulta = "UPDATE cajas SET Estado_item_id_estado_item ='1' WHERE id_caja = '$id_objeto'";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		
		$consulta1 = "UPDATE prestamo SET Estado_prestamo = 'Cerrado' WHERE id_prestamo = '$id'";
		$resultado1 = $conexion->prepare($consulta1);
		$resultado1->execute();
	
	case 2: //Devolver carpeta
	
		$consulta = "UPDATE carpeta SET Estado_item_id_estado_item ='1' WHERE id_carpeta = '$id_objeto'";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		
		$consulta1 = "UPDATE prestamo SET Estado_prestamo = 'Cerrado' WHERE id_prestamo = '$id'";
		$resultado1 = $conexion->prepare($consulta1);
		$resultado1->execute();

	case 3: //Devolver cajas
	
		$consulta = "UPDATE folio SET Estado_item_id_estado_item ='1' WHERE id_folio = '$id_objeto'";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		
		$consulta1 = "UPDATE prestamo SET Estado_prestamo = 'Cerrado' WHERE id_prestamo = '$id'";
		$resultado1 = $conexion->prepare($consulta1);
		$resultado1->execute();

	break;

}

$conexion = NULL;
