<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$id_objeto = (isset($_POST['id_objeto'])) ? $_POST['id_objeto'] : '';
$objeto_prestamo = (isset($_POST['objeto_prestamo'])) ? $_POST['objeto_prestamo'] : '';
$nombre_usuario = (isset($_POST['nombre_usuario'])) ? $_POST['nombre_usuario'] : '';
$apellido_usuario = (isset($_POST['apellido_usuario'])) ? $_POST['apellido_usuario'] : '';
$fecha = date('Y-m-d h:i:s A');
$opcion = 1;

switch ($opcion) {

    case 1: //Devolver folios

        $consulta = "UPDATE folio SET Estado_item_id_estado_item ='1' WHERE id_folio = '$id_objeto'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta1 = "UPDATE prestamo SET Estado_prestamo = 'Cerrado' , fecha_modificacion =  'Cerrado por $nombre_usuario $apellido_usuario el $fecha' WHERE id_prestamo = '$id'";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();

        break;
}

$conexion = NULL;
