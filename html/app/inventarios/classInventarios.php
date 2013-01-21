<?php


       require_once("model/classmodelInventarios.php");
       require_once("view/classviewInventarios.php");
        
class classInventarios {
    public $model;
    public $view;
    function __construct($carga=false){
        $this->model = new classmodelInventarios();
        $this->view = new classviewInventarios();
        
        if($carga!=false){
            $this->setStock($carga);
            exit(0);
        }
        
        $this->getRequest();
        
        if(isset($this->request['action'])){
            switch($this->request['action']){
                case 'getStock':{
                    $this->getStock();
                    break;
                }
                case 'setStock':{
                    $this->setStock();
                    break;
                }
                case 'reserveStock':{
                    $this->reserveStock();
                    break;
                }
            }
        }
    }
    
    function getStock(){
        
    }
    
    function setStock($file){

        $temp = file($file);
        if(!$temp){
            return false;
        }
         
       foreach($temp as $row){
           
            $row = ereg_replace("[^A-Za-z0-9,]", "",$row);
            $row = explode(',',$row);
           
            if(!isset($row[0])){
                continue;
            }
            if(!isset($row[1])){
                continue;
            }
            
            $data = $this->model->getDataItem($row[0]);
            if($data==false){
                echo "\nNo hay datos del item ".$row[0];
                continue;
            }
            ////////////////////CAMAR STOCK
            $datos = array('stock'=>$row[1],
            'reservado'=>0,
            'id_titulos'=>  $data[0]['id_titulos'],
            'codigo'=>$row[0],
            'id_proveedores'=> $data[0]['id_proveedores'],
            'id_bodegas'=>1,
            'id_usuario'=>1,
            'fecha'=>date('Y-m-d h:i:s'),
            'Archivo_carga'=>$file
            );

            $this->model->setStock($datos); 
            
           
       }
       
        
    }
    
    function reserveStock(){
        
    }
}

?>
