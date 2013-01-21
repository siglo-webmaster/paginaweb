<?php
require_once("model/classmodelconsultasGenericas.php");
require_once("app/common/classSHBaseSystem.php");
require_once("app/common/view/classviewXML.php");

class classconsultasGenericas extends classSHBaseSystem{
    function __construct(){
        
        $this->getRequest(); //PROCESAR VARIABES DE SESSION Y REQUEST
        $this->model = new classmodelconsultasGenericas();
        if(isset($this->request['action'])){
            switch($this->request['action']){
                case 'moduloPedidos':{
                    $this->print="Consultas para el modulo de Pedidos";
                    switch($this->request['opt']){
                        case 'consultaCiudades':{
                            $this->model->listarCiudadesporPais($this->request['pais']);
                            
                            if($this->model->status){
                                
                                $xml = new classviewXML();
                                 
                                $xml->generarListado($this->model->data);
                                $this->print=$xml->string;
                            }else{
                                $this->print='ERROR';
                            }
                            break;
                        }
                        case 'consultaFleteTransportadora':{
                            $this->model->consultaFleteTransportadora($this->request['transportadora'],$this->request['ciudad']);
                            
                            if($this->model->status){
                                
                                $xml = new classviewXML();
                                 
                                $xml->generarListado($this->model->data);
                                $this->print=$xml->string;
                            }else{
                                $this->print='ERROR';
                            }
                            break;
                        }
                    }
                    
                    break;
                }
                
                case 'moduloUsuarios':{
                    switch($this->request['opt']){
                        case 'dispUser':{
                            $this->model->disponibilidadUsername($this->request['username']);
                            
                            $xml = new classviewXML();
                            $xml->generarListado(array(0=>array('existe'=>($this->model->status)?'true':'false')));
                            $this->print=$xml->string;
                            
                            break;   
                        }
                    }
                    
                    break;   
                }
                
                case 'cambiarMoneda':{
                    switch($this->request['id_moneda']){
                        case '2' :{
                            $_SESSION['moneda']=2;
                         break;   
                        }
                        case '3' :{
                            $_SESSION['moneda']=3;
                         break;   
                        }
                        default:{
                            $_SESSION['moneda']=1;
                            break;
                        }
                    }
                   
                    return;
                    break;
                }
                
            }
        }else{
            $this->print = _ERRORNOACTION;
        }
       echo $this->print; 
    }
    
}

?>
