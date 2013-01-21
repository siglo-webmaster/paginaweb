<?php

class request {
    
    var $request;
    function __construct(){
        foreach($_REQUEST as $key => $value){
            $this->request[$key]= utf8_encode(trim($value));
        }
          
    }
}

?>
