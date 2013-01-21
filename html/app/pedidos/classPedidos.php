<?php
        require_once("app/common/classSHBaseSystem.php");
        require_once ("model/classmodelPedidos.php");
        require_once ("view/classviewPedidos.php");
        require_once("lib/classstructHTML.php");

        
        
	class classPedidos extends classSHBaseSystem {
            
            function __construct($habilitar = false){
                $this->print='';
                $this->model = new classmodelPedidos();
                $this->view = new classviewPedidos();
                if($habilitar!=false) return;
                
                $this->getRequest(); //PROCESAR VARIABES DE SESSION Y REQUEST
                /*if($this->status==false){
                    echo "no login";
                }*/
                if(isset($this->request['action'])){
                    switch($this->request['action']){
                        case 'crearPedido':{
                            $this->crearPedido();
                            return;
                            break;
                        }
                        case 'listarPedidos':{
                            $this->listarPedidos();
                            return;
                            break;
                        }
                        case 'procesarPedido':{
                            $this->procesarPedido();
                            return;
                            break;
                        }
                        case 'borrarPedido':{
                            $this->borrarPedido();
                            return;
                            break;
                        }
                        case 'MultiDireccion':{
                            $this->MultiDireccion();
                            break;
                        }
                        case 'guardarDireccionDespacho':{
                            $this->guardarDireccionDespacho();
                            echo $this->print;
                            return;
                            break;
                        }
                        case 'Step0':{
                            $this->Step0();
                            break;
                        }
                        case 'Step1':{
                            $this->Step1();
                            return 0;
                            break;
                        }
                        case 'Step2':{
                            $this->Step2();
                            echo $this->print;
                            return;
                            break;
                        }
                        case 'Step3':{
                            $this->Step3();
                            break;
                        }
                        
                        case 'verDetalles':{
                            $this->verDetalles();
                            return;
                            break;
                        }
                    }
                }else{
                   
                }
                $pagina = new structHTML(array('body'=> $this->print));
        
                echo $pagina->renderHTML();

                
            }
            
            function crearPedido(){
                
                $this->model->crearPedido($this->data,$this->model->getCarconPrecios($this->car));
                $this->listarPedidos();
                unset($this->car);
                $this->car = new SimpleXMLElement(_carXML);
                $_SESSION['shcar']=$this->car->asXML();
            }
            
            function listarPedidos(){
                if(isset($this->request['opt'])){
                    switch($this->request['opt']){
                        case 'todos':{
                             $this->model->listarPedidos(array('id_cliente'=>$this->data->cliente->idcliente,'estado'=>array(_ACTIVA,_ENPROCESO,_PROCESADA,_ANULADA)));
                            break;   
                        }
                        case 'activos':{
                             $this->model->listarPedidos(array('id_cliente'=>$this->data->cliente->idcliente,'estado'=>array(_ACTIVA)));
                            break;   
                        }
                        case 'enproceso':{
                             $this->model->listarPedidos(array('id_cliente'=>$this->data->cliente->idcliente,'estado'=>array(_ENPROCESO)));
                            break;   
                        }
                        case 'cerrados':{
                             $this->model->listarPedidos(array('id_cliente'=>$this->data->cliente->idcliente,'estado'=>array(_PROCESADA,_ANULADA)));
                            break;   
                        }
                    }
                    
                }else{
                     $this->model->listarPedidos(array('id_cliente'=>$this->data->cliente->idcliente,'estado'=>array(_ACTIVA)));
                }
               
                $this->print=$this->view->listarPedidos($this->model->data);
            }
            
            function procesarPedido(){
                if($this->model->isOwner($this->request['id_pedido'], $this->data->cliente->idcliente)){
                    $this->model->getdatosPedidoCliente(array('id_clientes'=>$this->data->cliente->idcliente,'id_ordenes'=>$this->request['id_pedido']));
                    $this->print = $this->view->formdatosPedidoCliente($this->model->data);
                }else{
                    $this->listarPedidos();
                }
                
            }
            
            function verDetalles(){
                if($this->model->isOwner($this->request['id_pedido'], $this->data->cliente->idcliente)){
                    $this->model->getdatosPedidoCliente(array('id_clientes'=>$this->data->cliente->idcliente,'id_ordenes'=>$this->request['id_pedido']));
                    $this->print = $this->view->detallesPedidoCliente($this->model->data);
                }else{
                    $this->listarPedidos();
                }
                
            }
            
            function borrarPedido(){
                $this->model->borrarPedido(array('id_clientes'=>$this->data->cliente->idcliente,'id_ordenes'=>$this->request['id_pedido']));
                $this->model->listarPedidos(array('id_cliente'=>$this->data->cliente->idcliente,'estado'=>'activo'));
                $this->print = $this->view->listarPedidos($this->model->data);
            }
            
            
            function MultiDireccion(){
                if($this->model->isOwner($this->request['id_orden'], $this->data->cliente->idcliente)){
                    $paises = $this->model->listarPaises();
                    $ciudades = $this->model->listarCiudades();
                    $transportadoras = $this->model->listarTransportadoras();
                    $this->model->getdatosPedidoCliente(array('id_clientes'=>$this->data->cliente->idcliente,'id_ordenes'=>$this->request['id_orden']));
                    $peso = $this->model->data['brief'][0]['peso'];
                    $this->print = $this->view->formularioFletes(array('id_orden'=>$this->request['id_orden'],'peso'=>$peso,'paises'=>$paises,'ciudades'=>$ciudades, 'transportadoras'=>$transportadoras));
                }else{
                    return false;
                }
            }
            
            function guardarDireccionDespacho(){
                require_once("app/common/view/classviewXML.php");
                $estado='false';
                if($this->model->isOwner($this->request['id_orden'], $this->data->cliente->idcliente)){
                    switch($this->request['tipo_envio']){
                        case 'unico_virtual':{
                            $data = array('id_ordenes'=>$this->request['id_orden'],'id_clientes'=>$this->data->cliente->idcliente,
                                            'data'=>array(
                                                    'transportadoras'=>1,
                                                    'direccion'=>$this->request['email'],
                                                    'contacto'=>$this->request['contacto'],
                                                    'email'=>$this->request['email'],
                                                    'telefono'=>$this->request['telefono'],
                                                    'observaciones'=>'',
                                                    'pais'=>'',
                                                    'ciudad'=>'',
                                                    'fletes'=>0
                                                ));
                            if($this->model->saveFletes($data)){
                                $estado='true';
                            }
                            
                            break;   
                        }
                        case 'unico_fisico':{
                          $data = array('id_ordenes'=>$this->request['id_orden'],'id_clientes'=>$this->data->cliente->idcliente,
                                            'data'=>array(
                                                    'transportadoras'=>$this->request['transportadora'],
                                                    'direccion'=>$this->request['direccion'],
                                                    'contacto'=>$this->request['contacto'],
                                                    'email'=>$this->request['email'],
                                                    'telefono'=>$this->request['telefono'],
                                                    'observaciones'=>$this->request['observaciones'],
                                                    'pais'=>$this->request['pais'],
                                                    'ciudad'=>$this->request['ciudad'],
                                                    'fletes'=>$this->request['fletes']
                                                ));
                     
                               
                            if($this->model->saveFletes($data)){
                                $estado='true';
                            }
                            
                            break;   
                            
                         break;   
                        }
                        case 'multi_virtual':{
                         break;   
                        }
                        case 'multi_fisico':{
                         break;   
                        }
                    }
                    
                    
                }                
                $xml = new classviewXML();
                $xml->generarListado(array(array('estado'=>$estado)));
                $this->print = $xml->string;
            }
            /*Calculo de fletes*/
            function Step0(){
                if($this->model->isOwner($this->request['id_orden'], $this->data->cliente->idcliente)){
                    $paises = $this->model->listarPaises();
                    $ciudades = $this->model->listarCiudades();
                    $transportadoras = $this->model->listarTransportadoras();
                    $this->model->getdatosPedidoCliente(array('id_clientes'=>$this->data->cliente->idcliente,'id_ordenes'=>$this->request['id_orden']));
                    $peso = $this->model->data['brief'][0]['peso'];
                    if(isset($this->request['multi'])){
                        $this->print = $this->view->formularioFletesMulti(array('id_orden'=>$this->request['id_orden'],'peso'=>$peso,'paises'=>$paises,'ciudades'=>$ciudades, 'transportadoras'=>$transportadoras,'fisicos'=>$this->request['fisicos']),  $this->model->data);
                    }else{
                        $this->print = $this->view->formularioFletes(array('id_orden'=>$this->request['id_orden'],'peso'=>$peso,'paises'=>$paises,'ciudades'=>$ciudades, 'transportadoras'=>$transportadoras,'fisicos'=>$this->request['fisicos']),  $this->model->data);
                    }
                    
                }else{
                    $this->listarPedidos();
                }
                
            }
            
            /*PROCESAMEINTO DE ORDENES DE COMPRA*/
            /*Obtener datos de cliente*/
            /*Obtener metodo de pago*/
            function Step1(){
                if($this->model->isOwner($this->request['id_orden'], $this->data->cliente->idcliente)){
                    $orden =$this->request['id_orden'];
                   $this->model->saveFletes(array('id_ordenes'=>$this->request['id_orden'],'id_clientes'=>$this->data->cliente->idcliente,'data'=>$this->request));
                   $this->model->getdatosPedidoCliente(array('id_ordenes'=>$orden,'id_clientes'=>$this->data->cliente->idcliente));
                   $this->print = $this->view->formdatosPedidoCliente($this->model->data);
                   
                }else{
                    $this->listarPedidos();
                }
            }
            
            /*Generar pago*/
            function Step2(){
                
                if($this->model->isOwner($this->request['id_orden'], $this->data->cliente->idcliente)){
                    $this->print = $this->view->seleccionarMetodoPago($this->model->getMediosPago($this->request['id_orden'], $this->data->cliente),$this->request['id_orden']);
                }else{
                    $this->listarPedidos();
                }
            }
            
            /*Envio de productos dependiendo del tipo de producto*/
            function Step3(){
                if($this->model->isOwner($this->request['id_orden'], $this->data->cliente->idcliente)){
                   
                }else{
                    $this->listarPedidos();
                }
            }
            
        }
?>