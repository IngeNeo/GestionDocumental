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

    case 1: //Devolver cajas

        $consulta = "UPDATE cajas SET Estado_item_id_estado_item ='1' WHERE id_caja = '$id_objeto'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta1 = "UPDATE prestamo SET Estado_prestamo = 'Cerrado', fecha_modificacion =  'Cerrado por $nombre_usuario $apellido_usuario el $fecha' WHERE id_prestamo = '$id'";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();

        $consulta2 = "SELECT id_carpeta FROM carpeta WHERE Cajas_id_caja = $id_objeto";
        $resultado2 = $conexion->prepare($consulta2);
        $resultado2->execute();

        $data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data2 as $dat2) {
            $cod_carpeta = $dat2['id_carpeta'];
            $consulta3 = "UPDATE carpeta SET Estado_item_id_estado_item = '1' WHERE id_carpeta='$cod_carpeta'";
            $resultado3 = $conexion->prepare($consulta3);
            $resultado3->execute();

            $consulta4 = "SELECT id_folio FROM folio WHERE Carpeta_id_carpeta = $cod_carpeta";
            $resultado4 = $conexion->prepare($consulta4);
            $resultado4->execute();

            $data4 = $resultado4->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data4 as $dat4) {
                $cod_folio = $dat4['id_folio'];
                $consulta5 = "UPDATE folio SET Estado_item_id_estado_item = '1'	WHERE id_folio='$cod_folio'";
                $resultado5 = $conexion->prepare($consulta5);
                $resultado5->execute();
            }
        }

        break;
}

$conexion = NULL;
