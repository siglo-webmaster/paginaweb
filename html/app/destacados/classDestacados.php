<?php
        require_once("app/common/classSHBaseSystem.php");
        require_once("app/common/view/classviewXML.php");
        require_once ("model/classmodelDestacados.php");
        require_once ("view/classviewDestacados.php");

        
        
	class classDestacados extends classSHBaseSystem {
            public $xml;
            function __construct(){
                $this->print='';
                $this->model = new classmodelDestacados();
                $this->view = new classviewDestacados();
                $this->xml = new classviewXML();               
                $this->getRequest(); //PROCESAR VARIABES DE SESSION Y REQUEST
                if(isset($this->request['action'])){
                    switch($this->request['action']){
                        case 'consultarDestacadosTitulos':{
                            $this->consultarDestacadosTitulos();
                            echo $this->print;
                            exit(0);
                            break;
                        }
                        case 'consultarDestacadosEditoriales':{
                            $this->consultarDestacadosEditoriales();
                            echo $this->print;
                            exit(0);
                            break;
                        }
                    }
                }else{
                    return;
                }
            }
            
 
            public function consultarDestacadosTitulos(){
                if($this->model->consultaDestacadosTitulos($this->request)){
                    $this->print = $this->view->consultaDestacadosTitulos($this->model->data);
                }else{
                    $this->print="";
                }
            }
            
            public function consultarDestacadosEditoriales(){
                if($this->model->consultaDestacadosTitulos($this->request)){
                    $this->print = $this->view->consultaDestacadosTitulos($this->model->data);
                }else{
                    $this->print="";
                }
            }

            public function crearDestacado(){

            }
            public function modificarDestacado(){

            }
            public function borrarDestacado(){

            }
            
        }
?>