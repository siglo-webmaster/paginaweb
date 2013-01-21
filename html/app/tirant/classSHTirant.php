<?php

	//require_once("view/classViewSearch.php");
	//require_once("lib/classstructHTML.php");

	require_once("model/modelSHTirant.php");
        require_once("view/itemHTML.php");
        
        require_once("app/shoppingcar/classShoppingCar.php");
       //require_once("lib/calendar/classshCalendar.php");
	/*! \class classSHTirant
		\brief Encargada de presentar los titulos tirant, hacer busquedas sobre los mismos y presentar listados y detalles de los libros de esta editorial
		\author Oscar M. Borja
		\version   1
		\date      2012-03-02
		\copyright GNU Public License.
	*/
	class classSHTiran  {
		public $model;/*< Model mase de datos*/
		public $data;/*< Array de datos a ser procesados*/
                public $car;
                
		public $filter;/*< array con las opciones de busqueda implementadas*/
		public $return;/*< resultados de la busqueda realizada*/
		public $items; /*< almacena los items de consulta renderisados en html*/
		public $formBusqueda;/*< Formulario de busqueda*/
                public $type; /*< tipo de requerimiento que se esta procesando */
                public $body; /*< contenido del cuerpo del la pagina listo para ser mostrado*/
                public $busqueda; /*< Guarda el formulario de busqueda generado*/
                
                
                /*PARAMETROS DE BUSQUEDA*/
                public $page; /*< paginacion */
		public $limit;/*< Cantidad maxima de registros a mostrar */
		public $offset;/*< apuntador de inicio de busqueda de registros */
                public $title;
                public $theme;
                public $autor;
                public $id_autores;
                public $moneda;
                public $isbn;
                public $date_publish;
                public $sh_params;
                public $editoriales;
              //  public $sort_by;
                /*FIN PARAMETROS DE BUSQUEDA*/
                
		/*! \fn _construct($type,$limit,$offset,$filter)
			\brief Inicializa las variables y determina el tipo de busqueda a realizar
			\param $type tipo de busqueda puede ser : {home,list,reg}
		*/
		function __construct($sh_params=FALSE){
                        if(!isset($_SESSION['moneda'])){
                            $_SESSION['moneda'] =1;
                        }
			$this->formBusqueda ='';
                        $this->busqueda='';
			$this->sh_params =$sh_params;
                        $this->loadParamsRequest(); /* cargar los parametros de request*/
                        
			$this->model = new modelSHTirant();

                        /*< MOSTRAR BARRA DE BUSQUEDAS EN TODAS LAS PAGINAS */
                       /* $this->model->getCategorias('0');
                        $categorias = $this->model->data;
                        
                        $this->model->getEditoriales(array('estado'=>'activo'));
                        $editoriales= $this->model->data;
                        
                        $this->model->getFechasPub();
                        $fechas_publicacion = $this->model->data;
                        
                        */
                        /*< FIN MOSTRAR BARRA DE BUSQUEDAS EN TODAS LAS PAGINAS */
                        switch($this->type){
                                case 'searchList':{
                                    $this->searchList();                                    
                                    break;
                                }
				case 'reg':{ /*< case reg detallede un registro */
                                    
                                    if(isset($_REQUEST['iframe'])){

                                        $this->detalleRegistroenListado($_REQUEST['registro']);
                                        echo trim($this->items->items);
                                        exit(0);

                                        
                                    }
                                    $this->items = new itemHTML('reg');
                                    $this->detalleRegistro($_REQUEST['registro']);
                                    
                                    break;
                                }
                                case 'list':{
                                 if($this->listarRegistros(true)){
                                     echo trim($this->items->items);
                                 }
                                 
                                 exit(0);
                                 break;   
                                }
				//default:{ /*< Case home o cualquier otro incluyendo list */
                                  /*  $this->formBusqueda = new classViewSearch($categorias, 
                                                            array('limit'=>&$this->limit,
                                                                'title'=>$this->title,
                                                                'autor'=>$this->autor,
                                                                'theme'=>$this->theme,
                                                                'isbn'=>  $this->isbn,
                                                                'date_publish'=> $this->date_publish,
                                                                'editoriales'=>$editoriales,
                                                                'fechas_publicacion'=>$fechas_publicacion
                                      ));
                                     $this->busqueda = $this->formBusqueda->renderSearch();
                                    
                                    
                                       $this->listarRegistros();
					return ;
				}*/
			}
		}
		
                
                /*! \fn loadParamsRequest() 
                 *  \brief limpia las entradas de busqueda y las carga en las variables respectivas
                 */
                function loadParamsRequest(){
                    
                    $this->type = (isset($_REQUEST['action'])) ? $_REQUEST['action'] :'home';/*<Carga accion a realizar*/ 
                    
                    if(isset($_REQUEST['moneda'])){
                        $_SESSION['moneda']=$_REQUEST['moneda'];
                        $this->moneda = $_SESSION['moneda'];
                    }
                    
                    /*< Cargar parametros de paginacion */
                    //$this->limit = (isset($_REQUEST['limit'])) ? trim(preg_replace("/[^0-9\ ]/",'',$_REQUEST['limit'] )): _DEFAULTLIMIT; 
                    //$this->offset = (isset($_REQUEST['offset'])) ? trim(preg_replace("/[^0-9\ ]/",'',$_REQUEST['offset'] )): _DEFAULTOFFSET; 
                    
                    $this->page = (isset($_REQUEST['page'])) ? trim(preg_replace("/[^0-9\ ]/",'',$_REQUEST['page'] )):_DEFAULTPAGE; 
                    $this->limit = _DEFAULTLIMIT;
                    $this->offset=$this->page*$this->limit;
                    if($this->offset<0){
                        $this->offset = _DEFAULTLIMIT;
                   
                    }
                    
                   
                    if($this->type=='list'){
                        if(isset($_SESSION['filter'])){
                            $this->filter =$_SESSION['filter'];
                        }
                        
                        return;
                    }
                   
                    /*< Fin cargar parametros de paginacion */
                    
                    /*< Cargar parametros de busqueda*/
                     
                    $this->title = (isset($_REQUEST['title'])) ? trim(preg_replace("/[^A-Za-z0-9\ ]/",'',$_REQUEST['title'])) : ''; 
                    $this->theme = (isset($_REQUEST['theme'])) ? trim(preg_replace("/[^0-9\ ]/",'',$_REQUEST['theme'])) : ''; 
                    $this->autor = (isset($_REQUEST['autor'])) ? trim(preg_replace("/[^A-Za-z0-9\ ]/",'',$_REQUEST['autor'])) : ''; 
                    $this->id_autores = (isset($_REQUEST['id_autores'])) ? trim(preg_replace("/[^0-9\ ]/",'',$_REQUEST['id_autores'])) : ''; 
                    $this->isbn = (isset($_REQUEST['isbn'])) ? trim(preg_replace("/[^0-9\ ]/",'',$_REQUEST['isbn'])) : ''; 
                    $this->date_publish = (isset($_REQUEST['date_publish'])) ? trim(preg_replace("/[^A-Za-z0-9\ ]/",'',$_REQUEST['date_publish'])) : ''; 
                    $this->editoriales = (isset($_REQUEST['id_editoriales'])) ? trim(preg_replace("/[^A-Za-z0-9\ ]/",'',$_REQUEST['id_editoriales'])) : ''; 
                   // $this->sort_by = (isset($_REQUEST['sort_by'])) ? trim(mysql_real_escape_string($_REQUEST['sort_by'])) : ''; 
                    
                    
                    $this->filter='';
                    
                    // FILTRAR MONEDA
                    
                  
                    
                    /*BUSCAR POR TITULO O PALABRA CLAVE*/
                    if($this->title!=''){
                        if(strlen($this->title)>0){
                            $temp = explode(' ', $this->title);
                            $this->filter.= "and t.id_titulos in (SELECT ta.id_titulos from titulos_atributos as ta where ta.llave='titulo' and  (";
                            
                            foreach($temp as $palabra){
                                $palabra=trim($palabra);
                                if(strlen($palabra)>0){
                                    if(!isset($temp2)){
                                        $temp2='';
                                    }else{
                                        $temp2.=' and ';
                                    }
                                    $temp2.=" ta.valor like '%".$palabra."%' ";
                                }
                            }
                            $this->filter.=$temp2." )) ";
                            
                        }
                        
                    }
                    
                    /*BUSCAR POR TEMA */
                    if($this->theme!=''){
                        if(strlen($this->theme)>0){
                            $this->filter.=" and t.id_titulos in (SELECT distinct tc.id_titulos from titulos_categorias as tc where tc.id_categorias='".$this->theme."') ";
                        }
                    }
                    
                     /*BUSCAR POR EDITORIALES */
                    if($this->editoriales!=''){
                        if(strlen($this->editoriales)>0){
                            
                          $this->filter.=" and e.id_editoriales ='".$this->editoriales."' ";
                        }
                    }
                    
                    
                    
                    /*BUSCAR POR AUTOR*/
                    if($this->autor!=''){
                        if(strlen($this->autor)>0){
                            $temp = explode(' ', $this->autor);
                            $this->filter.= "and t.id_titulos in (SELECT tau.id_titulos from titulos_autores as tau  inner join autores as a on a.id_autores = tau.id_autores where (";
                            foreach($temp as $palabra){
                                $palabra=trim($palabra);
                                if(strlen($palabra)>0){
                                    
                                    if(!isset($temp2)){
                                        $temp2='';
                                    }else{
                                        $temp2.=' and ';
                                    }
                                    $temp2.=" a.nombre_key like '%".strtolower(preg_replace("[^A-Za-z0-9]", "",$palabra))."%' ";
                                }
                            }
                          $this->filter.=$temp2." )) ";
                        }
                    }
                    
                    /*BUSCAR POR ID DE AUTOR*/
                    if($this->id_autores!=''){
                        $this->filter.= "and t.id_titulos in (SELECT tau.id_titulos from titulos_autores as tau where tau.id_autores='".$this->id_autores."')";
                    }
                    
                    /*BUSCAR POR ISBN */
                    if($this->isbn!=''){
                        if(strlen($this->isbn)>0){
                            
                            
                            $this->filter.= "and t.id_titulos in (SELECT ta.id_titulos from titulos_atributos as ta where ta.llave='isbn13' and ta.valor like '%".(preg_replace('/[^0-9]/','',$this->isbn))."%' )";
                        }
                    }
                    
                    
                    /*BUSCAR POR FECHA */
                    if($this->date_publish!=''){
                        if(strlen($this->date_publish)>0){
                            $this->filter.= "and t.id_titulos in (SELECT ta.id_titulos from titulos_atributos as ta where llave='fecha_pub' and YEAR(valor)='".$this->date_publish."')";
                        }
                    }
                    
                    if(($this->type!='reg')&&($this->type!='list')){
                        $_SESSION['filter']=$this->filter;
                    }
                    
                    
        
                    /*< FIN Cargar parametros de busqueda*/
                
                }
                 
                
		/*! \fn renderPage()
			\brief Esta funcio formatea finalmente la salida hacia el navegador
			\return Retorna la cadena HTML requerida.
		*/
		function renderPage(){
                    
                        return ($this->type=='reg')? $this->body:$this->busqueda.//$this->items->addTitle().
                        $this->body;
			
		}
		
		
		/*! \fn listarRegistros()
			\brief consulta la base de datos y retorna un listado de registros de acuerdo a los parametros especificados de busqueda
			\return true en caso de exito, false en caso de error
		*/
		function listarRegistros($list = false){
                        
                        $this->model->getItems(array('limit'=>$this->limit,'offset'=>$this->offset,'filter'=>$this->filter));
                        
                        if($this->model->status){
                            $this->data = $this->model->data;
                            $this->items = new itemHTML();
                                                     
                            foreach($this->data as $row){
                                $this->items->addItem($row);
                            }
                            $this->items->closeItems($list);

                            $this->body=$this->items->items."</div>";
                            return true;
                        }else{
                            $this->body="No se encuantran registros ";
                            return false;
                        }
           
		}
		
		/*! \fn detalleRegistro()
			\brief consulta base de datos y retorn alos detalles del libro
			\return true en caso de exito, false en caso de error
		*/
		function detalleRegistro($registro){
                    $this->car = new classShoppingCar(false);
                    $this->model->getdetalleRegistro($registro);
                    $item = new itemHTML($_REQUEST['action'],$this->model->data);
                    $this->body = $item->detalleItem($this->model->data, $this->car->car);
		}
                
                
                function detalleRegistroenListado($registro){
                    $this->model->getdetalleRegistro($registro);
                    $this->items = new itemHTML("reg");
                    
                    unset ($this->model->data[0]['detalleItem']);
                    $this->model->data[0]['list']=true;
                    foreach($this->model->data as $row){
                        $this->items->addItem($row);
                    }
                    $this->items->closeItems(false);
                }
                
                function searchList(){
                    
                }
		
	}
?>