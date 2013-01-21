<?php
require_once ("app/common/classSHBaseSystem.php");
require_once("cabecera.php");
class classIndex1 extends classSHBaseSystem {
    public $pagina;
    function __construct() {
        $pagina = new classCabecera();
        $pagina->script='';
        $this->getRequest();
        
        
        
        if(isset($this->request['action'])){
            
            switch($this->request['action']){
                case 'doLogin':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body = $usuario->print;
                    break;
                }
                case 'doLogout':{
                    require_once("app/users/classUsers.php");
                    require_once('app/tirant/classSHTirant.php');
                    $usuario = new classUsers();
                    $tirant = new classSHTiran();
                    $pagina->body=$tirant->renderPage();
                    break;
                }
                case 'formLogin':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body= $usuario->print;
                    break;
                }
                case 'registrarseForm':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body= $usuario->print;
                    break;
                }
                case 'crearUsuario':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body= $usuario->print;
                    break;
                }
                case 'getFormKeyRecovery':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body= $usuario->print;
                    break;
                }
                
                case 'myAccount':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body= $usuario->print;
                    break;
                }
                case 'editUser':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body= $usuario->print;
                    break;
                }
                case 'saveDataUser':{
                    require_once("app/users/classUsers.php");
                    $usuario = new classUsers();
                    $pagina->body= $usuario->print;
                    break;
                }
                case 'listCar':{
                    require_once("app/shoppingcar/classShoppingCar.php");
                    $carrito = new classShoppingCar();
                    $pagina->body= $carrito->print;
                    break;
                }
                case 'editItemCar':{
                    require_once("app/shoppingcar/classShoppingCar.php");
                    $carrito = new classShoppingCar();
                    $pagina->body= $carrito->print;
                    break;
                }
                case 'saveeditItemCar':{
                    require_once("app/shoppingcar/classShoppingCar.php");
                    $carrito = new classShoppingCar();
                    $pagina->body= $carrito->print;
                    break;
                }
                case 'delfromCar':{
                    require_once("app/shoppingcar/classShoppingCar.php");
                    $carrito = new classShoppingCar();
                    $pagina->body= $carrito->print;
                    break;
                }
                case 'crearPedido':{
                    require_once("app/pedidos/classPedidos.php");
                    $pedido = new classPedidos();
                    $pagina->body= $pedido->print;
                    break;
                }
                case 'listarPedidos':{
                    require_once("app/pedidos/classPedidos.php");
                    $pedido = new classPedidos();
                    $pagina->body= $pedido->print;
                    break;   
                }
                case 'procesarPedido':{
                    require_once("app/pedidos/classPedidos.php");
                    $pedido = new classPedidos();
                    $pagina->body= $pedido->print;
                    break;
                }
                case 'verDetalles':{
                    require_once("app/pedidos/classPedidos.php");
                    $pedido = new classPedidos();
                    $pagina->body= $pedido->print;
                    break;
                }
                case 'borrarPedido':{
                    require_once("app/pedidos/classPedidos.php");
                    $pedido = new classPedidos();
                    $pagina->body= $pedido->print;
                    
                    break;
                }
                case 'listCatalogo':{ //LISTAR CATAOGO
                    require_once('app/tirant/classSHTirant.php');
                    $tirant = new classSHTiran();
                    $pagina->body=$tirant->renderPage();
                    $pagina->script='<script src="lib/jquery.endless-scroll.js" type="text/javascript" charset="utf-8"></script>
                        <script src="lib/scroll.js" type="text/javascript" charset="utf-8"></script>';
                    break;
                }
                case 'list':{
                    require_once('app/tirant/classSHTirant.php');
                    $tirant = new classSHTiran();
                    return;
                    break;   
                }
                
                case 'searchList':{
                    require_once('app/searchlist/classSearchList.php');
                    $list = new classSearchList();
                    
                    $pagina->body=$list->print;
                    $pagina->script='<script src="lib/jquery.endless-scroll.js" type="text/javascript" charset="utf-8"></script>
                     <script src="lib/scroll.js" type="text/javascript" charset="utf-8"></script>';
                    
                    break;
                }
            
            }
            
        }else{
            /*if(sizeof($this->request)>0){
                require_once('app/tirant/classSHTirant.php');
                $tirant = new classSHTiran();
                $pagina->body=$tirant->renderPage();
               $pagina->script='<script src="lib/jquery.endless-scroll.js" type="text/javascript" charset="utf-8"></script>
            <script src="lib/scroll.js" type="text/javascript" charset="utf-8"></script>';

            }else{*/
                $pagina->body=$this->homePage();
                $pagina->script="<script type=\"text/javascript\" src=\"lib/jquery/stepcarousel.js\" ></script>
            <script type=\"text/javascript\" src=\"lib/destacadosCarrusel.js\" ></script>";
                
            /*}*/
            
        }
        
        $pagina->search_bar = $this->searchBar();
        $pagina->shoppingcar = $this->shoppingcar();
        $pagina->left_menu = $this->leftMenu();
        $pagina->mainmenu = $this->mainMenu();
        
        
        echo $pagina->render();
        return;
        
    }
    
    function homePage(){
        require_once('app/homepage/classHomePage.php');
        $home = new classHomePage();
        $home->getdestacadosHomePage();
        $home->getRecomendados();
        $home->getNovedades();
        $home->getUniversidades();
        $home->getRevistas();
        return $home->destacadosHomePage.$home->novedades.$home->recomendados.$home->universidades.$home->revistas;
            
    }

    
    function leftMenu(){
        require_once('app/leftmenu/classLeftMenu.php');
        $menu = new classLeftMenu();
        return $menu->getMenu('0');
    }
    
    function searchBar(){
        require_once('app/tirant/classSearch.php');
        $searchBar = new classSearch();
        return $searchBar->print;
    }
    
    function shoppingcar(){
        require_once('app/shoppingcar/classShoppingCar.php');
        $_REQUEST['headerBar']=true;
        $car = new classShoppingCar();
        unset($_REQUEST['headerBar']);
        return $car->print;
    }
    
    function mainMenu(){
        require_once('app/common/view/classMainMenu.php');
        
        $menu = new classMainMenu();
        
        return $menu->getMainMenu();
    }
}

?>
