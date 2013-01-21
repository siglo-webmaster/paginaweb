<?php
session_start();$_SESSION['name'] = "SigloWeb2011-2012";if (!isset($_SESSION['initiated'])){session_regenerate_id();$_SESSION['initiated'] = true;}
require_once('config.php');
require_once('app/pedidos/classPedidos.php');

$pedidos = new classPedidos();
if(isset($pedidos->request['action'])){
    switch($pedidos->request['action']){
        case 'Step1':{
            header('location: http://localhost/~adso/SigloDelHombreV3/index.php?action=procesarPedido&id_pedido='.$pedidos->request['id_orden']);
            break;
        }
    }
}

?>
