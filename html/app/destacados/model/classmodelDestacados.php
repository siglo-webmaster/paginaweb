<?php

class classmodelDestacados {
    public $conn;
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
    

        
        public function consultaDestacadosTitulos($data){
            try{
                unset( $this->data);
                $query = "select distinct * from view_titulos_destacados where id_lista_precios=:id_lista_precios and id_proveedores=:id_proveedores and fin > (select CURRENT_TIMESTAMP as ahora) and inicio <= (select CURRENT_TIMESTAMP as ahora)";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_lista_precios',$data['id_lista_precios'], PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_proveedores',$data['id_proveedores'], PDO::PARAM_INT);
                $conn_prepare->execute();
                $this->data =$conn_prepare->fetchAll(PDO::FETCH_NAMED);
                for($i=0;$i<sizeof($this->data);$i++){
                    $query = "select distinct * from titulos_atributos where id_titulos = :id_titulos";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_titulos',$this->data[$i]['id_titulos'], PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $temp = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    foreach($temp as $atributo){
                        $this->data[$i]['detalle'] [$atributo['llave']]=$atributo['valor'];
                    }
                }
                return (sizeof($this->data)>0)?true:false;
            }catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
            
        }

    
}

?>
