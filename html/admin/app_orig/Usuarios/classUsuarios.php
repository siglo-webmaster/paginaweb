<?php

require_once("model/classmodelUsuarios.php");
require_once("view/classviewUsuarios.php");

class classUsuarios {
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
        $this->model = new classmodelUsuarios();
        $this->view = new classviewUsuarios($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearUsuario':{
                    $this->crearUsuario();
                    break;
                }
                case 'editUsuario':{
                    $this->editUsuario();
                    break;
                }
                case 'saveUsuario':{
                    $this->saveUsuario();
                    break;
                }
                case 'delUsuario':{
                    $this->delUsuario();
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
                    $this->listUsuarios();
                }
            }
        }else{
            $this->listUsuarios();
        }

    }
    
    function crearUsuario(){
        $this->print.=$this->view->getFormEditUsuario(array('gruposusuarios'=>$this->model->getGruposUsuarios()));
    }
    
    function listUsuarios(){
        $this->model->listUsuarios();
        $this->print.= $this->view->listUsuarios($this->model->data);
        return;
    }
    
    function editUsuario(){
       
        $datos_Usuario = $this->model->getDatosUsuario($this->data);
        $this->print.=$this->view->getFormEditUsuario(array('gruposusuarios'=>$this->model->getGruposUsuarios()),$datos_Usuario[0]);
        return;
    }
    
    function saveUsuario(){
        $this->print.=$this->view->saveUsuario($this->model->saveUsuario($this->data));
        $this->listUsuarios();
    }
    
    function delUsuario(){
        $this->print.=$this->view->delUsuario($this->model->delUsuario($this->data));
        $this->listUsuarios();
    }
    
    function formChangePasswd(){
        $this->print.=$this->view->formChangePasswd($this->data);
    }
    
    function savePasswd(){
        $this->print.=$this->view->savePasswd($this->model->savePasswd($this->data));
        $this->listUsuarios();
    }
    
}

?>
