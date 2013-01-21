<?php

require_once("app/gatewaypagos/classgatewayPagos.php");

class classmodelPedidos {
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
    
    function getCarconPrecios($car){
        if(sizeof($car->productos->producto)>0){
            foreach($car->productos->producto as $producto){
                foreach($producto->detalles->item as $item){
                    if($item->cantidad>0){
                        $this->getPrecioItem($item,$producto->id_titulos);
                    }
                }
            }
        }else{
            return false;
        }
        return $car;
    }
    
    function getPrecioItem($item,$id_titulos){
        $query = "select tlp.precio, ta.valor as titulo from titulos_lista_precios as tlp 
            inner join titulos_atributos as ta on ta.id_titulos=tlp.id_titulos
            where 
            tlp.id_lista_precios=:id_lista_precios and 
            tlp.id_titulos=:id_titulos and 
            tlp.id_tipos_productos=:id_tipos_productos and 
            tlp.id_proveedores = :id_proveedores and 
            tlp.estado = 'activo' and 
            ta.llave='titulo' 
            limit 0,1";
        
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam(':id_lista_precios',$item->id_lista_precios);
        $conn_prepare->bindParam(':id_titulos',$id_titulos);
        $conn_prepare->bindParam(':id_tipos_productos',$item->id_tipo_formato);
        $conn_prepare->bindParam(':id_proveedores',$item->id_proveedor);
        
        $conn_prepare->execute();
        $temp = $conn_prepare->fetchAll();
        if(sizeof($temp>0)){
            if(isset($temp[0]['precio'])){
                $item->addChild('precio',$temp[0]['precio']);
                $item->addChild('nombre',$temp[0]['titulo']);
                
                return $item;
            }
            
        }else{
            
            return false;
        }
        
        return false;
    }
    
    
    function crearPedido($user,$car){
        
        if(sizeof($car->productos->producto)>0){
            
            $i=0;
           // $id_proveedores = 1;
            //$id_tipos_productos = 1;
            $array_query['query']="INSERT INTO ordenes_productos (id_proveedores, id_ordenes, id_tipos_productos, id_titulos, nombre_producto, cantidad, valor_unitario, porcentage_descuento )VALUES 
                (:id_proveedores, :id_ordenes, :id_tipos_productos, :id_titulos, :nombre_producto, :cantidad, :valor_unitario, :porcentage_descuento )";
            $total_pedido=0;
            $total_impuestos=0;
            $peso=0;
            foreach($car->productos->producto as $producto){
                foreach($producto->detalles->item as $item){
                    if($item->cantidad>0){
                        
                        $array_query['values'][$i]['id_proveedores'] = (int) $item->id_proveedor;
                        $array_query['values'][$i]['id_tipos_productos'] = (int) $item->id_tipo_formato;
                        $array_query['values'][$i]['id_titulos'] = (int)$producto->id_titulos;
                        $array_query['values'][$i]['nombre_producto'] = $item->nombre;
                        $array_query['values'][$i]['cantidad'] = (float)$item->cantidad;
                        $array_query['values'][$i]['valor_unitario'] = (float)$item->precio;
                        $array_query['values'][$i]['porcentage_descuento'] = 0;
                        $total_pedido= (float)$total_pedido + (((float)$item->cantidad)*((float)$item->precio));
                        $array_query['values'][$i]['peso']=$this->getPeso($array_query['values'][$i]['id_titulos']);
                        $peso= $peso+ ($array_query['values'][$i]['peso']*$array_query['values'][$i]['cantidad']);
                        $i++;
                    }
                }
                
            }
        }
        else{
            
            return false;
        }

        try{
                   $this->conn->beginTransaction();
                   $fecha = date('Y-m-d');
                    $query = "INSERT INTO ordenes (id_moneda, id_clientes, fecha_creacion,  estado_pago, estado_despacho, valor, impuestos, estado_orden) 
                                VALUES (:id_moneda, :id_clientes, :fecha_creacion,  :estado_pago, :estado_despacho, :valor, :impuestos, :estado_orden)";
                    
                    $moneda = $_SESSION['moneda'];
                    $estado_pago=_PENDIENTEPAGO;
                    $estado_despacho = _SINDATOS;
                    $estado_orden = _ACTIVA;
                  
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_moneda', $moneda,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_clientes', $user->cliente->idcliente,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':fecha_creacion', $fecha,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':estado_pago', $estado_pago,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':estado_despacho',$estado_despacho,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':valor', $total_pedido);
                    $conn_prepare->bindParam(':impuestos', $total_impuestos,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':estado_orden', $estado_orden,PDO::PARAM_STR);
                    
                    $this->status= $conn_prepare->execute();
                    
                    $id_pedido =  $this->conn->lastInsertId('id_titulos');
                    $numero_items=0;
                    foreach($array_query['values'] as $param){
                        $conn_prepare = $this->conn->prepare($array_query['query']);
                        $conn_prepare->bindParam(':id_proveedores',$param['id_proveedores'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_ordenes', $id_pedido,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_tipos_productos',$param['id_tipos_productos'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$param['id_titulos'],PDO::PARAM_STR);
                        $conn_prepare->bindParam(':nombre_producto',$param['nombre_producto'],PDO::PARAM_STR);
                        $conn_prepare->bindParam(':cantidad',$param['cantidad'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':valor_unitario',$param['valor_unitario'],PDO::PARAM_STR);
                        $conn_prepare->bindParam(':porcentage_descuento',$param['porcentage_descuento'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                        
                        $numero_items+=$param['cantidad'];
                        unset($conn_prepare);
                    }
                    
                    
                    
                    
                    
                    $query = "UPDATE ordenes set peso = :peso WHERE id_ordenes= :id_ordenes";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':peso', $peso);
                    $conn_prepare->bindParam(':id_ordenes',$id_pedido);
                    $conn_prepare->execute();
                    
                    $this->conn->commit();
                    
            }catch(PDOException $e){
                    $this->conn->rollBack();
                    $this->status=false;
                    echo $e->getMessage();
            }
            return $this->status;
    }
    
    function getPeso($id_titulos){
        $query = "select valor from titulos_atributos where llave='peso' and id_titulos='".$id_titulos."'";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        $temp = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        if(sizeof($temp)>0){
            return $temp[0]['valor'];
        }else{
            return 0;
        }
    }
    
    function listarPedidos($data){
       
        try{
                
                $estados='';
                foreach($data['estado'] as $est){
                    $estados.=",'".$est."'";
                }
                $estados = ltrim($estados,',');
                $query = "SELECT DISTINCT id_ordenes, moneda, fecha_creacion, valor, estado_orden  FROM view_ordenes_cliente_moneda WHERE id_clientes = :id_clientes and estado_orden in ($estados) order by id_ordenes DESC";
                
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_clientes',$data['id_cliente'] ,PDO::PARAM_INT);
                $conn_prepare->execute( ) ;
                $this->data=$conn_prepare->fetchAll();


        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
        } 
    }
    
    function isOwner($orden,$cliente){
        try{
                $query = "SELECT id_ordenes  FROM ordenes WHERE id_clientes = :id_clientes and id_ordenes= :id_ordenes";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_clientes',$cliente ,PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_ordenes',$orden ,PDO::PARAM_INT);
                $conn_prepare->execute( ) ;
                $temp =$conn_prepare->fetchAll();
                if(isset($temp[0])){
                    return (sizeof($temp[0])>0)?true:false;
                }
                return false;
                


        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
        } 
        return false;
        
    }
    
    function getdatosPedidoCliente($data){
        unset($this->data);
        if(!$this->isOwner($data['id_ordenes'], $data['id_clientes']))return false;
        try{
                $query = "SELECT DISTINCT id_ordenes, moneda, peso, valor, fletes, fecha_creacion,fecha_pedido , fecha_despacho, fecha_entrega,estado_pago, estado_despacho, estado_orden  FROM 
                    view_ordenes_cliente_moneda WHERE id_clientes = :id_clientes and id_ordenes= :id_ordenes";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_clientes',$data['id_clientes'] ,PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'] ,PDO::PARAM_INT);
                $conn_prepare->execute( ) ;
                $this->data['brief']=$conn_prepare->fetchAll();
                
                $query = "select op.id_ordenes_productos, op.id_ordenes, op.id_tipos_productos,tp.nombre as tipo_producto, op.id_titulos, op.nombre_producto, ta.valor as titulo , op.cantidad, op.valor_unitario 
                    from ordenes_productos as op 
                    inner join tipos_productos as tp on tp.id_tipos_productos = op.id_tipos_productos 
                    inner join titulos_atributos as ta on ta.id_titulos = op.id_titulos and ta.llave='titulo'   
                    where op.id_ordenes = :id_ordenes";
                
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'] ,PDO::PARAM_INT);
                
                $conn_prepare->execute( ) ;
                $this->data['details']=$conn_prepare->fetchAll();
                
                for($i=0;$i<sizeof($this->data['details']);$i++){
                    $query="select ta.valor from titulos_atributos as ta where ta.id_titulos='".$this->data['details'][$i]['id_titulos']."' and ta.llave='peso'";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->execute();
                    $temp = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    if(sizeof($temp)>0){
                       $this->data['details'][$i]['peso']=$temp[0]['valor'];
                    }else{
                       $this->data['details'][$i]['peso']=0; 
                    }
                }
                
                $query = "select ot.id_ordenes_transportadoras, 
                            ot.id_transportadoras,
                            t.nombre as nombre_transportadora,
                            p.id_paises,
                            p.nombre as nombre_pais,
                            ot.id_ciudades,
                            c.nombre as nombre_ciudad,
                            ot.direccion_entrega,
                            ot.nombre_destinatario,
                            ot.telefono_destinatario,
                            ot.email_destinatario,
                            ot.observaciones,
                            ot.estado
                        from ordenes_transportadoras as ot 
                        inner join transportadoras as t on t.id_transportadoras=ot.id_transportadoras 
                        inner join ciudades as c on c.id_ciudades = ot.id_ciudades
                        inner join paises as p on p.id_paises = c.id_paises
                        where ot.id_ordenes=:id_ordenes";
                
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'] ,PDO::PARAM_INT);
                
                $conn_prepare->execute( ) ;
                $this->data['detalles_transportadoras']=$conn_prepare->fetchAll(PDO::FETCH_NAMED);

        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
        } 
    }
    
    function getdatosCabeceraPedidoCliente($data){
        unset($this->data);
        if(!$this->isOwner($data['id_ordenes'], $data['id_clientes']))return false;
        try{
                $query = "SELECT DISTINCT *  FROM view_ordenes_cliente_moneda WHERE id_clientes = :id_clientes and id_ordenes= :id_ordenes";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_clientes',$data['id_clientes'] ,PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'] ,PDO::PARAM_INT);
                $conn_prepare->execute( ) ;
                $this->data=$conn_prepare->fetchAll();

        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
        } 
    }
    
    function borrarPedido($data){
        if(!$this->isOwner($data['id_ordenes'], $data['id_clientes']))return false;
        $this->conn->beginTransaction();
        try{
                
                $query = "DELETE FROM ordenes_productos WHERE id_ordenes = :id_ordenes";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'] ,PDO::PARAM_INT);
                $conn_prepare->execute( ) ;
                
                $query = "DELETE FROM ordenes WHERE id_ordenes = :id_ordenes";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'] ,PDO::PARAM_INT);
                $conn_prepare->execute( ) ;
                
                $this->conn->commit();

        }catch(PDOException $e){
                $this->conn->rollBack();
                $this->data=false;
                echo $e->getMessage();
        } 
    }
    
    function listarTransportadoras($estado = 'activo'){
        unset($this->data);
        try{
                $query = "SELECT * FROM transportadoras where estado = :estado";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':estado',$estado ,PDO::PARAM_STR);
                $conn_prepare->execute( ) ;
                $this->data=$conn_prepare->fetchAll();


        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
        }
        return $this->data;
    }
    
    function listarCiudades($subquery=''){
        unset($this->data);
        try{
                $query = "SELECT * FROM ciudades ".$subquery;
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->execute( ) ;
                $this->data=$conn_prepare->fetchAll();


        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
        }
        return $this->data;
    }
    
    function listarPaises(){
        unset($this->data);
        try{
                $query = "SELECT * FROM paises";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->execute( ) ;
                $this->data=$conn_prepare->fetchAll();


        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
        }
        return $this->data;
    }
    
    function saveFletes($data){
         
        if(!$this->isOwner($data['id_ordenes'], $data['id_clientes']))return false;
        $this->conn->beginTransaction();
        
        try{
                $query = 'select estado_orden, estado_pago,estado_despacho from ordenes where id_ordenes=:id_ordenes';
                $conn_prepare =$this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes', $data['id_ordenes'], PDO::PARAM_INT);
                $conn_prepare->execute();
                $temp = $conn_prepare->fetchAll();
                
                if($temp[0]['estado_orden']!=_ACTIVA){
                    return false;
                }
                              
                $fecha = date('Y-m-d');
                $query = "select id_ordenes_transportadoras from ordenes_transportadoras where id_ordenes=:id_ordenes";
                $conn_prepare =$this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'], PDO::PARAM_INT);
                $conn_prepare->execute();
                $temp2= $conn_prepare->fetchAll();
                if(sizeof($temp2)>0){
                    foreach($temp2 as $row){
                        $query = "delete from detalles_ordenes_transportadoras where id_ordenes_transportadoras=:id_ordenes_transportadoras";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_ordenes_transportadoras', $row['id_ordenes_transportadoras']);
                        $conn_prepare->execute();

                        $query = "delete from ordenes_transportadoras where id_ordenes_transportadoras=:id_ordenes_transportadoras";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_ordenes_transportadoras', $row['id_ordenes_transportadoras']);
                        $conn_prepare->execute();
                    }
                    
                    
                }
                
                $estado_ordenes_transportadoras = _ACTIVA;
                $query = "INSERT INTO ordenes_transportadoras (
                        id_transportadoras,id_ordenes,fecha_creacion,id_ciudades,direccion_entrega,nombre_destinatario,telefono_destinatario,email_destinatario,observaciones,estado) 
                        VALUES (:id_transportadoras,:id_ordenes,:fecha_creacion,:id_ciudades,:direccion_entrega,:nombre_destinatario,:telefono_destinatario,:email_destinatario,:observaciones,:estado)";
                $conn_prepare = $this->conn->prepare($query);
                
                $conn_prepare->bindParam(':id_transportadoras', $data['data']['transportadoras'], PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_ordenes', $data['id_ordenes'], PDO::PARAM_INT);
                $conn_prepare->bindParam(':fecha_creacion', $fecha, PDO::PARAM_STR);
                $conn_prepare->bindParam(':id_ciudades', $data['data']['ciudades'], PDO::PARAM_STR);
                $conn_prepare->bindParam(':direccion_entrega', $data['data']['direccion'], PDO::PARAM_STR);
                $conn_prepare->bindParam(':nombre_destinatario', $data['data']['contacto'], PDO::PARAM_STR);
                $conn_prepare->bindParam(':telefono_destinatario', $data['data']['telefono'], PDO::PARAM_STR);
                $conn_prepare->bindParam(':email_destinatario', $data['data']['email'], PDO::PARAM_STR);
                $conn_prepare->bindParam(':observaciones', $data['data']['observaciones'], PDO::PARAM_STR);
                $conn_prepare->bindParam(':estado', $estado_ordenes_transportadoras, PDO::PARAM_STR);
                
                
                $this->data=$conn_prepare->execute( ) ;
                
                $id_ordenes_transportadoras =  $this->conn->lastInsertId('id_ordenes_transportadoras');
                
                /****************************/
                $query = "insert into detalles_ordenes_transportadoras (id_ordenes_transportadoras,id_titulos,id_tipos_productos,id_proveedores, codigo_producto,nombre_producto,cantidad, estado) 
                    select $id_ordenes_transportadoras, vopp.id_titulos, vopp.id_tipos_productos, vopp.id_proveedores, vopp.codigo_producto, vopp.nombre_producto, vopp.cantidad, 'actvo' from view_ordenes_productos_proveedores as vopp
                    where vopp.id_ordenes=:id_ordenes";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes', $data['id_ordenes'], PDO::PARAM_INT);
                $conn_prepare->execute();
                
                /*****************************/
                
                $estado_pago= _PENDIENTEPAGO;
                $estado_despacho = _SINDESPACHO;
                $estado_orden = _ACTIVA;
                
                $query = "UPDATE ordenes set fletes = :fletes, estado_orden = :estado_orden , estado_despacho= :estado_despacho, estado_pago = :estado_pago  where id_ordenes = :id_ordenes";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_ordenes',$data['id_ordenes'], PDO::PARAM_INT);
                $conn_prepare->bindParam(':fletes', $data['data']['fletes'], PDO::PARAM_STR);
                $conn_prepare->bindParam(':estado_orden', $estado_orden, PDO::PARAM_STR);
                $conn_prepare->bindParam(':estado_despacho', $estado_despacho, PDO::PARAM_STR);
                $conn_prepare->bindParam(':estado_pago', $estado_pago, PDO::PARAM_STR);
                $this->data=$conn_prepare->execute( ) ;
                $this->conn->commit();
                $this->data='';
                return true;

        }catch(PDOException $e){
                $this->data=false;
                echo $e->getMessage();
                $this->conn->rollBack();
                return false;
        }
        return;
        
    }
    
    function getMediosPago($orden,$cliente){
        
        $medios_pago = new classgatewayPagos();
        $medios_pago->listarPlataformas();
        
        /*
        $this->getdatosPedidoCliente(array('id_clientes'=>$cliente->idcliente,'id_ordenes'=>$orden));
        $datos_orden = $this->data;
         * 
         */
        /*pagos online*/
        /*
        $referencia = rand(0,9999);
        $valor = $datos_orden['brief'][0]['valor'] + $datos_orden['brief'][0]['fletes']+$datos_orden['brief'][0]['iva'];
        $firma = md5(_KEYPOOL."~"._USERPOOL."~".$datos_orden['brief'][0]['id_ordenes'].$referencia."~".$valor."~COP");
        
        $url_pagosonline = htmlentities(_GATEWAYPAGOSONLINE."?usuarioId="._USERPOOL."&refVenta=".$datos_orden['brief'][0]['id_ordenes'].$referencia."&url_confirmacion="._URLCONFIRMACIONPAGOSONLINE."&url_respuesta="._URLRESPUESTAPAGOSONLINE."&descripcion=Venta%20de%20prueba&telefonoMovil=".$cliente->telefono."&documentoIdentificacion=".$cliente->nit."&tipoDocumentoIdentificacion=1&nombreComprador=".$cliente->nombre."&emailComprador=".$cliente->email."&valor=".$valor."&iva=".$datos_orden['brief'][0]['iva']."&baseDevolucionIva=".$datos_orden['brief'][0]['iva']."&prueba=1&firma=").$firma;
        
        $pagos=array(
                    array('nombre'=>"PagosOnline",'imagen'=>"images/PagosOnline.jpg",'url'=>$url_pagosonline),
                    array('nombre'=>"Consignacion Bancaria",'imagen'=>"images/logo_bancolombia.jpg",'url'=>"Mi pagina"),
                    array('nombre'=>"Transferencia Electronica",'imagen'=>"images/logo_bancolombia.jpg",'url'=>"Mi pagina"),
                    array('nombre'=>"Pago en punto Baloto o Efecty",'imagen'=>"images/logo_bancolombia.jpg",'url'=>"Mi pagina")
            );
        */
        
        return $medios_pago->data;
    }
}

?>
