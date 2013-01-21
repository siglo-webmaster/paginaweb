<?php
require_once("view/classviewHomePage.php");
class classHomePage {
    public $destacadosHomePage;
    public $recomendados;
    public $novedades;
    public $universidades;
    public $revistas;
    public $view;
    
    public function __construct(){
        $this->view = new classviewHomePage();

    }
    
    public function getdestacadosHomePage(){
        
        $this->destacadosHomePage = $this->view->getdestacadosHomePage();
    }
    
    public function getRecomendados(){
        
        $this->recomendados= $this->view->getRecomendados();
    }
    
    public function getNovedades(){
        
        $this->novedades= $this->view->getNovedades();
    }
    
    public function getUniversidades(){
        
        $this->universidades= $this->view->getUniversidades();
    }
    
    public function getRevistas(){
        
        $this->revistas= $this->view->getRevistas();
    }
    
}

?>
