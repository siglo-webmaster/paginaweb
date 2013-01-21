<?php

class dbConnection {
    var $conn;
    var $status;
    var $data;
    
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
    
    function audit($tipo,$id_usuario,$nombre,$tabla,$consulta,$data){
        $return = false;
        $fecha = date('Y-m-d h:i:s');
        $ip = $this->getRealIpAddr();
        
        foreach($data as $key=>$value){
            $consulta = str_replace($key, "'".$value."'", $consulta);
        }
        
        $query = "insert into auditoria (fecha,tipo, id_usuarios,nombre, tabla, consulta,ip) values (:fecha,:tipo, :id_usuarios,:nombre, :tabla, :consulta, :ip)";
        try{
        
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':fecha',$fecha);
            $conn_prepare->bindParam(':tipo',$tipo,PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_usuarios',$id_usuario,PDO::PARAM_INT);
            $conn_prepare->bindParam(':nombre',$nombre,PDO::PARAM_INT);
            $conn_prepare->bindParam(':tabla',$tabla,PDO::PARAM_STR);
            $conn_prepare->bindPAram(':consulta',$consulta,PDO::PARAM_STR);
            $conn_prepare->bindPAram(':ip',$ip,PDO::PARAM_STR);
            $conn_prepare->execute();
            $return = true;
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $return;
        
    }
    
    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

?>
