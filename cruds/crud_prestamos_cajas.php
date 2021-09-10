<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepci&Atilde;&sup3;n de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$objeto = "cajas";
$estado = "Abierto";
$fecha = date('Y-m-d h:i:s A');
$fecha_ent = (isset($_POST['fecha_ent'])) ? $_POST['fecha_ent'] : '';
$tipo_prestamo = (isset($_POST['tipo_prestamo'])) ? $_POST['tipo_prestamo'] : '';
$prioridad_prestamo = (isset($_POST['prioridad_prestamo'])) ? $_POST['prioridad_prestamo'] : '';
$id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$nombre_usuario = (isset($_POST['nombre_usuario'])) ? $_POST['nombre_usuario'] : '';
$apellido_usuario = (isset($_POST['apellido_usuario'])) ? $_POST['apellido_usuario'] : '';
$email_usuario = (isset($_POST['email_usuario'])) ? $_POST['email_usuario'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch ($opcion) {
    case 1: //Prestar
        $consulta = "INSERT INTO prestamo (objeto_prestamo, id_objeto, fecha_solicitud, fecha_entrega, estado_prestamo, Usuarios_id_usuario, Tipo_de_prestamo, Prioridad_prestamo, fecha_modificacion) 
		VALUES('$objeto', '$id', '$fecha', '$fecha_ent', '$estado', '$id_usuario', '$tipo_prestamo', '$prioridad_prestamo', 'Creacion de $nombre_usuario $apellido_usuario el $fecha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $consulta1 = "UPDATE cajas SET Estado_item_id_estado_item='2' WHERE id_caja='$id'";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();

        $consulta2 = "SELECT id_carpeta FROM carpeta WHERE Cajas_id_caja = $id";
        $resultado2 = $conexion->prepare($consulta2);
        $resultado2->execute();

        $data2 = $resultado2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data2 as $dat2) {
            $cod_carpeta = $dat2['id_carpeta'];
            $consulta3 = "UPDATE carpeta SET Estado_item_id_estado_item = '2' WHERE id_carpeta='$cod_carpeta'";
            $resultado3 = $conexion->prepare($consulta3);
            $resultado3->execute();

            $consulta4 = "SELECT id_folio FROM folio WHERE Carpeta_id_carpeta = $cod_carpeta";
            $resultado4 = $conexion->prepare($consulta4);
            $resultado4->execute();

            $data4 = $resultado4->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data4 as $dat4) {
                $cod_folio = $dat4['id_folio'];
                $consulta5 = "UPDATE folio SET Estado_item_id_estado_item = '2'	WHERE id_folio='$cod_folio'";
                $resultado5 = $conexion->prepare($consulta5);
                $resultado5->execute();
            }
        }


        $consulta6 = "SELECT id_caja, serial_caja As Codigo1, descripcion_caja AS Codigo2, nombre_bodega AS Bodega, telefono_bodega, descripcion_estante AS Estante, descripcion_cara AS Cara, descripcion_modulo AS Modulo,
			descripcion_piso AS Piso, descripcion_entrepano AS Entrepano, ubicacion_X AS Ubicacion_X, ubicacion_Y AS piso_Y, ubicacion_Z AS fondo_Z       
			FROM bodega, estante, cara, modulo, piso, entrepano, ubicacion_caja, cajas
			WHERE id_bodega = Bodega_id_bodega
			AND id_estante = Estante_id_estante
			AND id_cara = Cara_id_cara
			AND id_modulo = Modulo_id_modulo
			AND id_piso = Piso_id_piso
			AND id_entrepano = Entrepano_id_entrepano
			AND id_ubicacion_caja = Ubicacion_caja_id_ubicacion_caja
			AND id_caja = $id";
        $resultado6 = $conexion->prepare($consulta6);
        $resultado6->execute();

        $data6 = $resultado6->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data6 as $dat6) {
            $serial_caja = $dat6['Codigo1'];
            $descripcion_caja = $dat6['Codigo2'];
            $nombre_bodega = $dat6['Bodega'];
            $telefono_bodega = $dat6['telefono_bodega'];
            $descripcion_estante = $dat6['Estante'];
            $descripcion_cara = $dat6['Cara'];
            $descripcion_modulo = $dat6['Modulo'];
            $descripcion_piso = $dat6['Piso'];
            $descripcion_entrepano = $dat6['Entrepano'];
            $ubicacion_X = $dat6['Ubicacion_X'];
            $ubicacion_Y = $dat6['piso_Y'];
            $ubicacion_Z = $dat6['fondo_Z'];
        }

        $consulta7 = "SELECT razon_social_cliente As nombre FROM clientes WHERE id_cliente=$cliente";
        $resultado7 = $conexion->prepare($consulta7);
        $resultado7->execute();

        $data7 = $resultado7->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data7 as $dat7) {
            $nombre_cliente = $dat7['nombre'];
        }



        $to = "$email_usuario,wms@siglo21.com.co,gestor@docsiglo21.com.co";
        $subject = "Nueva solicitud de prestamo de Cajas";
        $txt = "<div style='background-color: rgb(255, 255, 255); padding: 10px; border: 3px black double; border-radius: 15px 15px 0px 0px;'>
					<img src='http://www.docsiglo21.com/img/logo.png' width='418' height='150'>
					<h1 style='color: rgb(0, 0, 0);'> Nueva solicitud de prestamo de Cajas</h1>
				</div>
				<div style='background-color: rgb(255, 255, 255); padding: 10px; border: 3px black double; border-radius: 0px 0px 15px 15px;'>
					<h1><span style='color: rgb(0, 0, 0)'>Prestamo de :</span><span style='color: rgb(0, 0, 0)'> $objeto</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Codigo de caja :</span><span style='color: rgb(0, 0, 0)'> $serial_caja</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Codigo de custodia :</span><span style='color: rgb(0, 0, 0)'> $descripcion_caja</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Bodega :</span><span style='color: rgb(0, 0, 0)'> $nombre_bodega</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Tel&Atilde;&copy;fono bodega :</span><span style='color: rgb(0, 0, 0)'> $telefono_bodega</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Estante :</span><span style='color: rgb(0, 0, 0)'> $descripcion_estante</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Cara :</span><span style='color: rgb(0, 0, 0)'> $descripcion_cara</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>M&Atilde;&sup3;dulo :</span><span style='color: rgb(0, 0, 0)'> $descripcion_modulo</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Piso :</span><span style='color: rgb(0, 0, 0)'> $descripcion_piso</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Entrepa&Atilde;&plusmn;o :</span><span style='color: rgb(0, 0, 0)'> $descripcion_entrepano</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Ubicaci&Atilde;&sup3;n en X :</span><span style='color: rgb(0, 0, 0)'> $ubicacion_X</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Piso en Y :</span><span style='color: rgb(0, 0, 0)'> $ubicacion_Y</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Fondo en Z :</span><span style='color: rgb(0, 0, 0)'> $ubicacion_Z</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Cliente Propietario :</span><span style='color: rgb(0, 0, 0)'> $nombre_cliente</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Usuario Solicitud :</span><span style='color: rgb(0, 0, 0)'> $nombre_usuario $apellido_usuario</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Tipo de prestamo :</span><span style='color: rgb(0, 0, 0)'> $tipo_prestamo</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Prioridad del prestamo :</span><span style='color: rgb(0, 0, 0)'> $prioridad_prestamo</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Fecha de solicitud :</span><span style='color: rgb(0, 0, 0)'> $fecha</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Fecha de entrega :</span><span style='color: rgb(0, 0, 0)'> $fecha_ent</span></h1>
				</div>";
        $headers =  "MIME=version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "From: wms@siglo21.com.co";
        mail($to, $subject, $txt, $headers);
        break;
}

$conexion = NULL;
