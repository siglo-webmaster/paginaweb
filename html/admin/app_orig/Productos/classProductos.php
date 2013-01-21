<?php

require_once("model/classmodelProductos.php");
require_once("view/classviewProductos.php");

class classProductos {
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
                        <script src="js/adminProductos.js"></script>';
        $this->data = $data;
        $this->model = new classmodelProductos();
        $this->view = new classviewProductos($data['id_module']);
        $this->print = $this->view->menuModule();
        if(isset($data['opt'])){
            switch($data['opt']){
                case 'crearProducto':{
                    $this->crearProducto();
                    break;
                }
                case 'editProducto':{
                    $this->editProducto();
                    break;
                }
                case 'saveProducto':{
                    $this->saveProducto();
                    break;
                }
                case 'delProducto':{
                    $this->delProducto();
                    break;
                }
                case 'loadDataTipoProducto':{
                    $this->loadDataTipoProducto();
                    return;
                    break;
                }
                case 'loadDataPaneles':{
                    $this->loadDataPaneles();
                    return;
                    break;
                }
                case 'loadDataTipoProductopanelDerecho':{
                    $this->loadDataTipoProductopanelDerecho();
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
                case 'listarProductosActivos':{
                    $this->listProductos('activo');
                    break;
                }
                case 'listarProductosInactivos':{
                    $this->listProductos('inactivo');
                    break;
                }
                case 'listarTodosProductos':{
                    $this->listProductos();
                    break;
                }
                default :{
                   
                    $this->listProductos();
                }
            }
        }else{
            $this->listProductos();
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
    
    function crearProducto(){
        $this->print.=$this->view->getFormEditProducto($this->model->getTiposProductos());
    }
    
    function listProductos($estado=false){
        $this->model->listProductos($estado);
        $this->print.= $this->view->listProductos($this->model->data);
        return;
    }
    
    function editProducto(){
       
        $datos_destacado = $this->model->getDatosProducto($this->data);
        $this->print.=$this->view->getFormEditProducto($this->model->getTiposProductos(),$datos_destacado[0]);
        return;
    }
    
    function saveProducto(){
        $this->data['id_usuarios']='1';
        $this->print.=$this->view->saveProducto($this->model->saveProducto($this->data));
        $this->listProductos();
    }
    
    function delProducto(){
        $this->print.=$this->view->delProducto($this->model->delProducto($this->data));
        $this->listProductos();
    }
    
    function loadDataTipoProducto(){
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
    
    function loadDataTipoProductopanelDerecho(){
        $this->print=$this->view->getPanelDerecho($this->model->getListaTitulosxCategoria($this->data['Selected']));
    }
    
    function loadDataPaneles(){
        $this->print = $this->view->getPanelesCategorias($this->model->getListaCategorias());
    }
}

?>
