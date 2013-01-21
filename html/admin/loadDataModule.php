<?php
require_once("../config.php");
require_once("app/usersaccounts/model/classmodelUsersAccounts.php");
$useraccount = new classmodelUsersAccounts();

if($useraccount->confirmarPermisosModulo(array('id_usuarios'=>1,'id_modulos'=>$_REQUEST['id_module']))){
    eval('require_once("app/'.$useraccount->data[0]['nombre_modulo'].'/class'.$useraccount->data[0]['nombre_modulo'].'.php"); 
            $module = new class'.$useraccount->data[0]['nombre_modulo'].'($_REQUEST);');
    echo $module->print;
}
?>
