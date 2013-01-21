<?php
require_once("lib/dbConnection.php");

class classmodelClientes extends dbConnection{
    
    function listClientes(){
        $query = "select c.id_clientes, c.username, c.nombre, c.direccion, c.telefono, c.email, c.estado, ciu.nombre as nombre_ciudad from clientes as c 
            inner join ciudades as ciu on ciu.id_ciudades=c.id_ciudades";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
   
    function getTiposDocumento(){
        try{
            $query = "select * from tipo_documento";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->execute();
            $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
            return (is_array($return))?$return:false;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
        
    }
    
    function getCiudades(){
        try{
            $query = "select * from ciudades";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->execute();
            $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
            return (is_array($return))?$return:false;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
        
    }
    
    
    function saveCliente($data){

        switch($data['id_clientes']){
            case 'false':{
                return $this->saveNuevoCliente($data);
                break;
            }
            default:{
                return $this->saveEditCliente($data);
                break;
            }
        }
    }
    
    function saveNuevoCliente($data){
       
        $this->conn->beginTransaction();
        try{
            $query = "insert into clientes (id_tipo_documento,nit,username,passwd,nombre, direccion, telefono, email, contacto, telefono_contacto, id_ciudades,estado) values(:id_tipo_documento,:nit,:username,:passwd,:nombre, :direccion, :telefono, :email, :contacto, :telefono_contacto, :id_ciudades, :estado)";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_tipo_documento',$data['id_tipo_documento'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':nit',$data['nit'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':username',$data['username'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':passwd',$data['username'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':direccion',$data['direccion'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':telefono',$data['telefono'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':contacto',$data['contacto'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':telefono_contacto',$data['telefono_contacto'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_ciudades',$data['id_ciudades'],PDO::PARAM_INT);
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
    
    
    function getDatosCliente($data){
        $query = "select * from clientes where id_clientes = :id_clientes";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_clientes',$data['id_clientes'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        return (is_array($return))?$return:false;
        
        
    }
    
    
    
    
    function saveEditCliente($data){
        
        
        $this->conn->beginTransaction();
        try{
            $query = "update clientes set id_tipo_documento=:id_tipo_documento,nit=:nit,username=:username,
                nombre=:nombre, direccion=:direccion, telefono=:telefono, email=:email,contacto=:contacto, 
                telefono_contacto=:telefono_contacto, id_ciudades=:id_ciudades,estado=:estado where id_clientes=:id_clientes";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_tipo_documento',$data['id_tipo_documento'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':nit',$data['nit'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':username',$data['username'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':direccion',$data['direccion'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':telefono',$data['telefono'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':email',$data['email'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':contacto',$data['contacto'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':telefono_contacto',$data['telefono_contacto'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_ciudades',$data['id_ciudades'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_clientes',$data['id_clientes'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    
    
    function delCliente($data){
        $this->conn->beginTransaction();
        try{
            
            $query = "delete from clientes where id_clientes=:id_clientes";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_clientes',$data['id_clientes'],PDO::PARAM_INT);
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
            $query = "update clientes set passwd=:passwd where id_clientes=:id_clientes";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':passwd',$data['passwd'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_clientes',$data['id_clientes'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
}

?>
