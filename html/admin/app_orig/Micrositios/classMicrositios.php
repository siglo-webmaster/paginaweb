<?php

require_once("model/classmodelMicrositios.php");
require_once("view/classviewMicrositios.php");

class classMicrositios {
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
        $this->model = new classmodelMicrositios();
        $this->view = new classviewMicrositios($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearMicrositio':{
                    $this->crearMicrositio();
                    break;
                }
                case 'editMicrositios':{
                    $this->editMicrositios();
                    break;
                }
                case 'saveMicrositio':{
                    $this->saveMicrositio();
                    break;
                }
                case 'delMicrositios':{
                    $this->delMicrositios();
                    break;
                }
                case 'loadDataTipoMicrositio':{
                    $this->loadDataTipoDestacado();
                    return;
                    break;
                }
                case 'loadDataPaneles':{
                    $this->loadDataPaneles();
                    return;
                    break;
                }
                case 'loadDataTipoMicrositiopanelDerecho':{
                    $this->loadDataTipoDestacadopanelDerecho();
                    return;
                    break;
                }
                default :{
                    $this->listMicrositios();
                }
            }
        }else{
            $this->listMicrositios();
        }

    }
    
    function crearMicrositio(){
        $this->print.=$this->view->getFormEditMicrositio($this->model->getPlantillas());
    }
    
    function listMicrositios(){
        $this->model->listMicrositios();
        $this->print.= $this->view->listMicrositios($this->model->data);
        return;
    }
    
    function editMicrositios(){
       
        $datos_micrositio = $this->model->getDatosMicrositio($this->data);
        if(!is_array($datos_micrositio)){
            $this->print ='No encuentro datos del micrositio';
            return ;
        }

        $this->print.=$this->view->getFormEditMicrositio($this->model->getPlantillas(),$datos_micrositio[0]);
        return;
    }
    
    function saveMicrositio(){
        $this->data['id_usuarios']='1';
        $this->print.=$this->view->saveMicrositio($this->model->saveMicrositio($this->data));
        $this->listMicrositios();
    }
    
    function delMicrositios(){
        $this->print.=$this->view->delMicrositio($this->model->delMicrositio($this->data));
        $this->listMicrositios();
    }
    
    function loadDataTipoMicrositio(){
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
    
    function loadDataTipoMicrositiopanelDerecho(){
        $this->print=$this->view->getPanelDerecho($this->model->getListaTitulosxCategoria($this->data['Selected']));
    }
    
    function loadDataPaneles(){
        $this->print = $this->view->getPanelesCategorias($this->model->getListaCategorias());
    }
}

?>
