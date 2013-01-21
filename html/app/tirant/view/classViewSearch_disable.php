<?php
	/*!
		\class classViewSearch
		\brief Encargada de denderizar los formularios de busqueda
		\author Oscar M. Borja
		\version   1
		\date      2012-03-02
		\copyright GNU Public License.
	*/
	class classViewSearch{

		public $filters;/*< campos para busqueda con filtros */
		public $params;/*< parametros de configuracion globales */
		public $request;/*< datos del request anterior*/
		public $data; /*< lacadena de retorno para presentar el formulario completop de busqueda */
		public $scripts; /*< Scripts para ser introducidos dentro de la cabecera de la pagina web */
                //public $calendar;/*< clase encargada de mostrar el calendario*/

		
		/*! \fn _construct($params)
			\brief toma la configuracion de campos suministrada y genera los html de los formularios
			\param $url La url al la cual apuntar el formulario
			\param $params los parametros de despliegue de busqueda
		*/
		function __construct( $themes=false,$request){
			$this->params = array(
                                                        'limit'=>array(10,20,50,100),
                                                        'sort_by'=>array('title'=>_TITULO,
                                                                                        'author'=>_AUTOR,
                                                                                        'price_low_hight'=>_PRECIO_MENOR_MAYOR,
                                                                                        'price_hight_low'=>_PRECIO_MAYOR_MENOR,
                                                                                        'date_publish'=>_FECHA_PUBLICACION),
                                                        'filters'=>array(

                                                                                        'isbn'=>_ISBN

                                                                                        ),
                                                        'method'=>'POST'
                                                );
			$this->data = $themes;
                        $this->request=$request;
			$this->htmlFilters();
		}
		
		function renderSearch(){
			$return= "<form action='index.php' method='".$this->params['method']."'>";
			$return.= $this->filters;
			$return.= "</form>";
			return $return;
		}
		
		
		function htmlFilters(){
                        $this->request['title'] = (isset($this->request['title']))?$this->request['title']:'';
			$this->filters="<div class='titulos'>";
                        
                        $this->filters.="<p>";
                        /////TITULO
			$this->filters.=_TITULOSEARCH.": <input type='text' class='fondo' name='title' size='40' value=\"".$this->request['title']."\" onChange=\"this.form.action = 'index.php'; this.form.submit()\"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			
                        /*CAMPO AUTOR*/       
                          $this->filters.=_AUTOR.": <input class='fondo'  type='text' size='40' name='autor' value=\"".$this->request['autor']."\" onChange=\"this.form.action = 'index.php'; this.form.submit()\"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        
                          /*FILTROS EN CONFIG.PHP*/
			foreach($this->params['filters'] as $key => $value){
				$this->filters.=$value." <input class='fondo'  type='text' size='10' name='".$key."' value=\"".$this->request[$key ]."\" onChange=\"this.form.action = 'index.php'; this.form.submit()\" />";
			}
                        /*FIN FILTROS EN CONFIG.PHP*/
                          
                        $this->filters.="</p>";  
                        
                        $this->filters.="<p>";
                        
                        //EDITORIALES
			if(isset($this->request['editoriales'])){
                            $this->filters.= _EDITORIALES;
                            $this->filters.="<select class='fondo'  name='id_editoriales' onChange=\"this.form.action = 'index.php'; this.form.submit()\">
                                        <option value=''>-- TODAS LAS EDITORIALES --</option>";
                            foreach($this->request['editoriales'] as $row){
                                if(isset($row['id_editoriales'])){
                                    if(!isset($_REQUEST['id_editoriales'])){
                                        $_REQUEST['id_editoriales']='';
                                    }
                                        
                                    if($row['id_editoriales']==$_REQUEST['id_editoriales']){
                                        $selected = " SELECTED ";
                                    }else{
                                        $selected = "";
                                    }
                                    $this->filters.="<option value='".$row['id_editoriales']."' ".$selected.">".$row['nombre']."</option>";


                                }
                                
                            }
                            $this->filters.="</select>";

                            


                        }
                        
                        ////CATEGORIAS
                        $this->filters.=_MATERIA.": ".
				"<SELECT class='fondo' name='theme' onChange=\"this.form.action = 'index.php'; this.form.submit()\">
                                    <option value=''>-- Todos los los temas --</option>";
				foreach($this->data as $row){
                                        if($row['id_categorias']==$this->request['theme']){
                                            $selected = " SELECTED ";
                                        }else{
                                            $selected = "";
                                        }
					$this->filters.="<OPTION value='".$row['id_categorias']."' ".$selected.">".$row['nombre']."</OPTION>";
				}
				
			$this->filters.="</SELECT>";
                        
                                                
                        /*< inicio Configuracion de campo de fecha */
                        $this->filters.=_FECHA_PUBLICACION .": ";
                        $this->filters.="<select class='fondo'  name='date_publish' onChange=\"this.form.action = 'index.php'; this.form.submit()\">
                                    <option value=''>----</option>";
                        foreach($this->request['fechas_publicacion'] as $row){
                            if($row['fecha_pub']==$this->request['date_publish']){
                                $selected = " SELECTED ";
                            }else{
                                $selected = "";
                            }
                            $this->filters.="<option value='".$row['fecha_pub']."' ".$selected.">".$row['fecha_pub']."</option>";
                        }
                        $this->filters.="</select>";

                        
			////LIMIT
			$this->filters.= _LIMIT_TITULO.":  
				<SELECT class='fondo'  name='limit' onChange=\"this.form.action = 'index.php'; this.form.submit()\">";
			foreach ($this->params['limit'] as $row){
                                if($row==$this->request['limit']){
                                    $selected = " SELECTED ";
                                }else{
                                    $selected = "";
                                }
				$this->filters.="<OPTION VALUE='".$row."' ".$selected.">".$row."</OPTION>";
			}
			$this->filters.="</SELECT>";
                        
                        
                        
                        ///BOTON BUSCAR
                        $this->filters.="<input class='fondo'  type='submit' value='Buscar'>";
                        
                        //BOTON BORRAR
                        $this->filters.="<input class='fondo'  type='reset' value='Limpiar'>";
                            
                        $this->filters.="</p>"; 
                        
                        $this->filters.=" </div>";
			return;
		}
		

	}
?>
