<?php
require_once("lib/dbConnection.php");
class classmodelUsersAccounts extends dbConnection {
    
    function getMenuUser($data){
        $query = "select nombre_modulo , id_modulos from view_usuarios_grupos_modulos where id_usuarios= :id_usuarios";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
        $conn_prepare->execute();
        
        $this->data =$conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function confirmarPermisosModulo($data){
        $query = "select nombre_modulo, id_modulos from view_usuarios_grupos_modulos where id_usuarios= :id_usuarios and id_modulos=:id_modulos";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
        $conn_prepare->bindParam(':id_modulos',$data['id_modulos'],PDO::PARAM_INT);
        $conn_prepare->execute();
        
        $this->data =$conn_prepare->fetchAll(PDO::FETCH_NAMED);
        return (sizeof($this->data)>0)?true:false;
    }
    
    function doLogin($data){
        return true;
    }
    function doLoOut(){
        return true;
    }
}

?>
