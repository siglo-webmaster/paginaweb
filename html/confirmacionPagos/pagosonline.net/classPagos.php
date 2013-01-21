<?php
        require_once("app/common/classSHBaseSystem.php");
        require_once ("model/classmodelPagos.php");

	class classPagos extends classSHBaseSystem {
            
            function __construct($habilitar = false){
                $this->getRequest();
                $this->model = new classmodelPagos();
                $this->model->registrarRespuesta($this->request);
            }
            
            
        }
?>