<?php

/**
 * Description of classSHBaseSystem
 *
 * @author oborja
 */
class classSHBaseSystem {
    public $data;
    public $print;
    public $request;
    public $model;
    public $view;
    public $car;
    public $status;
    
    function getRequest(){
        
        if(isset($_SESSION['shuser'])){
            $this->data = new SimpleXMLElement($_SESSION['shuser']);
            $this->status=true;
        }else{
            $this->data = new SimpleXMLElement(_userXML);
            $this->status = false;
        }
        
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
         
    } 
    
    function isLogin(){
       (!isset($_SESSION['shuser']))?header("Location: index.php?action=formLogin"):true;
    }
}

?>
