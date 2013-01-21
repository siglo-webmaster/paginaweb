<?php

require_once ("app/common/classSHBaseSystem.php");
require_once("view/classviewSHEEventos.php");
require_once("model/classmodelSHEEventos.php");
class classSHEEventos extends classSHBaseSystem {

    function __construct(){
        $this->view = new classviewSHEEventos();
        $this->model = new classmodelSHEEventos();
        
        $this->getRequest();
        
        if (isset($this->request['action'])){
            
            switch($this->request['action']){
                
                case 'consultarAvisos':{
                    $this->consultarAvisos();
                    return;
                    break;
                }
                case 'consultarEvento':{
                    $this->consultarEvento();
                    return;
                    break;
                }
                case 'getEventos':{
                    $this->getEventos();
                    echo $this->print;
                    exit(0);
                    break;
                }
                    
            }
        }else{
            $this->getEventoActual();
            return;
        }
        
    }
    
    function getEventoActual(){
        $this->model->geteventoActual();
        $this->print = $this->view->getEventoActual($this->model->data);
    }
    
    function consultarAvisos(){
        $this->model->consultarAvisos();
        $this->print = $this->view->consultarAvisos($this->model->data);
    }
    
    function getEventos(){
        $this->print = $this->view->getEventos($this->model->getEventosActuales($this->request['id_tipo_evento']));
    }
}

?>
