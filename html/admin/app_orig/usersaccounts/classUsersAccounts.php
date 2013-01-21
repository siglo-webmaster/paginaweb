<?php
require_once ("model/classmodelUsersAccounts.php");
require_once ("view/classviewUsersAccounts.php");
require_once "view/classviewMenuUser.php";

class classUsersAccounts {
    var $data;
    var $view;
    var $model;
    var $print;
    
    function __construct($data=false){
        $this->data = $data;
        $this->model = new classmodelUsersAccounts();
        $this->view = new classviewUsersAccounts();
        
        if(isset($data['action'])){
           switch($data['action']){
               case 'login':{
                    $this->login();
                    echo $this->print;
                    exit(0);
                    break;   
               }
               case 'logout':{
                    $this->logOut();
                    echo $this->print;
                    exit(0);
                    break;   
               }
               case 'loadModule':{
                    $this->loadModule();
                    echo $this->print;
                    exit(0);
                    break;   
               }
           } 
        }else{
            echo $this->view->formLogin();
            return;
        }
    }
    
    function loadModule(){
        if($this->model->confirmarPermisosModulo(array('id_usuarios'=>1,'id_modulos'=>$this->data['id_module']))){
            eval('require_once("app/'.$this->model->data[0]['nombre_modulo'].'/class'.$this->model->data[0]['nombre_modulo'].'.php"); 
                    $module = new class'.$this->model->data[0]['nombre_modulo'].'($this->data);');
                    $this->view->setBody($this->getMenuUser().$module->print);
                    $this->view->setScript($module->script);
                    $this->view->setCss($module->css);
                    $this->print = $this->view->render();
        }else{
            echo "No tiene permisos para acceder a este modulo";
            exit(0);
        }
    }
    
    
    
    function login(){
        if((isset($this->data['user']))&&(isset($this->data['passwd']))){
            if($this->model->doLogin($this->data)){
                 
                 $this->print =$this->view->doLoginOk($this->getMenuUser());
            }else{
                 $this->print =$this->view->doLoginError();
            }
            
        }else{
            
            $this->print = $this->view->formLogin();
        }
    }
    
    function getMenuUser(){
        $this->model->getMenuUser(array('id_usuarios'=>1));
        $temp = new classviewMenuUser();
        return $temp->getMenuUser($this->model->data);
    }
    
    function logOut(){
        $this->model->doLoOut();
        $this->print =$this->view->doLogOut();
        
    }
}

?>
