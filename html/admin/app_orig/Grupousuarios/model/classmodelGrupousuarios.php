<?php
require_once("lib/dbConnection.php");

class classmodelGrupousuarios extends dbConnection{
    
    function listGrupousuarios(){
        $query = "select * from grupos_usuarios ";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
   
    
    
    function saveGrupousuario($data){

        switch($data['id_grupos_usuarios']){
            case 'false':{
                return $this->saveNuevoGrupousuario($data);
                break;
            }
            default:{
                return $this->saveEditGrupousuario($data);
                break;
            }
        }
    }
    
    function saveNuevoGrupousuario($data){
       
        $this->conn->beginTransaction();
        try{
            $query = "insert into grupos_usuarios (nombre, estado ) values (:nombre, :estado) ";
            $conn_prepare = $this->conn->prepare($query);
            
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->execute();
            
            $grupos =$this->listModulos();
            
            $data['id_grupos_usurios'] = $this->conn->lastInsertId('id_grupos_usurios');
            
            foreach ($grupos as $row){
                if(isset($data[$row['nombre']])){
                    $query = "insert into modulos_grupos_usuarios (id_modulos, id_grupos_usuarios ) values (:id_modulos, :id_grupos_usuarios) ";
                    $conn_prepare = $this->conn->prepare($query);

                    $conn_prepare->bindParam(':id_modulos',$row['id_modulos'],PDO::PARAM_INT);

                    $conn_prepare->bindParam(':id_grupos_usuarios',$data['id_grupos_usurios'],PDO::PARAM_INT);
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
    
    
    function getDatosGrupousuario($data){
        $query = "select * from grupos_usuarios where id_grupos_usuarios = :id_grupos_usuarios";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_grupos_usuarios',$data['id_grupos_usuarios'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        if(!is_array($return)){
            return false;
        }
        
        $query = "select m.* from modulos_grupos_usuarios as mgu 
            inner join modulos as m on m.id_modulos=mgu.id_modulos
            where mgu.id_grupos_usuarios = :id_grupos_usuarios";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam(':id_grupos_usuarios',$data['id_grupos_usuarios'],PDO::PARAM_INT);
        $conn_prepare->execute();
        
        $return[0]['modulos'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        return (is_array($return))?$return:false;
        
        
    }
    
    
    
    
    function saveEditGrupousuario($data){
        
        $this->conn->beginTransaction();
        try{
            $query = "update grupos_usuarios set 
                nombre=:nombre, estado=:estado where id_grupos_usuarios=:id_grupos_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_grupos_usuarios',$data['id_grupos_usuarios'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
           
            
            $query = "delete from modulos_grupos_usuarios where  id_grupos_usuarios=:id_grupos_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_grupos_usuarios',$data['id_grupos_usurios'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $grupos =$this->listModulos();
             
            foreach ($grupos as $row){
                if(isset($data[$row['nombre']])){
                    $query = "insert into modulos_grupos_usuarios (id_modulos, id_grupos_usuarios ) values (:id_modulos, :id_grupos_usuarios) ";
                    $conn_prepare = $this->conn->prepare($query);

                    $conn_prepare->bindParam(':id_modulos',$row['id_modulos'],PDO::PARAM_INT);

                    $conn_prepare->bindParam(':id_grupos_usuarios',$data['id_grupos_usurios'],PDO::PARAM_INT);
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
    
    
    
    function delGrupousuario($data){
        $this->conn->beginTransaction();
        try{
            
            $query = "delete from grupos_usuarios where id_grupos_usuarios=:id_grupos_usuarios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_grupos_usuarios',$data['id_grupos_usuarios'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){
            $this->conn->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    
    function listModulos(){
        $query = "select * from modulos ";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
    }
}

?>
