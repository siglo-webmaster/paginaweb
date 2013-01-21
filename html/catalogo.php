<?php
session_start();$_SESSION['name'] = "SigloWeb";if (!isset($_SESSION['initiated'])){session_regenerate_id();$_SESSION['initiated'] = true;}
	require_once('config.php');
	require_once('app/tirant/classSHTirant.php');
        
        $tirant = new classSHTiran();
	echo $tirant->renderPage();
?>