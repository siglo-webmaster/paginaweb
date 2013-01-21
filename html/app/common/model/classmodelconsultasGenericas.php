<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classmodelconsultasGenericas
 *
 * @author oborja
 */
class classmodelconsultasGenericas {
    public $conn;
    public $connsh;
    public $status;
    public $data;
    
    function __construct(){
        try{
                $this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->status=true;
        }catch(PDOException $e){
                $this->status=false;
                echo $e->getMessage();
        }

    }
    
    function listarCiudadesporPais($id_pais){
        try{
            $query = "SELECT ciudades.id_ciudades, ciudades.nombre from ciudades where id_paises = :id_pais";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_pais', $id_pais,  PDO::PARAM_INT);
            $conn_prepare->execute();
            $result = $conn_prepare->fetchAll();
            if(sizeof($result)>0){
                $this->status = true;
                $this->data = $result;
            }else{
                $this->status = false;
            }
        }catch (PDOException $e){
            echo $e->getMessage();
            $this->status = false;
            return;
        }
        
    }
    
    function consultaFleteTransportadora($transportadora,$ciudad){
        $this->data = array(array('valor'=>'50000'));
        $this->status=true;
        
        try{
            $query = "SELECT tc.fletes from transportadoras_ciudades as tc where tc.id_transportadoras = :id_transportadoras and tc.id_ciudades = :id_ciudades";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_transportadoras', $transportadora,  PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_ciudades', $ciudad,  PDO::PARAM_INT);
            $conn_prepare->execute();
            $result = $conn_prepare->fetchAll();
            if(sizeof($result)>0){
                $this->status = true;
                $this->data = $result;
            }else{
                $this->status = false;
            }
        }catch (PDOException $e){
            echo $e->getMessage();
            $this->status = false;
            return;
        }
    }
    
     function listarPaises(){
        try{
            $query = "select * from paises";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->execute();
            $result = $conn_prepare->fetchAll();
            if(sizeof($result)>0){
                $this->status = true;
                $this->data = $result;
            }else{
                $this->status = false;
            }
        }catch (PDOException $e){
            echo $e->getMessage();
            $this->status = false;
            return;
        }
        
    }
    
    function disponibilidadUsername($username){
        
        try{
                    $query = "SELECT DISTINCT clientes.username FROM clientes WHERE clientes.username=:username ";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':username', $username, PDO::PARAM_STR);
                    $conn_prepare->execute( ) ;
                    $this->data=$conn_prepare->fetchAll();
                    $this->status= (sizeof($this->data)>0)? true:false;
                    
            }catch(PDOException $e){
                    $this->status=false;
                    echo $e->getMessage();
            }
            return $this->status;
        
    }
}

?>
