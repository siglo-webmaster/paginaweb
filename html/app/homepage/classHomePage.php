<?php
require_once("view/classviewHomePage.php");
class classHomePage {
    public $destacadosHomePage;
    public $novedadeshome;
    public $novedades;


    public $view;
    
    public function __construct(){
        $this->view = new classviewHomePage();

    }
    
    public function getdestacadosHomePage(){
        
        $this->destacadosHomePage = $this->view->getdestacadosHomePage();
    }
    
    public function getNovedades(){
        
        $this->novedades= $this->view->getNovedades();
    }
    
    function getContenedornovedadeshome(){
        $this->novedadeshome = $this->view->getContenedornovedadeshome();
    }
    
    
    
}

?>
