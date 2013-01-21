<?php
require_once("model/classsmodelShoppingCar.php");
require_once("view/classviewShoppingCar.php");


/**
 * Description of classShoppingCar
 *
 * @author oborja
 */
class classShoppingCar {
    public $car;
    public $print;
    private $model;
    private $view;
    private $request;
    

    
    function __construct($display = true) {
        $this->model= new classsmodelShoppingCar();
        $this->view= new classviewShoppingCar();
        $this->getRequest();
        
        
        
        if(!isset($_SESSION['moneda'])){
            $_SESSION['moneda']=1;
        }
        
        if(isset($this->request['headerBar'])){
            $this->processheaderBar();
            return;
        }
        
        
        if(isset($this->request['action'])){
           switch($this->request['action']){
               case 'getContenidoCarritoPreview':{
                   $this->getContenidoCarritoPreview();
                   echo $this->print;
                   return;
                   break;
               }
               case 'headerBar':{
                   $this->processheaderBar();
                   break;
               }
               case 'addItem':{
                   
                   $this->addtoCar();
                   $display = true;
                   break;
               }
               case 'listCar':{
                   $this->listCar();
                   return;
                   break;
               }
               case 'dropCar':{
                   $this->dropCar();
                   $this->processheaderBar();
                   break;
               }
               case 'delfromCar':{
                   $this->delfromCar();
                   $_SESSION['shcar']= $this->car->asXML();
                   return;
                   break;
               }
               case 'editItemCar':{
                   $this->editItemCar();
                   return;
                   break;
               }
               case 'saveeditItemCar':{
                       $this->saveeditItemCar();
                       return;
                   break;
               }
               default:{
                   $this->print=$this->view->displayError(_ERRORNOACTION);
               }
           }
        }else{
            $this->print=$this->view->displayError(_ERRORNOACTION);
        }
       $_SESSION['shcar']= $this->car->asXML();
       if($display){
        echo $this->print; 
       }
    }
    
    
    function getRequest(){
        if(isset($_SESSION['shcar'])){
            $this->car= new SimpleXMLElement($_SESSION['shcar']);
            $this->status=true;
        }else{
            $this->car= new SimpleXMLElement(_carXML);
            $this->status = false;
        }
        foreach($_REQUEST as $key => $value){
            $this->request[$key]= utf8_encode(trim($value));
        }
        if(isset($this->request['moneda'])){
            $_SESSION['moneda']=$this->request['moneda'];
        }
    }
    
    
    function getContenidoCarritoPreview(){
        $this->model->listCar($this->car);
        $this->print=$this->view->getContenidoCarritoPreview($this->model->data);
    }
    
    function addtoCar(){
        $this->model->addtoCar($this->car,$this->request['productos'],$_SESSION['moneda']);
        unset($car);
        $this->car = $this->model->data;
        $this->print = $this->view->ingresoCarrito();
    }
    
    function delfromCar(){
        $this->model->delfromCar($this->car,$this->request['item']);
        unset($this->car);
        $this->car = $this->model->data;
        $this->listCar();
        return;
    }
    
    function listCar(){
        $this->model->listCar($this->car);
        $this->print = $this->view->listCar($this->model->data);
    }
    
    function showDetailOrder(){
        
    }
    
    function editOrder(){
        
    }

    
    function processheaderBar(){
        $this->print = $this->view->carbarHeader();
        
    }
    
    function dropCar(){
        unset($this->car);
        $this->car= new SimpleXMLElement(_carXML);
        $this->status = false;
    }
    
    function editItemCar(){
        $this->model->getItemCar($this->car,$this->request['item']);
        $this->print=$this->view->formEditItemCar($this->model->data);
    }
    
    function saveeditItemCar(){
        $this->model->saveeditItemCar($this->request,$this->car);
        $this->car=  $this->model->data;
        $this->listCar();
    }
    

}

?>
