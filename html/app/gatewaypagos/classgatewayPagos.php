<?php

require_once("app/common/classSHBaseSystem.php");
require_once('view/classviewgatewayPagos.php');
require_once('model/classmodelgatewayPagos.php');

class classgatewayPagos extends classSHBaseSystem {
    function __construct() {
        $this->print='';
        $this->getRequest();
        $this->model = new classmodelgatewayPagos();
        $this->view = new classviewgatewayPagos();
        
        if(isset($this->request['action'])){
            switch($this->request['action']){
                case 'listarPlataformas' :{
                    $this->listarPlataformas();
                    echo $this->print;
                    return;
                    break;
                }
                case 'cargarPlataforma':{
                    $this->cargarPlataforma();
                    echo $this->print;
                    return;
                    break;
                }
            }
        }
    }
    
    function listarPlataformas(){
        $this->model->listarPlataformas();
        $this->data=$this->model->data;
    }
    
    function cargarPlataforma(){
        require_once ('app/pedidos/classPedidos.php');
        $data = array('id_ordenes'=>$this->request['orden'], 'id_clientes' =>$this->data->cliente->idcliente);
        $pedido = new classPedidos(true);
        $pedido->model->getdatosCabeceraPedidoCliente($data);
        $this->model->getPlataforma($this->request['id']);
        $datos_plataform = $this->model->data;
        $this->model->getparametrosPlataforma($this->request['id']);
        $this->print = $this->view->cargarPlataforma($this->model->cargarPlataforma($pedido->model->data, $datos_plataform, $this->model->data));
        
    }
}

?>
