<?php
require_once("config.php");
require_once("app/homologador/classHomologador.php");
$homologaciones = new classHomologador();
echo $homologaciones->renderHTML();
?>
