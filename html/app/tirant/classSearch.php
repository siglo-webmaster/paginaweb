<?php
require_once ("model/modelSHTirant.php");
require_once ("view/classviewSearch.php");
 require_once("app/common/classSHBaseSystem.php");
class classSearch extends classSHBaseSystem{
    
    
    function __construct(){
        $this->model = new modelSHTirant();
        $this->view = new classviewSearch();
        $this->getRequest();
        $this->print='';
        
        if(!isset($this->request['action'])){
            $this->view->getFormStandar();
            $this->print = $this->view->print;
            return;
        }
        
        switch($this->request['action']){
           case 'searchList':{
               $this->view->getFormStandar();
                $this->print = $this->view->print;
                
               break;
           }
            case 'preview':{
               $this->preview();
               echo $this->print;
               return;
               break;
           }
           case 'busquedaGeneral':{
               $this->busquedaGeneral();
               break;
           }
           case 'getEditoriales':{
                    $this->getEditoriales();
                    print $this->print;
                    exit();
                    break;
            }
            case 'getAutores':{
                    $this->getAutores();
                    print $this->print;
                    break;
            }
            case 'getCategorias':{
                     $this->getCategorias();
                     print $this->print;
                    break;
            }
            case 'getFechas':{
                    $this->getFechas();
                    echo $this->print;
                    break;
            }
            
            case 'getItem':{
               $this->getItem();
               echo $this->print;
               return;
               break;
            }
            
        }
    }
    
    
    ///METODO UTILIZADO PARA EL PREVIEW DE LAS CONSULTAS DELBUSCADOR
    
    function preview(){
        $this->request['limit']=4;
        $this->request['limit_autores']=10;
        $this->request['limit_editoriales']=10;
        $this->request['limit_categorias']=10;
        $this->request['limit_isbn']=10;
        $this->request['offset']=0;
        $this->print=""; 
        
        //FILTRO POR FORMATO
        
        $this->request['id_tipos_productos']="";
        if($this->request['f_impreso']=='true'){
            $this->request['id_tipos_productos'].=",1";
        }
        if($this->request['f_ebook']=='true'){
            $this->request['id_tipos_productos'].=",2";
        }
        if($this->request['f_revista']=='true'){
            $this->request['id_tipos_productos'].=",4";
        }
        if($this->request['f_suscripcion']=='true'){
            $this->request['id_tipos_productos'].=",5";
        }
        $this->request['id_tipos_productos']=ltrim($this->request['id_tipos_productos'],',');
        
        
        //FIN FILTRO POR FORMATO
        
        $result = $this->model->busquedaDirecta($this->request);
         if(!$result){
              $this->print="";
              return;
         }
         
         $this->print=$this->view->getResultadoPreview($result,$this->request['searchString']);
         
        
        
    }
    
    function busquedaGeneral(){
        if(!isset($this->request['offset'])){
            $this->request['limit']=10;
            $this->request['offset']= 0;
        }
        
        if($this->model->busquedaGeneral($this->request)){
            $this->print=$this->view->busquedaGeneral($this->model->data,$this->request);
        }
        
    }
    
    function getEditoriales(){
        if($this->model->getEditoriales(array('estado'=>'activo'))){
             $this->print = $this->view->getEditoriales($this->model->data);
        }
    }
    function getAutores(){
        if($this->model->getAutores()){
             $this->print = $this->view->getAutores($this->model->data);
        }
    }
    function getCategorias(){
        if($this->model->getCategorias(0)){
             $this->print = $this->view->getCategorias($this->model->data);
        }
    }
    function renderPage(){
        return $this->print;
    }
    
    function getItem(){
        require_once("app/shoppingcar/classShoppingCar.php");
        $this->model->getdetalleRegistro($this->request['registro']);
        $this->car = new classShoppingCar(false);
        $this->print = $this->view->detalleItem($this->model->data, $this->car->car);
    }
}

?>
