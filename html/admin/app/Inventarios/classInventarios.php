<?php

require_once("model/classmodelInventarios.php");
require_once("view/classviewInventarios.php");

class classInventarios {
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
                        <script src="js/adminInventarios.js"></script>';
        $this->data = $data;
        $this->model = new classmodelInventarios();
        $this->view = new classviewInventarios($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearInventario':{
                    $this->crearInventario();
                    break;
                }
                case 'editInventario':{
                    $this->editInventario();
                    break;
                }
                case 'saveInventario':{
                    $this->saveInventario();
                    break;
                }
                case 'delInventario':{
                    $this->delInventario();
                    break;
                }
                case 'loadDataTipoInventario':{
                    $this->loadDataTipoInventario();
                    return;
                    break;
                }
                case 'loadDataPaneles':{
                    $this->loadDataPaneles();
                    return;
                    break;
                }
                case 'loadDataTipoInventariopanelDerecho':{
                    $this->loadDataTipoInventariopanelDerecho();
                    return;
                    break;
                }
                
                case 'changeStatusItem':{
                    $this-changeStatusItem();
                    return;
                    break;
                }
                
                case 'changeEditorialStatusItem':{
                    $this-changeStatusItem();
                    return;
                    break;
                }
                case 'listarInventariosActivos':{
                    $this->listInventarios('activo');
                    break;
                }
                case 'listarInventariosInactivos':{
                    $this->listInventarios('inactivo');
                    break;
                }
                case 'listarTodosInventarios':{
                    $this->listInventarios();
                    break;
                }
                default :{
                   
                    $this->listInventarios();
                }
            }
        }else{
            $this->listInventarios();
        }

    }
    
    function changeStatusItem(){
        $this->model->changeStatusItem($this->data['codigo'],$this->data['estado']);
        $this->print=  $this->model->status;
    }
    
    function changeEditorialStatusItem(){
        $this->model->changeEditorialStatusItem($this->data['codigo'],$this->data['estado']);
        $this->print=  $this->model->status;
    }
    
    function crearInventario(){
        $this->print.=$this->view->getFormEditInventario($this->model->getTiposInventarios());
    }
    
    function listInventarios($estado=false){
        $this->model->listInventarios($estado);
        $this->print.= $this->view->listInventarios($this->model->data);
        return;
    }
    
    function editInventario(){
       
        $datos_destacado = $this->model->getDatosInventario($this->data);
        $this->print.=$this->view->getFormEditInventario($this->model->getTiposInventarios(),$datos_destacado[0]);
        return;
    }
    
    function saveInventario(){
        $this->data['id_usuarios']='1';
        $this->print.=$this->view->saveInventario($this->model->saveInventario($this->data));
        $this->listInventarios();
    }
    
    function delInventario(){
        $this->print.=$this->view->delInventario($this->model->delInventario($this->data));
        $this->listInventarios();
    }
    
    function loadDataTipoInventario(){
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
    
    function loadDataTipoInventariopanelDerecho(){
        $this->print=$this->view->getPanelDerecho($this->model->getListaTitulosxCategoria($this->data['Selected']));
    }
    
    function loadDataPaneles(){
        $this->print = $this->view->getPanelesCategorias($this->model->getListaCategorias());
    }
}

?>
