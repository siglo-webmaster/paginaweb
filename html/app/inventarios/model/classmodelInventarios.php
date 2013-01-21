<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classmodelInventarios
 *
 * @author oborja
 */
class classmodelInventarios {
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
    
    function getStock($data){
        try{
            $query = "select * from titulos_proveedores_bodegas where id_titulos=:id_titulos and id_proveedores =:id_proveedores ans id_bodegas=:id_bodegas";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_titulos', $data['id_titulos'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_proveedores', $data['id_proveedores'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_bodegas', $data['id_bodegas'],PDO::PARAM_INT);
            $conn_prepare->execute();
            $this->data = $conn_prepare->fetchAll();
        }  catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
        
        if($this->data){
            return true;
        }else{
            return false;
        }
    }
    
    function setStock($data){
        $this->conn->beginTransaction();
        try{
            $existe =false;
            $query = "select * from  titulos_proveedores_bodegas where id_titulos=:id_titulos and id_proveedores =:id_proveedores and id_bodegas=:id_bodegas limit 0,1";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_titulos', $data['id_titulos'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_proveedores', $data['id_proveedores'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_bodegas', $data['id_bodegas'],PDO::PARAM_INT);
            $conn_prepare->execute();
            $stocks = $conn_prepare->fetchAll();
            if(sizeof($stocks)>0){
                $stock_actual = $stocks[0]['stock'];
                $reservado_actual = $stocks[0]['reservado'];
                $existe=true;
                if ($stock_actual ==$data['stock']){
                    echo "\n".$data['codigo']." No cambio stock , sera ignorado";
                    $this->conn->rollBack();
                    return true;
                }
                
            }else{
                $stock_actual =0;
                $reservado_actual=0;
            }
            
            
            if($existe){
                $query = "update titulos_proveedores_bodegas set stock=:stock, reservado=:reservado, ultima_modificacion=:ultima_modificacion where id_titulos=:id_titulos  and id_proveedores=:id_proveedores and id_bodegas=:id_bodegas";
            }else{
                $query = "insert into titulos_proveedores_bodegas (id_titulos,  id_proveedores, id_bodegas, stock,reservado, ultima_modificacion) values (:id_titulos,  :id_proveedores, :id_bodegas, :stock, :reservado, :ultima_modificacion)";
            }
            
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':stock', $data['stock'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':reservado', $data['reservado'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_titulos', $data['id_titulos'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_proveedores', $data['id_proveedores'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_bodegas', $data['id_bodegas'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':ultima_modificacion', $data['fecha']);
            $conn_prepare->execute();
            
            
            ob_start();
            $conn_prepare->debugDumpParams();
            $sql1 = ob_get_contents();
            ob_end_clean();
            foreach($data as $key=>$value){
                $sql1.=" \n\n".$key."=>".$value;
            }
             
            ////AUDITORIA EN STOCK
            $query = "insert into aud_titulos_proveedores_bodegas ( id_titulos, codigo, id_proveedores, id_bodegas, stock_inicial, stock_final,reservado_inicial, reservado_final, fecha_proceso, usuario, sql1 ) values 
                                        ( :id_titulos, :codigo, :id_proveedores, :id_bodegas , :stock_inicial, :stock_final, :reservado_inicial, :reservado_final, :fecha_proceso, :usuario, :sql)";
            
            $conn_prepare = $this->conn->prepare($query);
          
            $conn_prepare->bindParam(':id_titulos', $data['id_titulos'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':codigo', $data['codigo'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_proveedores', $data['id_proveedores'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':id_bodegas', $data['id_bodegas'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':stock_inicial', $stock_actual,PDO::PARAM_INT);
            $conn_prepare->bindParam(':stock_final', $data['stock'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':reservado_inicial', $reservado_actual,PDO::PARAM_INT);
            $conn_prepare->bindParam(':reservado_final', $data['reservado'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':fecha_proceso', $data['fecha']);
            $conn_prepare->bindParam(':usuario', $data['id_usuario']);
            $conn_prepare->bindParam(':sql', $sql1,PDO::PARAM_STR);
            $conn_prepare->execute();
            /////FIN AUDITORIA
            
           
            $this->conn->commit();
        }  catch (PDOException $e){
            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
       
        return true;
       
    }
    
    function getDataItem($item){
        $query = "select id_titulos, id_proveedores from titulos_proveedores where codigo=:item limit 0,1";
        $conn_prepare =$this->conn->prepare($query);
        $conn_prepare->bindParam(':item', $item,PDO::PARAM_STR);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll();
        
    }
    
}

?>
