<?php
require_once("lib/dbConnection.php");

class classmodelModulos extends dbConnection{
    
    function listModulos(){
        $query = "select * from modulos ";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
   
    
    
    function saveModulo($data){

        switch($data['id_modulos']){
            case 'false':{
                return $this->saveNuevoModulo($data);
                break;
            }
            default:{
                return $this->saveEditModulo($data);
                break;
            }
        }
    }
    
    function saveNuevoModulo($data){
       
        $this->conn->beginTransaction();
        try{
            $query = "insert into modulos (nombre, estado ) values (:nombre, :estado) ";
            $conn_prepare = $this->conn->prepare($query);
            
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->execute();
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    
    function getDatosModulo($data){
        $query = "select * from modulos where id_modulos = :id_modulos";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_modulos',$data['id_modulos'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        if(!is_array($return)){
            return false;
        }
        
        return (is_array($return))?$return:false;
        
        
    }
    
    
    
    
    function saveEditModulo($data){
        
        $this->conn->beginTransaction();
        try{
            $query = "update modulos set 
                nombre=:nombre, estado=:estado where id_modulos=:id_modulos";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_modulos',$data['id_modulos'],PDO::PARAM_INT);
            $conn_prepare->execute();

            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    
    
    function delModulo($data){
        $this->conn->beginTransaction();
        try{
            
            $query = "delete from modulos where id_modulos=:id_modulos";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_modulos',$data['id_modulos'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){
            $this->conn->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    
    
}

?>
