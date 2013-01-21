<?php
require_once("lib/dbConnection.php");

class classmodelUsuarios extends dbConnection{
    
    function listUsuarios(){
        $query = "select * from usuarios ";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
   
    
    
    function saveUsuario($data){

        switch($data['id_usuarios']){
            case 'false':{
                return $this->saveNuevoUsuario($data);
                break;
            }
            default:{
                return $this->saveEditUsuario($data);
                break;
            }
        }
    }
    
    function saveNuevoUsuario($data){
       
        $this->conn->beginTransaction();
        try{
            $query = "insert into usuarios (email, nombre, passwd, estado ) values (:email, :nombre, :passwd, :estado) ";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':passwd',$data['username'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->execute();
            
            $data['id_usuarios'] = $this->conn->lastInsertId('id_usuarios');
            
            $gruposusuarios = $this->getGruposUsuarios();
            foreach ($gruposusuarios as $row){
                if(isset($data[$row['nombre']])){
                    $query = "insert into usuarios_grupos_usuarios (id_grupos_usuarios,id_usuarios) values (:id_grupos_usuarios,:id_usuarios)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_grupos_usuarios',$row['id_grupos_usuarios'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                }
            }
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    
    function getDatosUsuario($data){
        $query = "select * from usuarios where id_usuarios = :id_usuarios";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        if(!is_array($return)){
            return false;
        }
        
        $query = "select * from usuarios_grupos_usuarios where id_usuarios = :id_usuarios";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return[0]['gruposusuarios'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        return (is_array($return))?$return:false;
        
        
    }
    
    
    
    
    function saveEditUsuario($data){
        
        $this->conn->beginTransaction();
        try{
            $query = "update usuarios set 
                nombre=:nombre, email=:email,estado=:estado where id_usuarios=:id_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
            $conn_prepare->execute();

            $query = "delete from usuarios_grupos_usuarios where id_usuarios=:id_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $gruposusuarios = $this->getGruposUsuarios();
            foreach ($gruposusuarios as $row){
                if(isset($data[$row['nombre']])){
                    $query = "insert into usuarios_grupos_usuarios (id_grupos_usuarios,id_usuarios) values (:id_grupos_usuarios,:id_usuarios)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_grupos_usuarios',$row['id_grupos_usuarios'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                }
            }
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    
    
    function delUsuario($data){
        $this->conn->beginTransaction();
        try{
            
            $query = "delete from usuarios where id_usuarios=:id_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){
            $this->conn->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    
    
    function savePasswd($data){
        
        $this->conn->beginTransaction();
        try{
            $query = "update usuarios set passwd=:passwd where id_usuarios=:id_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':passwd',$data['passwd'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    function getGruposUsuarios(){
        
        try{
            $query = "select * from grupos_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->execute();
            $return =$conn_prepare->fetchAll(PDO::FETCH_NAMED);
            
            return (is_array($return))?$return:false;
            
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}

?>
