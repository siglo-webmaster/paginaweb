<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classCarrusel
 *
 * @author oborja
 */
require_once("view/classviewCarrusel.php");
require_once('app/common/classSHBaseSystem.php');
class classCarrusel extends classSHBaseSystem {
    
    function __construct() {
        $this->getRequest();

        $this->view = new classviewCarrusel();
        if(isset($this->request['action'])){
            switch($this->request['action']){
                case 'mostrarPublicidad':{

                    $this->print = $this->view->getPublicidad($this->request['url']);
                    echo $this->print;
                    return;
                    break;   
                }
                default:{
                    $this->print = $this->view->getCarrusel();
                    return;
                }
            }
        }else{
            
            $this->print = $this->view->getCarrusel();
            return;
        }
        
    }
}

?>
