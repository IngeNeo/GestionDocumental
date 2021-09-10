<?php
require_once 'messages.php';

define( 'BASE_PATH', 'http://localhost/NTS-SigloXXI/');//Ruta base donde se encuentra
define( 'DB_HOST', 'localhost' );//Servidor de la base de datos
define( 'DB_USERNAME', 'root');//Usuario de la base de datos
define( 'DB_PASSWORD', 'root');//Contraseña de la base de datos
define( 'DB_NAME', 'NTS');//Nombre de la base de datos

function _spl_autoload_register($class)
{
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}
