<?php
	require_once('config.php');
	require_once('app/tirant/classSHTirant.php');
        
        $tirant = new classSHTiran($sh_params);
	echo $tirant->renderPage();
?>