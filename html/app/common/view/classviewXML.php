<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classviewXML
 *
 * @author oborja
 */
class classviewXML {
    public $xml;
    public $string;
    
    function __construct() {
        $this->xml = new SimpleXMLElement(_mensageXML);
    }
    
    function generarListado($data){
        foreach($data as $row){
            $item = $this->xml->addChild("entry");
            foreach($row as $key => $dato){
                if(!is_int($key)){
                    $item->addChild($key,$dato);
                }
            }
        }
        $this->string = $this->xml->asXML();
    }
}

?>
