<?php
require_once("model/classmodelEventos.php");
require_once("view/classviewEventos.php");

class classEventos {
    var $model;
    var $view;
    var $print;
    var $css;
    var $data;
    var $script;
    function __construct($data = false){
        $this->css='<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>';
        $this->script='<script src="js/jquery.min.js"></script>
                        <script src="js/jquery-ui.min.js"></script>
                        <script src="js/adminEventos.js"></script>';
        $this->data = $data;
        $this->model = new classmodelEventos();
        $this->view = new classviewEventos();
        $this->print = $this->view->menuModule($data['id_module']);
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearEvento':{
                    $this->crearEvento();
                    break;
                }
                case 'editEvento':{
                    $this->editEvento();
                    break;
                }
                case 'saveEvento':{
                    $this->saveEvento();
                    break;
                }
                case 'delEvento':{
                    $this->delEvento();
                    break;
                }
                default :{
                    $this->listEventos();
                }
            }
        }else{
            $this->listEventos();
        }

    }
    
    function crearEvento(){
        $tipo_eventos = $this->model->getTipoEventos();
        $this->print.=$this->view->getFormEditEvento($tipo_eventos,$this->data['id_module']);
    }
    
    function listEventos(){
        $this->model->listEventos();
        $this->print.= $this->view->listEventos($this->model->data,$this->data['id_module']);
        return;
    }
    
    function editEvento(){
        try{
            $tipo_eventos = $this->model->getTipoEventos();
            $datos_evento = $this->model->getDatosEvento($this->data);
            $this->print.=$this->view->getFormEditEvento($tipo_eventos,$this->data['id_module'],$datos_evento[0]);
            
         }catch(Exception $e){
             echo $e->getMessage();
             return false;
         }
        
    }
    
    function saveEvento(){
        $this->data['id_usuarios']='1';
        $this->print.=$this->view->saveEvento($this->model->saveEvento($this->data));
        $this->listEventos();
    }
    
    function delEvento(){
        $this->print.=$this->view->delEvento($this->model->delEvento($this->data));
        $this->listEventos();
    }
}

?>
