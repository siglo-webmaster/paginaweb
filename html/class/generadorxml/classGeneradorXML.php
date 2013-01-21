<?php

require_once("app/tirant/model/modelSHTirant.php");

class classGeneradorXML extends modelSHTirant {
    public $headXml;
    public $footXml;
    public $bodyXml;
    function getXml(){
        $this->headXml='<?xml version="1.0" encoding="UTF-8"?> 
<ads>
';
        $this->footXml="</ads>";
        $this->bodyXml='';
        $filtro = array('limit'=>4000,'offset'=>16001,'option'=>'getTitulosProveedor');
        $this->getItems($filtro);
        foreach($this->data as $libro){
            
            $this->bodyXml.=$this->libroXML($libro);
            
        }
        $temp = simplexml_load_string($this->headXml.$this->bodyXml.$this->footXml);
        file_put_contents("/home/oborja/Descargas/alamaulaReg-16001-17000.xml",  $temp->asXML());
    }
    
    
    function libroXML($libro){
        $autores='';
        foreach($libro['autores'] as $autor){
            $autores.=$autor['nombre']." ,";
        }
        $autores = rtrim($autores,',');
        
        $editoriales='';
        foreach($libro['editoriales'] as $editorial){
            $editoriales.=$editorial['nombre']." ,";
        }
        $editoriales = rtrim($editoriales,',');
        
        $datos_siglo="<br><b>Autor(es); </b>".$autores."
                <br/><b>Editorial(es): </b>".$editoriales."
                <br/><b>Fecha Publicaci&oacute;n:</b> ".$libro['fecha_pub'].
                "<br/><b>Paginas :</b> ".$libro['paginas'].
                "<br/><b>Peso:</b> ".$libro['peso'].
                "<br/><b>Car&aacute;tula:</b> ".utf8_decode($libro['caratula']).
                "<h3><img src='http://siglodelhombre.com/images/li_rojo.gif' alt='Siglo del Hombre Editores'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;www.siglodelhombre.com</h3>".
                "<br>Cra 31A No. 25B-50  Bogot&aacute;, Colombia
                <br>Pbx: 57 (1) 337 7700 Fax: 57 (1) 337 7665
                <br>E-mail: info@siglodelhombre.com";
        
        $plantilla = $this->plantillaXML();
        $plantilla = str_replace("%%%CODIGO%%%", $libro['codigoweb'], $plantilla);
        $plantilla = str_replace("%%%TITULO%%%", $libro['titulo'], $plantilla);
        $plantilla = str_replace("%%%RESENYA%%%", $libro['resenya'], $plantilla);
        $plantilla = str_replace("%%%IMAGEN%%%", "http://www.siglodelhombre.com/prodspics/".$libro['codigoweb']."_g.jpg", $plantilla);
        $plantilla = str_replace("%%%FECHA%%%", (date('Y-m-d h:i:s')), $plantilla);
        $plantilla = str_replace("%%%PRECIO%%%", $libro['tipo_producto'][1]['precio'], $plantilla); 
        $plantilla = str_replace("%%%DATOS_SIGLO%%%", $datos_siglo, $plantilla);
        return utf8_encode($plantilla);
    }
    
    
    function plantillaXML(){
        return "<ad> 
<id><![CDATA[%%%CODIGO%%%]]></id> 
<title><![CDATA[%%%TITULO%%%]]></title> 
<body><![CDATA[%%%TITULO%%%<br/>%%%DATOS_SIGLO%%%<br/>%%%RESENYA%%%]]></body> 
<section><![CDATA[13]]></section> 
<published><![CDATA[%%%FECHA%%%]]></published> 
<currency><![CDATA[COP]]></currency> 
<price><![CDATA[%%%PRECIO%%%]]></price> 
<phone><![CDATA[57 (1) 337 7700]]></phone> 
<email><![CDATA[info@siglodelhombre.com]]></email> 
<country><![CDATA[CO]]></country> 
<state><![CDATA[Bogota D.C.]]></state> 
<city><![CDATA[Bogota D.C.]]></city> 
<image> 
<image_url><![CDATA[%%%IMAGEN%%%]]></image_url> 
<image_title><![CDATA[%%%TITULO%%%]]></image_title> 
</image> 
<map> 
<latitude><![CDATA[4.627626]]></latitude> 
<longitude><![CDATA[-74.082321]]></longitude> 
</map> 
</ad>
";
    }
    
}

?>
