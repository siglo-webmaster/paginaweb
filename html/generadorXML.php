<?php
session_start();
require_once("config.php");
require_once("class/generadorxml/classGeneradorXML.php");
$_SESSION['moneda']=1;
$generador = new classGeneradorXML();
$generador->getXml();
?>
