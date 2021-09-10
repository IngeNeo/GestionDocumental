<?php
include_once '../conexion/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepci&Atilde;&sup3;n de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$objeto = "folio";
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
        $consulta1 = "UPDATE folio SET Estado_item_id_estado_item='2' 
		WHERE id_folio='$id'";
        $resultado1 = $conexion->prepare($consulta1);
        $resultado1->execute();

        $consulta2 = "SELECT codigo_folio AS Folio, codigo_carpeta AS Carpeta, serial_caja As Codigo1, descripcion_caja AS Codigo2, nombre_bodega AS Bodega, telefono_bodega, descripcion_estante AS Estante, descripcion_cara AS Cara, descripcion_modulo AS Modulo,
			descripcion_piso AS Piso, descripcion_entrepano AS Entrepano, ubicacion_X AS Ubicacion_X, ubicacion_Y AS piso_Y, ubicacion_Z AS fondo_Z       
			FROM bodega, estante, cara, modulo, piso, entrepano, ubicacion_caja, cajas, carpeta, folio
			WHERE id_bodega = Bodega_id_bodega
			AND id_estante = Estante_id_estante
			AND id_cara = Cara_id_cara
			AND id_modulo = Modulo_id_modulo
			AND id_piso = Piso_id_piso
			AND id_entrepano = Entrepano_id_entrepano
			AND id_ubicacion_caja = Ubicacion_caja_id_ubicacion_caja
			AND id_caja = Cajas_id_caja
			AND id_carpeta = Carpeta_id_carpeta
			AND id_folio=$id";
        $resultado2 = $conexion->prepare($consulta2);
        $resultado2->execute();

        $data = $resultado2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $dat) {
            $folio = $dat['Folio'];
            $carpeta = $dat['Carpeta'];
            $serial_caja = $dat['Codigo1'];
            $descripcion_caja = $dat['Codigo2'];
            $nombre_bodega = $dat['Bodega'];
            $telefono_bodega = $dat['telefono_bodega'];
            $descripcion_estante = $dat['Estante'];
            $descripcion_cara = $dat['Cara'];
            $descripcion_modulo = $dat['Modulo'];
            $descripcion_piso = $dat['Piso'];
            $descripcion_entrepano = $dat['Entrepano'];
            $ubicacion_X = $dat['Ubicacion_X'];
            $ubicacion_Y = $dat['piso_Y'];
            $ubicacion_Z = $dat['fondo_Z'];
        }

        $consulta3 = "SELECT razon_social_cliente As nombre FROM clientes WHERE id_cliente=$cliente";
        $resultado3 = $conexion->prepare($consulta3);
        $resultado3->execute();

        $data3 = $resultado3->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data3 as $dat3) {
            $nombre_cliente = $dat3['nombre'];
        }

        $to = "$email_usuario,wms@siglo21.com.co,gestor@docsiglo21.com.co";
        $subject = "Nueva solicitud de prestamo de Folios";
        $txt = "<div style='background-color: rgb(255, 255, 255); padding: 10px; border: 3px black double; border-radius: 15px 15px 0px 0px;'>
					<img src='http://www.docsiglo21.com/img/logo.png' width='418' height='150'>
					<h1 style='color: rgb(0, 0, 0);'> Nueva solicitud de prestamo de Folios</h1>
				</div>
				<div style='background-color: rgb(255, 255, 255); padding: 10px; border: 3px black double; border-radius: 0px 0px 15px 15px;'>
					<h1><span style='color: rgb(0, 0, 0)'>Prestamo de :</span><span style='color: rgb(0, 0, 0)'> $objeto</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Codigo de folio :</span><span style='color: rgb(0, 0, 0)'> $folio</span></h1>
					<h1><span style='color: rgb(0, 0, 0)'>Codigo de carpeta :</span><span style='color: rgb(0, 0, 0)'> $carpeta</span></h1>
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
