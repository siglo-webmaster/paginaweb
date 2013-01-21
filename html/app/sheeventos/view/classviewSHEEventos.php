<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clarrviewSHEEventos
 *
 * @author oborja
 */
class classviewSHEEventos {
    public $xml;
    
    function __construct (){
        $this->xml = new SimpleXMLElement(_mensageXML);
        
    }
    function getEventoActual($data){
        $return ="Ese es el evento actual :". rand(0,1000);
        if($data!=false){
            foreach ($data['eventos'] as $row){
                $return.="<p>".$row['id_eventos']." ".$row['inicio']." ".$row['fin']."</p>";
                $return.="atributos: <br/>";
                foreach($data['atributos'][$row['id_eventos']] as $param){
                    $return.= $param['llave']."->".$param['valor']."<br>";
                }
            }
        }
        return $return;
    }
    
    function consultarAvisos($data){
        $entry = $this->xml->addChild("entry");
        
        if($data!=false){
            $entry->addChild("id_eventos",$data['eventos'][0]['id_eventos'] );
            
            foreach($data['eventos'] as $row){
                /*$aviso = $entry->addChild("aviso");
                foreach($row as $key=>$value){
                    if(!is_int($key)){
                        $aviso->addChild($key , $value);
                    }
                } */  
           
            }
            
        }else{
            $entry->addChild("estado","false");
        }
        return $this->xml->asXML();
    }
    
    function getEventos($data){
        $return="";
        if(!is_array($data))return '';
        foreach($data as $evento){
            
            if(!sizeof($evento['detalles'])>0) continue;
            
            $atributos = array();
            foreach($evento['detalles'] as $atributo){
                $atributos[$atributo['llave']]=$atributo['valor'];
            }
            $return.="<div class='panel'>";
            $return.="<img src='".$atributos['imagen']."' />";
            $return.="</div>";
           
            
        }
        return $return;
    }
}

?>
