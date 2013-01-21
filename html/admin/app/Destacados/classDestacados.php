<?php

require_once("model/classmodelDestacados.php");
require_once("view/classviewDestacados.php");

class classDestacados {
    var $model;
    var $view;
    var $print;
    var $script;
    var $css;
    var $data;
    function __construct($data = false){
        $this->css='<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>';
        $this->script='<script src="js/jquery.min.js"></script>
                        <script src="js/jquery-ui.min.js"></script>
                        <script src="js/adminDestacados.js"></script>';
        $this->data = $data;
        $this->model = new classmodelDestacados();
        $this->view = new classviewDestacados($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearDestacado':{
                    $this->crearDestacado();
                    break;
                }
                case 'editDestacado':{
                    $this->editDestacado();
                    break;
                }
                case 'saveDestacado':{
                    $this->saveDestacado();
                    break;
                }
                case 'delDestacado':{
                    $this->delDestacado();
                    break;
                }
                case 'loadDataTipoDestacado':{
                    $this->loadDataTipoDestacado();
                    return;
                    break;
                }
                case 'loadDataPaneles':{
                    $this->loadDataPaneles();
                    return;
                    break;
                }
                case 'loadDataTipoDestacadopanelDerecho':{
                    $this->loadDataTipoDestacadopanelDerecho();
                    return;
                    break;
                }
                default :{
                    $this->listDestacados();
                }
            }
        }else{
            $this->listDestacados();
        }

    }
    
    function crearDestacado(){
        $this->print.=$this->view->getFormEditDestacado($this->model->getTiposDestacados());
    }
    
    function listDestacados(){
        $this->model->listDestacados();
        $this->print.= $this->view->listDestacados($this->model->data);
        return;
    }
    
    function editDestacado(){
       
        $datos_destacado = $this->model->getDatosDestacado($this->data);
        $this->print.=$this->view->getFormEditDestacado($this->model->getTiposDestacados(),$datos_destacado[0]);
        return;
    }
    
    function saveDestacado(){
        $this->data['id_usuarios']='1';
        $this->print.=$this->view->saveDestacado($this->model->saveDestacado($this->data));
        $this->listDestacados();
    }
    
    function delDestacado(){
        $this->print.=$this->view->delDestacado($this->model->delDestacado($this->data));
        $this->listDestacados();
    }
    
    function loadDataTipoDestacado(){
        switch($this->data['id_tipos_destacados']){
            case '2':{
                $this->print = $this->view->getListaCategorias($this->model->getListaCategorias(),$this->data['selected']);
                break;
            }
            case '3':{
                $this->print = $this->view->getListaEditoriales($this->model->getListaEditoriales(),$this->data['selected']);
                break;
            }
            case '4':{
                $this->print = $this->view->getListaAutores($this->model->getListaAutores(),$this->data['selected']);
                break;
            }
            case '5':{
                $this->print = $this->view->getListaEventos($this->model->getListaEventos(),$this->data['selected']);
                break;
            }
        }
    }
    
    function loadDataTipoDestacadopanelDerecho(){
        $this->print=$this->view->getPanelDerecho($this->model->getListaTitulosxCategoria($this->data['Selected']));
    }
    
    function loadDataPaneles(){
        $this->print = $this->view->getPanelesCategorias($this->model->getListaCategorias());
    }
}

?>
