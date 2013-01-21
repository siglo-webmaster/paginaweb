<?php
$body =  "Pagina Confirmacion  
    ";
    foreach($_REQUEST as $key => $value){
        $body.="<p><b>".$key." : </b>".$value."</p>
            ";
    }
    mail("adsofmelk@gmail.com,oborja@siglodelhombre.com","Pagina de confirmacion",$body); 
?>
