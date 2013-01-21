<?php

require_once("model/classmodelGrupousuarios.php");
require_once("view/classviewGrupousuarios.php");

class classGrupousuarios {
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
        $this->model = new classmodelGrupousuarios();
        $this->view = new classviewGrupousuarios($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearGrupousuario':{
                    $this->crearGrupousuario();
                    break;
                }
                case 'editGrupousuario':{
                    $this->editGrupousuario();
                    break;
                }
                case 'saveGrupousuario':{
                    $this->saveGrupousuario();
                    break;
                }
                case 'delGrupousuario':{
                    $this->delGrupousuario();
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
                    $this->listGrupousuarios();
                }
            }
        }else{
            $this->listGrupousuarios();
        }

    }
    
    function crearGrupousuario(){
        $this->print.=$this->view->getFormEditGrupousuario($this->model->listModulos());
    }
    
    function listGrupousuarios(){
        $this->model->listGrupousuarios();
        $this->print.= $this->view->listGrupousuarios($this->model->data);
        return;
    }
    
    function editGrupousuario(){
       
        $datos_Grupousuario = $this->model->getDatosGrupousuario($this->data);
        $this->print.=$this->view->getFormEditGrupousuario($this->model->listModulos(),$datos_Grupousuario[0]);
        return;
    }
    
    function saveGrupousuario(){
        $this->print.=$this->view->saveGrupousuario($this->model->saveGrupousuario($this->data));
        $this->listGrupousuarios();
    }
    
    function delGrupousuario(){
        $this->print.=$this->view->delGrupousuario($this->model->delGrupousuario($this->data));
        $this->listGrupousuarios();
    }
    
}

?>
