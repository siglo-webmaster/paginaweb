<?php
require_once("lib/dbConnection.php");

class classmodelMicrositios extends dbConnection{
    
    function listMicrositios(){
        $query = "select * from micrositios";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getPlantillas(){
        $directorio=opendir("/home/adso/public_html/SigloWeb/app/micrositios/plantillas/"); 
        $return =false;
        while ($archivo = readdir($directorio)){
            if(($archivo!='.')&&$archivo!='..'){
                $return[]=$archivo; 
            }
            
        }
        
        closedir($directorio); 
        return $return;
    }
    
    function getDatosMicrositio($data){

        $query = "select * from micrositios where id_micrositios = :id_micrositios";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_micrositios',$data['id_micrositios'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        if(!is_array($return))return false;
        
        
        
        return (is_array($return))?$return:false;
        
    }
    
    function saveMicrositio($data){

        switch($data['id_micrositios']){
            case 'false':{
                return $this->saveNuevoMicrositio($data);
                break;
            }
            default:{
                return $this->saveEditMicrositio($data);
                break;
            }
        }
    }
    
    function saveNuevoMicrositio($data){
       
        $this->conn->beginTransaction();
        try{
            $data['path'] = "";
            
            $query = "insert into micrositios (nombre, path, fecha_inicio, fecha_fin, plantilla, estado) values (:nombre, :path, :fecha_inicio, :fecha_fin, :plantilla, :estado)";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':path',$data['path'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':plantilla',$data['plantilla'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fecha_inicio',$data['fecha_inicio'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fecha_fin',$data['fecha_fin'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->execute();
            
            $lastId = $this->conn->lastInsertId('id_micrositios');
            
            
            
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    function saveEditMicrositio($data){
        
        
        $this->conn->beginTransaction();
        try{
            $query = "update micrositios set nombre=:nombre, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, plantilla=:plantilla, estado=:estado where id_micrositios = :id_micrositios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_micrositios',$data['id_micrositios'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fecha_inicio',$data['fecha_inicio'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fecha_fin',$data['fecha_fin'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':plantilla',$data['plantilla'],PDO::PARAM_STR);
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
    
    function delMicrositio($data){
        $this->conn->beginTransaction();
        try{
            
            $query = "delete from micrositios where id_micrositios=:id_micrositios";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_micrositios',$data['id_micrositios'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){
            $this->conn->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    
    function getTitulosDestacados($data){
        $return=false;
        for($i=0;$i<$data['numeroSeleccionados'];$i++){
            if(isset($data['seleccionado_'.$i])){
                $return[]=$data['seleccionado_'.$i];
            }
        }
        return $return;
    }
    
}

?>
