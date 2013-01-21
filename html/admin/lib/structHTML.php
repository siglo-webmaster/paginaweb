<?php

class structHTML {
    var $html;
    var $title;
    var $scripts;
    var $css;
    var $body;
    
    function __construct() {
        $this->html = "<html><head><title>%%%TITLE%%%</title>
            <link rel=\"stylesheet\" type=\"text/css\" href='css/admin.css' />
            %%%CSS%%%%%%SCRIPTS%%%</head><body><div class='popUp' id='popUp'><div id='contenedor'></div></div><div class='overlay'></div>%%%BODY%%%</body></html>";
        $this->title='';
        $this->scripts='';
        $this->css='';
        $this->body='';
    }
    
    function render(){
        $this->html = str_replace("%%%TITLE%%%", $this->title, $this->html);
        $this->html = str_replace("%%%CSS%%%", $this->css, $this->html);
        $this->html = str_replace("%%%SCRIPTS%%%", $this->scripts, $this->html);
        $this->html = str_replace("%%%BODY%%%", $this->body, $this->html);
        return $this->html;
    }
    
    function setScript($data){
        $this->scripts=$data;
    }
    
    function setBody($data){
        $this->body=$data;
    }
    
    function setTitle($data){
        $this->title=$data;
    }
    
    function setCss($data){
        $this->css = $data;
    }
   
}

?>
