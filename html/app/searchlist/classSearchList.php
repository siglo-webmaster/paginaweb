<?php

require_once("app/common/classSHBaseSystem.php");
require_once('view/classviewSearchList.php');
require_once('model/classmodelSearchList.php');
class classSearchList extends classSHBaseSystem {
    
    
    function __construct(){
        
        $this->getRequest();
        $this->view = new classviewSearchList();
        $this->model = new classmodelSearchList();
        if(isset($this->request['opt'])){
            switch($this->request['opt']){
                
                case 'titulo':{
                    $this->busquedaporTitulo();
                    $this->request['returnSearch']=$this->request['searchString'];
                    break;
                }
                case 'autor':{
                    $this->busquedaporAutor();
                    $this->request['returnSearch']=$this->request['searchString'];
                    break;
                }
                case 'categoria':{
                    $this->busquedaporCategoria();
                    $this->request['returnSearch']=$this->request['searchString'];
                    break;
                }
                case 'id_categoria':{
                    $this->busquedaporIdCategoria();
                    //$this->request['opt']='categoria';
                    $this->request['returnSearch']=$this->request['searchString'];
                    break;
                }
                case 'editorial':{
                    $this->busquedaporEditorial();
                    $this->request['returnSearch']=$this->request['searchString'];
                    break;
                }
                case 'isbn':{
                    $this->busquedaporIsbn();
                    $this->request['returnSearch']=$this->request['searchString'];
                    break;
                }
                case 'generarXLS':{
                    $this->generarXLS();
                    exit(0);
                    break;
                }
            }
            $this->print = $this->cabeceraBusqueda().$this->print;
        }
    }
    
    
    function cabeceraBusqueda(){
        return $this->view->showParametrosBusqueda($this->request);
    }
    
    function busquedaporTitulo(){
        if(!isset($this->request['offset'])){
            $this->request['offset']=0;
        }
        $this->request['limit']=_DEFAULTLIMIT;
        $this->model->busquedaporTitulo($this->request);
        $this->print = $this->view->generarListado($this->model->data);
    }
    
    function busquedaporAutor(){
        if(!isset($this->request['offset'])){
            $this->request['offset']=0;
        }
        $this->request['limit']=_DEFAULTLIMIT;
        $this->model->busquedaporAutor($this->request);
        $this->print = $this->view->generarListado($this->model->data);
    }
    
    function busquedaporCategoria(){
        if(!isset($this->request['offset'])){
            $this->request['offset']=0;
        }
        $this->request['limit']=_DEFAULTLIMIT;
        
        $this->model->busquedaporCategoria($this->request);
        $this->print = $this->view->generarListado($this->model->data);
    }
    
    function busquedaporIdCategoria(){
        if(!isset($this->request['offset'])){
            $this->request['offset']=0;
        }
        $this->request['limit']=_DEFAULTLIMIT;
        $this->model->busquedaporIdCategoria($this->request);
        $this->print = $this->view->generarListado($this->model->data);
    }
    
    function busquedaporEditorial(){
        if(!isset($this->request['offset'])){
            $this->request['offset']=0;
        }
        $this->request['limit']=_DEFAULTLIMIT;
        $this->model->busquedaporEditorial($this->request);
        $this->print = $this->view->generarListado($this->model->data);
    }
    
    function busquedaporIsbn(){
        if(!isset($this->request['offset'])){
            $this->request['offset']=0;
        }
        $this->request['limit']=_DEFAULTLIMIT;
        $this->model->busquedaporIsbn($this->request);
        $this->print = $this->view->generarListado($this->model->data);
    }
    
    function generarXLS(){
        if(isset($this->request['opt2'])){
            $this->request['offset']=false;
            $this->request['limit']=false;
            switch($this->request['opt2']){
                case 'titulo':{
                    $this->model->busquedaporTitulo($this->request);
                    break;
                }
                case 'autor':{
                    $this->model->busquedaporAutor($this->request);
                    break;
                }
                case 'categoria':{
                    $this->model->busquedaporCategoria($this->request);
                    break;
                }
                case 'id_categoria':{
                    $this->model->busquedaporIdCategoria($this->request);
                    break;
                }
                case 'editorial':{
                    $this->model->busquedaporEditorial($this->request);
                    break;
                }
                case 'isbn':{
                    $this->model->busquedaporIsbn($this->request);
                    break;
                }

            }
            $this->view->generarXLS($this->model->data);
        }
    }
}

?>
