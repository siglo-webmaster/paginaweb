<?php
require_once("config.php");
require_once("app/tirant/model/modelSHTirant.php");
$dbtirant = new modelSHTiran();
$result = $dbtirant->busquedaDirecta($_REQUEST['term']);
if(sizeof($result)>0){
    foreach($result as $row){
        echo "<li>".utf8_encode($row['valor']).'</li>';
    }
}
?>
