<?php


class classmodelgatewayPagos {
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
    
    function listarPlataformas(){
        unset($this->data);
        try{
            $estado='activo';
            $query = "select * from plataforma_pago where estado = :estado";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':estado', $estado);
            
            $conn_prepare->execute();
            $this->data = $conn_prepare->fetchAll();
            return true;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    function getPlataforma($id_plataforma){
        unset($this->data);
        try{
            $estado='activo';
            $query = "select * from plataforma_pago where id_plataforma_pago = :id_plataforma";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_plataforma', $id_plataforma);
            
            $conn_prepare->execute();
            $this->data = $conn_prepare->fetchAll();
            return true;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
     function getparametrosPlataforma($id_plataforma){
        unset($this->data);
         try{
            $estado='activo';
            $query = "select * from parametros_plataforma_pago where id_plataforma_pago = :id_plataforma";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_plataforma', $id_plataforma);
            
            $conn_prepare->execute();
            $this->data = $conn_prepare->fetchAll();
            return true;
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    function cargarPlataforma($pedido,$plataforma,$parametros){
        
        $this->conn->beginTransaction();
        try{
            $estado_fin = _ERROR;
            $fecha = date('Y-m-d h:i:s');
            $ip = $this->getRealIP();
            $estado = _INICIADO;
            $estado_orden = _ENPROCESO;
            
            $query = "update ordenes set estado_orden=:estado_orden where id_ordenes=:id_ordenes";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_ordenes', $pedido[0]['id_ordenes']);
            $conn_prepare->bindParam(':estado_orden', $estado_orden);
            $conn_prepare->execute();
            
            $query = 'update ordenes_plataforma_pago set estado = :estado_fin, fin_proceso = :fin_proceso Where id_ordenes= :id_ordenes and estado= :estado';
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':estado', $estado);
            $conn_prepare->bindParam(':estado_fin', $estado_fin);
            $conn_prepare->bindParam(':fin_proceso', $fecha);
            $conn_prepare->bindParam(':id_ordenes', $pedido[0]['id_ordenes']);
            $conn_prepare->execute();
            
            $query = "insert into ordenes_plataforma_pago (id_ordenes, id_plataforma_pago, ip, estado) values(:id_ordenes, :id_plataforma_pago, :ip, :estado)";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_ordenes', $pedido[0]['id_ordenes']);
            $conn_prepare->bindParam(':id_plataforma_pago', $plataforma[0]['id_plataforma_pago']);
            $conn_prepare->bindParam(':ip', $ip);
            $conn_prepare->bindParam(':estado', $estado);
            
            $conn_prepare->execute();
            
            $id_ordenes_plataforma_pago = $this->conn->lastInsertId("id_ordenes_platarorma_pago");
            $this->conn->commit();
          
        } catch (PDOException $e){
            echo $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
        /***SELECCIONA PLATAFORMA DEPAGOS */
        switch($plataforma[0]['id_plataforma_pago']){
            case '1':{ /*PAGOSONLINE*/
                $this->cargarPlataformaPagosOnline($id_ordenes_plataforma_pago,$pedido,$plataforma,$parametros);
                break;
            }
        }
        return $this->data;
    }
    
    function cargarPlataformaPagosOnline($id_ordenes_plataforma_pago,$pedido,$plataforma,$parametros){
        $id_ordenes_plataforma_pago=$pedido[0]['id_ordenes']."-".$id_ordenes_plataforma_pago;
        foreach($parametros as $row){
            $parametros_procesados[$row['key_1']]=$row['value'];
        }
        $parametros_procesados['telefonoMovil']=$pedido[0]['telefono'];
        $parametros_procesados['documentoIdentificacion']=$pedido[0]['nit'];
        $parametros_procesados['nombreComprador']=$pedido[0]['nombre'];
        $parametros_procesados['emailComprador']=$pedido[0]['email'];
        $parametros_procesados['valor']=$pedido[0]['valor']+$pedido[0]['fletes'];
        $parametros_procesados['iva']=0;
        $parametros_procesados['baseDevolucionIva']=0;
        $parametros_procesados['firma']= md5(_KEYPOOL."~".$parametros_procesados['usuarioId']."~".$id_ordenes_plataforma_pago."~".$parametros_procesados['valor']."~".$pedido[0]['moneda']);
        $parametros_procesados['refVenta']=$id_ordenes_plataforma_pago;
        $parametros_procesados['descripcion']='Siglo del Hombre Editores [ Ref de pago: '.$id_ordenes_plataforma_pago." Cliente: ".$pedido[0]['nombre']." ] ";
       
        $url = $plataforma[0]['url'].'?';
        foreach($parametros_procesados as $key => $value){
            $url.=$key.'='.htmlentities($value).'&';
        }
        unset($this->data);
        $this->data =  rtrim($url,'&'); 
        return;
    }
    
    
    function getRealIP()
    {
        $client_ip ='unknown';
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'] )){
            if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ){
                $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR']: "unknown" );
                $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);
                reset($entries);
                while (list(, $entry) = each($entries)){
                    $entry = trim($entry);
                    if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) ){
                        $private_ip = array('/^0\./','/^127\.0\.0\.1/','/^192\.168\..*/','/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/','/^10\..*/');
                        $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
                        if ($client_ip != $found_ip){
                            $client_ip = $found_ip; 
                            break;
                        }
                    }
                }
            }else{
                $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ?$_SERVER['REMOTE_ADDR']:( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR']:"unknown" );
            }
        }
        return $client_ip;
    }
    
}

?>
