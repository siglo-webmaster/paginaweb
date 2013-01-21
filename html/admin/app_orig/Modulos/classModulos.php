<?php

require_once("model/classmodelModulos.php");
require_once("view/classviewModulos.php");

class classModulos {
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
        $this->model = new classmodelModulos();
        $this->view = new classviewModulos($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearModulo':{
                    $this->crearModulo();
                    break;
                }
                case 'editModulo':{
                    $this->editModulo();
                    break;
                }
                case 'saveModulo':{
                    $this->saveModulo();
                    break;
                }
                case 'delModulo':{
                    $this->delModulo();
                    break;
                }
                case 'formChangePasswd':{
                    $this->formChangePasswd();
                    break;
                }
                case 'savePasswd':{
                    $this->savePasswd();
                    break;
                }
                default :{
                    $this->listModulos();
                }
            }
        }else{
            $this->listModulos();
        }

    }
    
    function crearModulo(){
        $this->print.=$this->view->getFormEditModulo();
    }
    
    function listModulos(){
        $this->model->listModulos();
        $this->print.= $this->view->listModulos($this->model->data);
        return;
    }
    
    function editModulo(){
       
        $datos_Modulo = $this->model->getDatosModulo($this->data);
        $this->print.=$this->view->getFormEditModulo($datos_Modulo[0]);
        return;
    }
    
    function saveModulo(){
        $this->print.=$this->view->saveModulo($this->model->saveModulo($this->data));
        $this->listModulos();
    }
    
    function delModulo(){
        $this->print.=$this->view->delModulo($this->model->delModulo($this->data));
        $this->listModulos();
    }
    
}

?>
