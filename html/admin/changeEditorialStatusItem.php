<?php
session_start();$_SESSION['name'] = "adminSigloWeb";if (!isset($_SESSION['initiated'])){session_regenerate_id();$_SESSION['initiated'] = true;}
require_once('../config.php');
require_once('app/Productos/model/classmodelProductos.php');

class changeEditorialStatusItem extends classmodelProductos{
}

$changeStatus = new changeEditorialStatusItem(); 
$changeStatus->changeEditorialStatusItem($_REQUEST['codigo'],$_REQUEST['estado']);

?>