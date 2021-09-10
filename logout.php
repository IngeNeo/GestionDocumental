<?php
ob_start();
session_start();
require_once 'config.php';
require_once 'Cl/User.php';
require_once 'Cl/DBclass.php';
$user_obj = new Cl_User();
$data = $user_obj->logout();