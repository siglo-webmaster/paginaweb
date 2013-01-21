<?php
session_start();
require_once('config.php');

if(isset($_REQUEST['action'])){
    require_once('app/tirant/classSearch.php');
    $search = new classSearch();
    exit(0);
}


require_once('app/tirant/view/classviewSearch.php');

    $busqueda = new classviewSearch();
    $busqueda->getFormStandar();
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'.
        "<html><head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/> 
        <LINK REL=StyleSheet HREF=\"css/busquedaAvanzada.css\" TYPE=\"text/css\" MEDIA=all>
        <link href=\"lib/jquery/jquery-ui.css\" rel=\"stylesheet\" type=\"text/css\"/>
        <script src=\"lib/jquery/jquery.min.js\"></script>
        <script src=\"lib/jquery/jquery-ui.min.js\"></script>
        <script src=\"lib/busquedaAvanzada.js\"></script>
        <script src=\"lib/sh_detalleitem_scripts.js\" ></script>
        </head>
        <body>".$busqueda->print."</body>
        </html>";
?>
