<?php
session_start();$_SESSION['name'] = "SigloWeb2011-2012";if (!isset($_SESSION['initiated'])){session_regenerate_id();$_SESSION['initiated'] = true;}
require_once('config.php');
require_once('app/shoppingcar/classShoppingCar.php');

$carrito = new classShoppingCar();

?>
