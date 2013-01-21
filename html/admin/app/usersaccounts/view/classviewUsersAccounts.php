<?php
require_once ("lib/structHTML.php");

class classviewUsersAccounts extends structHTML {
    var $data;
        
    function doLoginOk($data){
        $this->setBody($data);
        return $this->render();
    }
    
    function doLoginError(){
        $temp = "<div class='mensaje'>Nombre de usuario o contrase&nacute;a invalidos</div>";
        return $temp;
    }
    function formLogin($data = ''){
        $temp = $data."<form action='index.php'>".
                "<div class='campologin'>".
                "<strong>Usuario: </strong>".
                "<input type='text' name='user' >".
                "<strong>Password: </strong>".
                "<input type='text' name='passwd' >".
                "<input type='submit' value='Ingresar'>".
                "</div>".
                "<input type='hidden' name ='action' value='login' />".
                "</form>";
        $this->setBody($temp);
        return $this->render();
    }
    function doLogOut(){
        $temp = "<div class='mensaje'>Sesion de usuario Finalizada</div>";
        return $this->formLogin($temp);
    }
    
}

?>
