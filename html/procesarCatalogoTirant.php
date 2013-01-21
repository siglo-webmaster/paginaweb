<?php
	require_once('config.php');
	require_once('class/tirant/class.catalogTirant.php');
	
	$catalogo = new catalogTirant(_URLCATALOG);
	$catalogo->generarCatalogo();
	return;
?>