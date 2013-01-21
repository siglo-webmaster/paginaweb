<?php
session_start();$_SESSION['name'] = "adminSigloWeb";if (!isset($_SESSION['initiated'])){session_regenerate_id();$_SESSION['initiated'] = true;}
require_once('../config.php');
require_once('app/Productos/model/classmodelProductos.php');

class changeStatusItem extends classmodelProductos{
}

$changeStatus = new changeStatusItem(); 
$changeStatus->changeStatusItem($_REQUEST['codigo'],$_REQUEST['estado']);

?>
