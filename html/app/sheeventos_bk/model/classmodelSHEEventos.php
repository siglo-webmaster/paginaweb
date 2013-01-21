<?php

class classmodelSHEEventos{
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
    
    function geteventoActual($tipo_evento=false){
        
        $filtro = ($tipo_evento!=false)?" and id_tipo_eventos = ".$tipo_evento:'';
        
        try{
            $query = "select id_eventos, id_tipo_eventos, inicio, fin from eventos where fin > (select CURRENT_TIMESTAMP as ahora) and inicio <= (select CURRENT_TIMESTAMP as ahora) and estado= 'activo' ".$filtro;
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->execute();
            $result = $conn_prepare->fetchAll();
            if(sizeof($result)>0){
                $this->status = true;
                $this->data['eventos'] = $result;
                
                $query = "select * from eventos_atributos where id_eventos = :id_eventos";
                
                foreach($this->data['eventos'] as $row){
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_eventos', $row['id_eventos'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $this->data['atributos'][$row['id_eventos']] = $conn_prepare->fetchAll();
                }
                
            }else{
                $this->data=false;
                $this->status = false;
            }
        }catch (PDOException $e){
            echo $e->getMessage();
            $this->status = false;
            return;
        }
        
    }
    
    function consultarAvisos(){
        $this->geteventoActual(2);
    }
    
}

?>
