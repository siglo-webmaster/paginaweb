<?php

class classmodelUsers {
    public $con;
    public $data;
    public $status;
    
    function __construct() {
        try{
                    $this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->status=true;
            }catch(PDOException $e){
                    $this->status=false;
                    echo $e->getMessage();
            }
    }
    
    function doLogin($data){
        
            try{
                    $estado_usuario='activo';
                    $query = "SELECT DISTINCT clientes.id_clientes as idcliente, clientes.nit, clientes.username, clientes.nombre, clientes.direccion, clientes.telefono, clientes.email, clientes.contacto, clientes.telefono_contacto as telefonocontacto, clientes.id_ciudades as idciudad FROM clientes WHERE clientes.username=:username AND clientes.passwd=:passwd AND clientes.estado=:estado limit 0,1";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':username', $data['username'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':passwd', $data['passwd'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':estado', $estado_usuario ,PDO::PARAM_STR);
                    $conn_prepare->execute( ) ;
                    $this->data=$conn_prepare->fetchAll();
                    $this->status= (sizeof($this->data)>0)? true:false;
                    
            }catch(PDOException $e){
                    $this->status=false;
                    echo $e->getMessage();
            }
            return $this->status;
    }
    
    function reloadData($id_cliente){
        
            try{
                    $estado_usuario='activo';
                    $query = "SELECT distinct clientes.id_clientes as idcliente, clientes.nit, clientes.username, clientes.nombre, clientes.direccion, clientes.telefono, clientes.email, clientes.contacto, clientes.telefono_contacto as telefonocontacto, clientes.id_ciudades as idciudad from clientes where clientes.id_clientes=:id_cliente and clientes.estado=:estado limit 0,1";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_cliente', $id_cliente,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':estado', $estado_usuario ,PDO::PARAM_STR);
                    $conn_prepare->execute( ) ;
                    $this->data=$conn_prepare->fetchAll();
                    $this->status= (sizeof($this->data)>0)? true:false;
                    
            }catch(PDOException $e){
                    $this->status=false;
                    echo $e->getMessage();
            }
            return $this->status;
    }
    
    function saveData($data){
       // var_dump($data);
            try{
                   $this->conn->beginTransaction();
                   
                    $query = "UPDATE clientes SET nit = :nit, nombre = :nombre, direccion = :direccion, telefono = :telefono, email = :email, contacto = :contacto, telefono_contacto = :telefono_contacto, id_ciudades = :id_ciudades WHERE id_clientes = :id_clientes";

                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':nit', $data['request']['nit'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':nombre', $data['request']['nombre'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':direccion', $data['request']['direccion'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':telefono', $data['request']['telefono'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':email', $data['request']['email'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':contacto', $data['request']['contacto'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':telefono_contacto', $data['request']['telefonocontacto'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':id_ciudades', $data['request']['idciudad'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':id_clientes', $data['cliente']->idcliente,PDO::PARAM_STR);
                    
                    $this->status= $conn_prepare->execute();
                    
                    $this->conn->commit();
                    
            }catch(PDOException $e){
                    $this->conn->rollBack();
                    $this->status=false;
                    echo $e->getMessage();
            }
            return $this->status;
    }
    
    function getCities(){
        
            try{
                    $estado_usuario='activo';
                    $query = "SELECT id_ciudades, nombre from ciudades order by nombre";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->execute( ) ;
                    $this->data=$conn_prepare->fetchAll();
                    $this->status= (sizeof($this->data)>0)? true:false;
                    
            }catch(PDOException $e){
                    $this->status=false;
                    echo $e->getMessage();
            }
            return $this->status;
    }
    
    function gettipoDocumento(){
        try{
                    $estado_usuario='activo';
                    $query = "SELECT * from tipo_documento";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->execute( ) ;
                    $this->data=$conn_prepare->fetchAll();
                    $this->status= (sizeof($this->data)>0)? true:false;
                    
            }catch(PDOException $e){
                    $this->status=false;
                    echo $e->getMessage();
            }
            return $this->status;
    }
    
    function crearUsuario($data){
        
         try{
                   $this->conn->beginTransaction();
                   $estado = _ACTIVO;
                   $passwd = $this->generarPassword(_SIZEPASSWORD);
                   
                    $query ="insert into clientes(nit, username, passwd, nombre, direccion, telefono, email,  id_ciudades, estado, id_tipo_documento) values (:nit, :username, :passwd, :nombre, :direccion, :telefono, :email,  :id_ciudades, :estado, :tipo_documento)"; 

                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':nit', $data['identificacion'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':username', $data['username'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':passwd', $passwd,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':nombre', $data['nombre'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':direccion', $data['direccion'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':telefono', $data['telefono'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':email', $data['email'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':id_ciudades', $data['ciudades'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':tipo_documento', $data['documentos'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':estado', $estado,PDO::PARAM_STR);
                    
                    
                    $this->status= $conn_prepare->execute();
                    
                    $this->conn->commit();
                    
            }catch(PDOException $e){
                    $this->conn->rollBack();
                    $this->status=false;
                    echo $e->getMessage();
                    return;
            }
            
            require_once("app/common/classEmail.php");
            $email = new classEmail(array('to'=>$data['email'],'username'=>$data['username'],'password'=>$passwd));
            $email->send();
            return $this->status;
    }
    
    function generarPassword($size){
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for($i=0;$i<$size;$i++) {
            $cad .= substr($str,rand(0,62),1);
        }
        return $cad;
    }
    

    
   
}

?>
