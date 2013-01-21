<?php
require_once ("model/classmodelUsers.php");
require_once ("view/classviewUsers.php");


class classUsers {
    public $data;
    public $status;
    public $print;
    public $model;
    public $view;
    public $request;
    public $url;
    public $sh_params;
    
    function __construct($url=false,$sh_params=false) {
        $this->url = $url;
        $this->print='';
        $this->sh_params = $sh_params;
        $this->model = new classmodelUsers();
        $this->view = new classviewUsers();
        
        $this->getRequest(); //PROCESAR VARIABES DE SESSION Y REQUEST
        
        if(isset($this->request['action'])){
            switch($this->request['action']){
                case 'doLogin':{
                    $this->doLogin();
                  //  $this->getHomeSmall();
                    return;
                    break;
                }
                case 'doLogout':{
                    $this->doLogout();
                   // $this->getHomeSmall();
                    break;
                }
                case 'formLogin':{
                    $this->formLogin();
                    return;
                    break;
                }
                case 'registrarseForm':{
                    $this->registrarseForm();
                    return;
                    break;
                }
                
                case 'crearUsuario':{
                    $this->crearUsuario();
                    return;
                    break;
                }
                
                case 'getFormKeyRecovery':{
                    $this->getFormKeyRecovery();
                    return;
                    break;
                }
                
                case 'editUser':{
                    $this->isLogin();
                    $this->userData();
                    return;
                    break;
                }
                case 'saveDataUser':{
                    $this->isLogin();
                    $this->userData();
                    return;
                    break;
                }
                case 'showCatalogos':{
                    $this->isLogin();
                    $this->showCatalogos();
                    break;
                }
                case 'myAccount':{
                    $this->isLogin();
                    $this->myAccount();
                    return;
                    break;
                }
                
                case 'procesarPedido':{
                    $this->isLogin();
                    $this->procesarPedido();
                    break;
                }
                case 'revisarPedidos':{
                    $this->isLogin();
                    $this->revisarPedidos();
                    break;
                }
                default:{
                  $this->isLogin();
                  $this->getHomeSmall();
                }
            }
        }else{
            $this->getHomeSmall();
        }
        echo $this->print;
    }
    
    function doLogin(){
        if(!$this->status){
            if ($this->model->doLogin($this->request)){
                $this->cargarDatosUsuario($this->model->data[0]);
                $_SESSION['shuser']= $this->data->asXML();
                $this->myAccount();
                $this->status=true;
            }else{
                $this->status=false;
                $this->isLogin();
            }
        }
       // $this->print.=($this->status)?'':$this->view->getError(_ERRORLOGIN);
        
    }
    
    function doLogout(){
        $this->status = false;
        $this->data=false;
        unset($_SESSION['shuser']);
        //$this->print.=$this->view->getError(_LOGOUT);
        //header("Location: index.php");
    }
    
    function formLogin(){
        $this->print = $this->view->formLogin();
    }
    
    function isLogin(){
       (!isset($_SESSION['shuser']))?header("Location: index.php?action=formLogin"):true;
    }
    
    function registrarseForm(){
        require_once("app/common/model/classmodelconsultasGenericas.php");
        require_once("app/users/model/classmodelUsers.php");
        $paises = new classmodelconsultasGenericas();
        $paises->listarPaises();
        $usuarios = new classmodelUsers();
        $usuarios->gettipoDocumento();
        $this->print = $this->view->registrarseForm(array('paises'=>$paises->data,'documentos'=>$usuarios->data,'request'=>$this->request));
    }
    
    function crearUsuario(){
        require_once('lib/recaptchalib.php');
        $resp = recaptcha_check_answer (_RECAPTCHAPRIVATEKEY,
                                $_SERVER["REMOTE_ADDR"],
                                $this->request["recaptcha_challenge_field"],
                                $this->request["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            $this->registrarseForm();
            $this->print = "Error en el proceso de verificacion del campo reCAPTCHA : " . $resp->error . $this->print;
        } else {
            $this->print = $this->view->mensageCreacionUsuario($this->model->crearUsuario($this->request));
        }

        
        
    }

    function getFormKeyRecovery(){
        $this->print = $this->view->getFormKeyRecovery();
    }
    
    function userData(){
        
        if(isset($this->request['opt'])){
            if($this->model->saveData(array('cliente'=>$this->data->cliente,'request'=>$this->request))){
                $this->print.="Usuario modificado con exito";
                $this->model->reloadData($this->data->cliente->idcliente);
                $this->cargarDatosUsuario($this->model->data[0]);
                $this->status=true;
                $_SESSION['shuser']= $this->data->asXML();
            }else{
                $this->print.="Error al guardar";
            }
        }else{
            $this->model->getCities();
            $this->print.=$this->view->getFormData(array("cliente"=>$this->data->cliente,"url"=>$this->url,'cities'=>$this->model->data));
        }
    }
    
    function getHomeSmall(){
        
        if($this->status!=false){
            //$this->model->reloadData($this->data->cliente);
            $this->print.=$this->view->getHomeSmall(array('cliente'=>$this->data->cliente,'url'=>$this->url));
        }else{
            $this->print.=$this->view->getLoginFormSmall($this->url);//SI EL USUARIO NO ESTA LOGEADO
        }
    }
    
    function getRequest(){
        if(isset($_SESSION['shuser'])){
            $this->data = new SimpleXMLElement($_SESSION['shuser']);
            $this->status=true;
        }else{
            $this->data = new SimpleXMLElement(_userXML);
            $this->status = false;
        }
        foreach($_REQUEST as $key => $value){
            $this->request[$key]= utf8_encode(trim($value));
        }
    }
    
    function cargarDatosUsuario($datos){
        $this->data = new SimpleXMLElement(_userXML);
        $cliente = $this->data->addChild("cliente");
        foreach($datos as $key => $value){
            if(!is_int($key)){
                $cliente->addChild($key, $value);
            }
        }
        return ;
    }
    
        
    function showCatalogos(){
         $tirant = new classSHTiran($this->sh_params);
	 $this->print = $tirant->renderPage();
    }
    
    function myAccount(){
         require_once("app/shoppingcar/classShoppingCar.php");
         $_REQUEST['action']='listCar';
         $carrito = new classShoppingCar();
         $_REQUEST['action']='listarPedidos';
         require_once("app/pedidos/classPedidos.php");
         $pedido = new classPedidos();
	 $this->print = $this->view->getHome(array('data'=>array($carrito->print,$pedido->print)));
    }

    function procesarPedido(){
         $this->print = $this->view->getHome(array('titulo'=>"procesarPedido",'data'=>"detalle de la seccion"));
    }
    function revisarPedidos(){
         $this->print = $this->view->getHome(array('titulo'=>"revisarPedidos",'data'=>"detalle de la seccion"));
    }
}

?>