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
        $estado ='activo';
        $data['user'] = trim($data['user']);
        $data['passwd']= trim($data['passwd']);
        $query = "select * from usuarios where email=:email and passwd=:passwd and estado=:estado";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam(':email',$data['user'],PDO::PARAM_STR);
        $conn_prepare->bindParam(':passwd',$data['passwd'],PDO::PARAM_STR);
        $conn_prepare->bindParam(':estado',$estado,PDO::PARAM_STR);
        $conn_prepare->execute();
        $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        if(is_array($this->data)){
            if(sizeof($this->data)==1){
                $_SESSION['loginAdmin']=true;
                $_SESSION['userAdmin']=$this->data[0]['id_usuarios'];
                $_SESSION['nombre']=$this->data[0]['nombre'];
                $_SESSION['email']=$this->data[0]['email'];
               // $_SESSION['groupAdmin']=$this->data[0]['id_usuarios'];
                return $this->data;
            }
        }
        return false;
    }
    
    function isLogin(){
        if(!isset($_SESSION['loginAdmin']))return false;
        if(!isset($_SESSION['userAdmin']))return false;
        return true;
    }
    
    function doLoOut(){
        unset($_SESSION['loginAdmin']);
        unset($_SESSION['userAdmin']);
        return true;
    }
}

?>
