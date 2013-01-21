<?php
session_start();$_SESSION['name'] = "adminSigloWeb";if (!isset($_SESSION['initiated'])){session_regenerate_id();$_SESSION['initiated'] = true;}
require_once("lib/request.php");
class adminSystemSHE extends request {
    
    function __construct() {
        parent::__construct();
        
        if($this->isLoginAdmin()){
            echo "Login ok";
        }else{
            require_once("app/usersaccounts/classUsersAccounts.php");
            $user = new classUsersAccounts($this->request);
            exit(0);
        }
    }
    
    function isLoginAdmin(){
        if(!isset($_SESSION['loginAdmin']))return false;
        if($_SESSION['loginAdmin']=='')return false;
        if(!isset($_SESSION['userAdmin']))return false;
        if(!isset($_SESSION['groupAdmin']))return false;
        return true;
    }
   
}

?>
