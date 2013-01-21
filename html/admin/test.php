<?php

for ($i=0;$i<=10;$i++){
    echo "<li>".rand(100,999)."</li>";
}
foreach($_REQUEST as $key=>$val){
    echo "<li>".$key." ->".$val."</li>";
}
?>
