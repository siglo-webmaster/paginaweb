<?php



class classmodelPagos {
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
    
    function registrarRespuesta($data){
        if(isset($data['ref_venta'])){
                list($id_ordenes,$id_ordenes_plataforma_pago) = explode('-',$data['ref_venta']);
        }else{
            return false;
        }
        $this->conn->beginTransaction();
        try{
                
            
                $query = "select * from view_ordenes_ordenes_plataforma_pago where 
                    estado_pago='PagoPendiente' 
                    and estado_orden='EnProceso' 
                    and estado='iniciado' 
                    and id_ordenes=:id_ordenes 
                    and id_ordenes_plataforma_pago=:id_ordenes_plataforma_pago ";

                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes', $id_ordenes, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_ordenes_plataforma_pago', $id_ordenes_plataforma_pago, PDO::PARAM_INT);
                $conn_prepare->execute();
                $temp = $conn_prepare->fetchAll();
                if(!sizeof($temp)>0){
                    echo "false";
                    return false;
                }
                
                foreach($data as $key => $value){
                    $query ="insert into detalles_ordenes_plataforma_pago (id_ordenes_plataforma_pago,llave,valor) values(:id_ordenes_plataforma_pago,:llave,:valor)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_ordenes_plataforma_pago', $id_ordenes_plataforma_pago, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':llave', $key, PDO::PARAM_STR);
                    $conn_prepare->bindParam(':valor', $value, PDO::PARAM_STR);
                    $conn_prepare->execute();
                }
                
                if(isset($data['codigo_respuesta_pol'])){
                
                    switch($data['codigo_respuesta_pol']){
                        case '1':{
                            ///exito!!
                            $estado = _PAGOAPROBADO;
                            $query = "update ordenes_plataforma_pago set fin_proceso='".date('Y-m-d h:i:s')."', estado=:estado, ip=:ip";
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_STR);
                            $conn_prepare->bindParam(':ip', $data['ip'], PDO::PARAM_STR);
                            $conn_prepare->execute();
                            
                            $query = "update ordenes set estado_pago=:estado_pago, fecha_confirmacion='".date('Y-m-d h:i:s')."', codigo_confirmacion=:codigo_confirmacion";
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':estado_pago', $estado, PDO::PARAM_STR);
                            $conn_prepare->bindParam(':codigo_confirmacion', $data['codigo_autorizacion'], PDO::PARAM_STR);
                            
                            $conn_prepare->execute();
                            
                            /*SALIDA HACIA SIGLO*/
                            
                            if(!$this->generarRuta($id_ordenes)){
                                $this->conn->rollBack();
                                return false;
                            }
                            
                            
                            /*FIN SALIDA HACIA SIGLO*/
                            
                            
                        break;   
                        }
                        default :{
                            $query ="";
                        }

                    }
                }else{
                    $query="";
                }
                
                
                $this->conn->commit();
                
                
                return true;
            
        }catch(PDOException $e){
            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
        
        return false;
        
    }
    
    function generarRuta($id_ordenes){
        try{
            $query = "select transportadora,pais, ciudad, id_ordenes,valor,nombre_corto,fletes,impuestos,descuentos, 
                id_ordenes_plataforma_pago, plataforma_pago, fin_proceso, id_ordenes_transportadoras, direccion_entrega, 
                nombre_destinatario, telefono_destinatario, email_destinatario, observaciones , 'PagoAprobado' 
                from view_ordenes_transportadoras_ciudad where id_ordenes = :id_ordenes";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_ordenes', $id_ordenes, PDO::PARAM_INT);
            $conn_prepare->execute();
            $ordenes_transportadoras  = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
            if(sizeof($ordenes_transportadoras)>0){
                foreach($ordenes_transportadoras as $row){
                    $query = "select id_tipos_productos,id_proveedores, codigo_producto,nombre_producto,cantidad from detalles_ordenes_transportadoras where id_ordenes_transportadoras=:id_ordenes_transportadoras";
                    $conn_prepare =$this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_ordenes_transportadoras', $row['id_ordenes_transportadoras'], PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $toStore='#@#"'.implode('"~"',$row).'"#@#';
                    $temp=$conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    if(sizeof($temp)){
                        foreach($temp as $detalleitem){
                            $toStore.='#@#"'.implode('"~"',$detalleitem).'"#@#';
                        }
                    }else{
                        return false;
                    }
                    file_put_contents("bridgeSiglo/".$row['id_ordenes_transportadoras'].".txt", $toStore);
                }
                return true;
            }else{
                return false;
            }
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
}

?>
