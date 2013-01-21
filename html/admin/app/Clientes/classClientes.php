<?php

require_once("model/classmodelClientes.php");
require_once("view/classviewClientes.php");

class classClientes {
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
        $this->model = new classmodelClientes();
        $this->view = new classviewClientes($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearCliente':{
                    $this->crearCliente();
                    break;
                }
                case 'editCliente':{
                    $this->editCliente();
                    break;
                }
                case 'saveCliente':{
                    $this->saveCliente();
                    break;
                }
                case 'delCliente':{
                    $this->delCliente();
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
                    $this->listClientes();
                }
            }
        }else{
            $this->listClientes();
        }

    }
    
    function crearCliente(){
        $this->print.=$this->view->getFormEditCliente(array('documentos'=>$this->model->getTiposDocumento(),'ciudades'=>$this->model->getCiudades()));
    }
    
    function listClientes(){
        $this->model->listClientes();
        $this->print.= $this->view->listClientes($this->model->data);
        return;
    }
    
    function editCliente(){
       
        $datos_cliente = $this->model->getDatosCliente($this->data);
        $this->print.=$this->view->getFormEditCliente(array('documentos'=>$this->model->getTiposDocumento(),'ciudades'=>$this->model->getCiudades()),$datos_cliente[0]);
        return;
    }
    
    function saveCliente(){
        $this->print.=$this->view->saveCliente($this->model->saveCliente($this->data));
        $this->listClientes();
    }
    
    function delCliente(){
        $this->print.=$this->view->delCliente($this->model->delCliente($this->data));
        $this->listClientes();
    }
    
    function formChangePasswd(){
        $this->print.=$this->view->formChangePasswd($this->data);
    }
    
    function savePasswd(){
        $this->print.=$this->view->savePasswd($this->model->savePasswd($this->data));
        $this->listClientes();
    }
    
}

?>
