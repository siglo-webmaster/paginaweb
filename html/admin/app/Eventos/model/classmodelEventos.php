<?php
require_once("lib/dbConnection.php");

class classmodelEventos extends dbConnection{
    
    function listEventos(){
        $query = "select e.*, te.nombre as tipo_eventos from eventos as e inner join tipo_eventos as te on te.id_tipo_eventos = e.id_tipo_eventos";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getTipoEventos(){
        $query = "select * from tipo_eventos where estado='activo'";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getDatosEvento($data){
        $query = "select * from eventos where id_eventos = :id_eventos";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_eventos',$data['id_eventos'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        if(!is_array($return))return false;
        
        $query = "select * from eventos_atributos where id_eventos = :id_eventos";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_eventos',$data['id_eventos'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return[0]['detalle'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        return (is_array($return[0]['detalle']))?$return:false;
        
    }
    
    function saveEvento($data){
        
        if(isset($_FILES["imagen"])){
            if($_FILES["imagen"]["name"]==''){
                if(isset($data['imagen_actual'])){
                    $data['imagen']=$data['imagen_actual'];
                }
                
            }else{
                $this->loadFile();
                $data['imagen']="images/eventos/".$_FILES["imagen"]["name"];
            }
        }
        
        switch($data['id_eventos']){
            case 'false':{
                return $this->saveNuevoEvento($data);
                break;
            }
            default:{
                return $this->saveEditEvento($data);
                break;
            }
        }
    }
    
    function saveNuevoEvento($data){
       
        $atributos = array('imagen','descripcion');
        
        
        $this->conn->beginTransaction();
        try{
            $query = "insert into eventos (id_tipo_eventos,id_usuarios,nombre, inicio, fin,estado) values(:id_tipo_eventos,:id_usuarios,:nombre, :inicio, :fin, :estado)";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_tipo_eventos',$data['id_tipo_eventos'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':inicio',$data['inicio'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fin',$data['fin'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->execute();
            
            $lastId = $this->conn->lastInsertId('id_eventos');
            
            foreach($atributos as $atributo){
                if(isset($data[$atributo])){
                    $query = "insert into eventos_atributos(id_eventos,llave,valor,estado) values(:id_eventos,:llave,:valor,:estado)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_eventos',$lastId,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':llave',$atributo,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':valor',$data[$atributo],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
                    
                    $conn_prepare->execute();
                    
                }
                
            }
            
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    function saveEditEvento($data){
       
        $atributos = array('imagen','descripcion');
        
        
        $this->conn->beginTransaction();
        try{
            $query = "update eventos set id_tipo_eventos=:id_tipo_eventos,id_usuarios=:id_usuarios,nombre=:nombre, inicio=:inicio, fin=:fin,estado=:estado where id_eventos = :id_eventos";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_tipo_eventos',$data['id_tipo_eventos'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_usuarios',$data['id_usuarios'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':inicio',$data['inicio'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fin',$data['fin'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_eventos',$data['id_eventos'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $query = "delete from eventos_atributos where id_eventos =:id_eventos";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_eventos',$data['id_eventos'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            foreach($atributos as $atributo){
                if(isset($data[$atributo])){
                    $query = "insert into eventos_atributos(id_eventos,llave,valor,estado) values(:id_eventos,:llave,:valor,:estado)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_eventos',$data['id_eventos'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':llave',$atributo,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':valor',$data[$atributo],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
                    
                    $conn_prepare->execute();
                    
                }
                
            }
            
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    function delEvento($data){
        $this->conn->beginTransaction();
        try{
            $query = "delete from eventos_atributos where id_eventos=:id_eventos";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_eventos',$data['id_eventos'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $query = "delete from eventos where id_eventos=:id_eventos";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_eventos',$data['id_eventos'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){
            $this->conn->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    function loadFile(){
        if ((($_FILES["imagen"]["type"] == "image/gif") ||($_FILES["imagen"]["type"] == "image/png") || ($_FILES["imagen"]["type"] == "image/jpeg")|| ($_FILES["imagen"]["type"] == "image/pjpeg")) )
        {
            if ($_FILES["imagen"]["error"] > 0)
                {
                echo "Return Code: " . $_FILES["imagen"]["error"] . "<br />";
                return false;
                }
            else
                {
                    if (file_exists("../images/eventos/" . $_FILES["imagen"]["name"]))
                    {
                        unlink("../images/eventos/" . $_FILES["imagen"]["name"]);
                    }

                    move_uploaded_file($_FILES["imagen"]["tmp_name"],"../images/eventos/" . $_FILES["imagen"]["name"]);
                    return true;
                }
            }
            else
            {
            echo "Invalid file";
            return false;
        }
        
        
    }
    
}

?>
