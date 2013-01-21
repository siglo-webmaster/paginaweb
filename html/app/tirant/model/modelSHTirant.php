<?php
	class modelSHTirant{
		public $conn;
		public $status;
		public $data;
                public $page;
                public $limit;
                public $offset;
                public $numrows;
                
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
                
                function getCategorias($id_padre = ''){
                    try{    
                            if($id_padre != ''){
                                $query = "SELECT distinct * FROM categorias where id_padre = :id_padre order by nombre ";
                                
                                $conn_prepare = $this->conn->prepare($query);
                                $conn_prepare->bindParam(':id_padre', $id_padre, PDO::PARAM_INT);
                            }else{
                                $query = "SELECT distinct * FROM categorias";
                                $conn_prepare = $this->conn->prepare($query);
                            }
                            $conn_prepare->execute( ) ;
                            $this->data=$conn_prepare->fetchAll( );
                            $this->status=true;
				
			}catch(PDOException $e){
				$this->status=false;
				echo $e->getMessage();
			}
			return $this->status;
                }
                
                 function getEditoriales($filtro=false){
                        if($filtro!=false){
                            $temp=false;
                            foreach ($filtro as $key=>$value){
                                if($temp==false){
                                    $temp = " where ";
                                }else{
                                    $temp.= " and ";
                                }
                                $temp.=" ". $key."='".$value."'";
                            }
                            $filtro = $temp;
                            
                        }else{
                            $filtro='';
                        }
			try{
				$query = "SELECT distinct e.* FROM editoriales as e ".$filtro." order by e.nombre ";
				$conn_prepare = $this->conn->prepare($query);
				$conn_prepare->execute( ) ;
				$this->data=$conn_prepare->fetchAll( );
				$this->status=true;
				
			}catch(PDOException $e){
				$this->status=false;
				echo $e->getMessage();
			}
			return $this->status;
		}
                
                function getFechasPub(){
                    try{
                        $query = "Select distinct YEAR(valor) as fecha_pub from titulos_atributos where llave='fecha_pub' order by fecha_pub DESC";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->execute();
                        $this->data = $conn_prepare->fetchAll();
                        $this->status=true;
                        
                    }catch(PDOException $e){
                    
                        echo $e->getMessage();
                        $this->status=false;
                    }
                    return $this->status;
                    
                }
             
               

                
                function getItems($data){
                    $this->numrows = false;
                    $this->status = false;
                    $this->data='';
                    if(!isset($data['filter'])){
                        $data['filter']='';
                    }
                    if(isset($data['option'])){
                          
                        switch ($data['option']){
                            case 'getRegistro':{
                                
                                $query = "select t.id_titulos from titulos  as t where t.id_titulos= :id_titulos and estado='activo' order by t.id_titulos";
                                
                                $conn_prepare  = $this->conn->prepare($query);
                                $conn_prepare->bindParam(':id_titulos',$data['id_titulos'],PDO::PARAM_INT);
                                
                                $this->numrows =true;
                                break;
                            }
                            
                            case 'getTitulosProveedor':{
                                $query= "select t.id_titulos from titulos as t 
                                    inner join titulos_editoriales as te on te.id_titulos=t.id_titulos 
                                    inner join editoriales as e on te.id_editoriales = e.id_editoriales
                                    inner join titulos_proveedores as tp on tp.id_titulos = t.id_titulos
                                    and tp.id_proveedores='1' 
                                    where e.estado='activo' and t.estado='activo'  ". $data['filter']. 
                                    "order by t.id_titulos limit ".$data['offset'].",".$data['limit'];
                                
                                $conn_prepare  = $this->conn->prepare($query);
                                
                                $queryNumRows = "select count(t.id_titulos) as numrows from titulos as t 
                                    inner join titulos_editoriales as te on te.id_titulos=t.id_titulos 
                                    inner join editoriales as e on te.id_editoriales = e.id_editoriales 
                                    where e.estado='activo' and t.estado='activo'  ". $data['filter'];
                                
                            }
                            
                            default:{
                                $query= "select t.id_titulos from titulos as t 
                                    inner join titulos_editoriales as te on te.id_titulos=t.id_titulos 
                                    inner join editoriales as e on te.id_editoriales = e.id_editoriales 
                                    where e.estado='activo' and t.estado='activo'  ". $data['filter']. 
                                    "order by t.id_titulos limit ".$data['offset'].",".$data['limit'];
                                
                                $conn_prepare  = $this->conn->prepare($query);
                                
                                $queryNumRows = "select count(t.id_titulos) as numrows from titulos as t 
                                    inner join titulos_editoriales as te on te.id_titulos=t.id_titulos 
                                    inner join editoriales as e on te.id_editoriales = e.id_editoriales 
                                    where e.estado='activo' and t.estado='activo'  ". $data['filter'];
                                
                            }
                        }
                    }else{
                        $query= "select t.id_titulos from titulos as t 
                                    inner join titulos_editoriales as te on te.id_titulos=t.id_titulos 
                                    inner join editoriales as e on te.id_editoriales = e.id_editoriales 
                                    where e.estado='activo' and t.estado='activo'  ". $data['filter']. 
                                    "order by t.id_titulos limit ".$data['offset'].",".$data['limit'];
                                
                        $conn_prepare  = $this->conn->prepare($query);

                        $queryNumRows = "select count(t.id_titulos) as numrows from titulos as t 
                            inner join titulos_editoriales as te on te.id_titulos=t.id_titulos 
                            inner join editoriales as e on te.id_editoriales = e.id_editoriales 
                            where e.estado='activo' and t.estado='activo'  ". $data['filter'];
                        
                    }
                    

                    
                    ////SELECCION DE LISTA DE PRECIOS
                        if(!isset($_SESSION['moneda'])){
                            $_SESSION['moneda'] = 1;
                        }
                        switch($_SESSION['moneda']){
                            case 1:{
                             $id_lista_precios = 1;
                             $_SESSION['decimales']=0;
                             break;
                            }
                            case 2:{
                                $id_lista_precios = 2;
                                $_SESSION['decimales']=2;
                                break;
                            }
                            case 3:{
                                $id_lista_precios = 3;
                                $_SESSION['decimales']=2;
                                break;
                            }
                            default :
                                $id_lista_precios=1;
                                $_SESSION['decimales']=0;
                        }
                    

                   
                   // $this->limit = $data['limit'];
                   // $this->offset = $data['offset'];
                    
                    try{
                        $conn_prepare->execute() ;
                        $titulos = $conn_prepare->fetchAll( );
                        
                        if(!(sizeof($titulos)>0)){
                           $this->data= $this->status =false;
                           return $this->status;
                        }
                        
                        $this->numrows = ($this->numrows)?1:$this->getNumRows($queryNumRows);
                       

                        foreach ($titulos as $row){
                            $temp_array = array();
                            $temp_array['id_titulos'] = $row['id_titulos'];
                            $query = 'select * from titulos_atributos where id_titulos= :id_titulos';
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $row['id_titulos']);
                            $conn_prepare->execute() ;
                            
                            $titulos_atributos = $conn_prepare->fetchAll( );
                            
                            foreach($titulos_atributos as $row2){
                                $temp_array[$row2['llave']]=$row2['valor'];
                            }
                            $temp_array['fecha_pub'] = substr($temp_array['fecha_pub'], 0,4);
                            $temp_array['id_lista_precios']=$id_lista_precios;
                            
                            ////AUTORES POR LIBRO////
                            $query = 'select a.nombre, a.id_autores from autores as a  inner join  titulos_autores as ta on ta.id_autores = a.id_autores where ta.id_titulos = :id_titulos';
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $row['id_titulos']);
                            $conn_prepare->execute() ;
                            
                            $titulos_autores = $conn_prepare->fetchAll( );
                            $i=0;
                            foreach($titulos_autores as $autor){
                                $temp_array['autores'][$i]['id_autores']=$autor['id_autores'];
                                $temp_array['autores'][$i]['nombre']=$autor['nombre'];
                                $i++;
                            }
                            
                            /// FIN AUTORES POR LIBRO///////
                            
                            
                            ////EDITORIALES POR LIBRO////
                            
                            $query = 'select e.id_editoriales,  e.nombre, e.imagen from editoriales as e inner join titulos_editoriales as te on e.id_editoriales = te.id_editoriales where te.id_titulos = :id_titulos and e.estado=\'activo\'';
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $row['id_titulos']);
                            $conn_prepare->execute() ;
                            
                            $titulos_editoriales = $conn_prepare->fetchAll( );
                            $i=0;
                            foreach($titulos_editoriales as $editorial){
                                $temp_array['editoriales'][$i]['id_editoriales']=$editorial['id_editoriales'];
                                $temp_array['editoriales'][$i]['nombre']=$editorial['nombre'];
                                $temp_array['editoriales'][$i]['imagen']=$editorial['imagen'];
                                $i++;
                            }
                            
                            /// FIN EDITORIALES POR LIBRO///////
  
                             ////PRECIO Y TIPO DE PRODUCTO////
                            if(!isset($_SESSION['moneda'])){
                                $_SESSION['moneda']=1;
                            }
                            
                            $query = 'select TRUNCATE(tlp.precio,'.$_SESSION['decimales'].') as precio, tlp.id_tipos_productos, tlp.id_proveedores, tp.nombre, tp.imagen , m.nombre_corto as moneda
                                from titulos_lista_precios as tlp 
                                inner join tipos_productos as tp on tp.id_tipos_productos = tlp.id_tipos_productos 
                                inner join lista_precios as lp on lp.id_lista_precios = tlp.id_lista_precios
                                inner join monedas as m on m.id_moneda = lp.id_moneda
                                where tlp.id_titulos = :id_titulos 
                                    and lp.id_moneda =:id_moneda
                                    ';// and tlp.id_lista_precios = :id_lista_precios';
                            
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $row['id_titulos']);
                            $conn_prepare->bindParam(':id_moneda', $_SESSION['moneda']);
                          //  $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios);
                            $conn_prepare->execute() ;
                            
                            $titulos_productos = $conn_prepare->fetchAll( );
                            
                            foreach($titulos_productos as $producto){
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['id_tipos_productos']=$producto['id_tipos_productos'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['nombre']=$producto['nombre'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['imagen']=$producto['imagen'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['precio']=$producto['precio'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['id_proveedores']=$producto['id_proveedores'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['moneda']=$producto['moneda'];
                               
                            }
                            
                            /// FIN PRECIO Y TIPO PRODUCTOS///////
                            
                            
                           ////CATEGORIAS RELACIONADAS////
                            
                            $query = "select tc.id_categorias, c.nombre from titulos_categorias as tc 
                                inner join categorias as c on c.id_categorias = tc.id_categorias and c.estado='activo' 
                                where tc.id_titulos =:id_titulos and tc.id_categorias != 229 ";
                            
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $row['id_titulos']);
                            $conn_prepare->execute() ;
                            
                            $categorias = $conn_prepare->fetchAll( );
                            $i=0;
                            foreach($categorias as $categoria){
                                $temp_array['categorias'][$i]['id_categorias']=$categoria['id_categorias'];
                                $temp_array['categorias'][$i]['nombre']=$categoria['nombre'];
                                $i++;
                            }
                            
                            /// FIN CATEGORIAS RELACIONADAS///////

                            $this->data[]=$temp_array;
                            unset($temp_array);
                        }

                        
                        
              
                        $this->status=true;
                        
                    }catch(PDOException $e){
                        
                        echo $e->getMessage();
                        
                        $this->status=false;
                    }
                    
                    return $this->status;
                }
                
                
                
                function getdetalleRegistro($registro){
                   $data['option'] = 'getRegistro';
                   $data['id_titulos']=$registro;
     
                   $this->getItems($data);
                   
                   
                }
                
                function getNumRows($query){
                    $conn_prepare  = $this->conn->prepare($query);
                    $conn_prepare->execute() ;
                    $temp = $conn_prepare->fetchAll();
                    return $temp[0]['numrows'];
                }
                
                function getresenyaItem($url){
			try{
				$file = fopen ($url, "r");
				if (!$file) {
					return false;
				}else{
                                        $return ='';
					while (!feof ($file)) {
						$return.= fgets($file);	
					}
				}
				fclose($file);
			}catch (Exception $e){
                            echo $e->getMessage();
				return false;
			}
                        $return = $this->getTextBetweenTags($return, 'object');
			return $return;
		
                }
                
                function getTextBetweenTags($string, $tagname)
                {
                    $pattern = "/<$tagname(.*?)<\/$tagname>/";
                    preg_match($pattern, $string, $matches);
                    if(isset($matches[0])){
                        $return = "<object ".$matches[0]. "</object>";;
                    }else{
                        $return = false;
                    }
                    return $return;
                }
                
                function getAutores($filtro=false){
                        if($filtro!=false){
                            $temp=false;
                            foreach ($filtro as $key=>$value){
                                if($temp==false){
                                    $temp = " where ";
                                }else{
                                    $temp.= " and ";
                                }
                                $temp.=" ". $key."='".$value."'";
                            }
                            $filtro = $temp;
                            
                        }else{
                            $filtro='';
                        }
			try{
				$query = "SELECT distinct a.* FROM autores as a ".$filtro." order by a.nombre ";
				$conn_prepare = $this->conn->prepare($query);
				$conn_prepare->execute( ) ;
				$this->data=$conn_prepare->fetchAll( );
				$this->status=true;
				
			}catch(PDOException $e){
				$this->status=false;
				echo $e->getMessage();
			}
			return $this->status;
                }

                function getMonedas(){
                    try{
                        $query = "SELECT DISTINCT * FROM monedas WHERE estado='activo'";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->execute();
                        $this->data = $conn_prepare->fetchAll();
                        $this->status=true;
                        
                    }catch(PDOException $e){
                    
                        echo $e->getMessage();
                        $this->status=false;
                    }
                    return $this->status;
                }
            
                
                ////////////////BUSQUEDAS PARA EL CAMPO AUTOCOMPLETAR
                
                function busquedaDirecta($data){
                    
                    if(strlen($data['searchString'])<1){
                        return false;
                    }
                    
                    $busqueda = explode(" " , $data['searchString']);
                    
                    for($i=0;$i<sizeof($busqueda);$i++){
                        if(!$this->palabrasaEliminar($busqueda[$i])){
                            $new_busqueda[]=$busqueda[$i];
                            $data['items_busqueda'][]=$busqueda[$i];
                        }
                    }
                    if(!isset($new_busqueda)){
                        return false;
                    }
                    $new_busqueda = implode('%',$new_busqueda);
                    
                    $data['searchString_like']=$new_busqueda;
                    
                    if($data['id_tipos_productos']==''){
                        $data['id_tipos_productos']='0';
                    }
                    
                    $filtro_formatos = " tlp.id_tipos_productos in (".$data['id_tipos_productos'].") ";
                    
                    switch($data['tipoBusqueda']){
                        case 'clasic':{
                            ////BUSQUEDA EN TITULOS////
                            
                            
                            
                            $filtro='';
                            
                            foreach($data['items_busqueda'] as $titulo){
                                
                                $filtro.= "and tp.titulo like '%".preg_replace("/[^A-Za-z0-9]/", "",$titulo)."%' ";
                            }
                            $filtro = ltrim($filtro,'and');

                            $query = "select distinct ta.valor , tp.codigo, ta.id_titulos from titulos_atributos as ta 
                            inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                            inner join titulos_lista_precios as tlp on tlp.id_titulos=ta.id_titulos 
                            where ta.llave='titulo' and tlp.estado='activo' and 
                            ".$filtro_formatos." 
                            and ( $filtro ) 
                            limit 0,:limit "; 
                            
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':limit',$data['limit'],PDO::PARAM_INT);
                            $conn_prepare->execute();
                            $return['titulos']= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                            
                            
                           
                            ///BUSQUEDA EN AUTORES
                             $filtro2 = str_replace(' tp.titulo ', ' a.nombre ', $filtro);
                            $query = "select a.nombre from autores as a
                                where ( $filtro2 ) 
                                limit ".$data['offset'].",".$data['limit_autores']." ";
                            
                            
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->execute();
                            $return['autores']= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                            
                            
                            
                            ///BUSQUEDA EN EDITORIALES
                             $filtro3 = str_replace(' tp.titulo ', ' e.nombre ', $filtro);
                            $query = "select e.nombre, e.id_editoriales from editoriales as e
                                where ( $filtro3 ) 
                                limit ".$data['offset'].",".$data['limit_editoriales']." ";
                            
                            
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->execute();
                            $return['editoriales']= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                            
                            
                            
                        
                            ///BUSQUEDA EN CATEGORIAS
                             $filtro4 = str_replace(' tp.titulo ', ' c.nombre ', $filtro);
                            $query = "select distinct c.nombre from categorias as c
                                where ( $filtro4 )  order by c.nombre 
                                limit ".$data['offset'].",".$data['limit_categorias']." ";
                            
                            
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->execute();
                            $return['categorias']= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                            
                            
                            
                            ///BUSQUEDA EN ISBN
                            $query = "select distinct tp.isbn  from titulos_proveedores as tp where tp.isbn like '%".$data['searchString_like']."%' 
                                limit ".$data['offset'].",".$data['limit_isbn']." ";
                            
                            
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->execute();
                            $return['isbn']= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                            return $return;
                            break;   
                        }
                        default:{
                            return false;
                        }
                    }
                    
                }
                
                /////////////////////////NUEVA BUSQUEDA/////////////
                
                
                
                function busquedaGeneral($data){
                       
                        ///CONSULTAS PARA SELECCION DE LOS TITULOS  BUSCADOS
                        $titulos = $this->generarQueryBusquedaGeneral($data); 
                                
                        
                        if($titulos==false){
                           $this->data= $this->status =false;
                           return $this->status;
                        }
                                  
                        foreach ($titulos as $row){
                            $this->data[] = $this->getDetallesTitulo($row['id_titulos']);
                        }
                        
                       return true; 
                }
                
                function generarQueryBusquedaGeneral($data){
                        $return=false;
                        
                        if(trim($data['searchString'])!=''){
                            $busqueda = explode(" " , $data['searchString']);
                            for($i=0;$i<sizeof($busqueda);$i++){
                                if(!$this->palabrasaEliminar($busqueda[$i])){
                                    $new_busqueda[]=$busqueda[$i];
                                }
                            }
                            
                            $new_busqueda = implode('%',$new_busqueda);
                            $data['searchString_like']=$new_busqueda;
                            
                            switch($data['tipoBusqueda']){
                                case 'clasic':{
                                    $return = $this->busquedaEnTitulos($data);
                                    break;   
                                }
                                case 'autores':{
                                    $return = $this->busquedaEnAutores($data);
                                    break;   
                                }
                                case 'categorias':{
                                    $return = $this->busquedaEnCategorias($data);
                                    break;   
                                }
                                case 'fecha':{
                                    $return = $this->busquedaEnFechas($data);
                                    break;   
                                }
                                case 'editoriales':{
                                    $return = $this->busquedaEnEditorial($data);
                                    break;   
                                }
                            }
                            
                        }
                        return $return;
                }
                
                
                
                function busquedaEnTitulos($data){
                    
                    $lista_precios = $this->seleccionarListaPrecios();
                    //FILTRADO POR TIPOS DE PRODUCTOS///
                    $lista_tipos_productos = $this->seleccionarListaTiposProductos($data);
                    if(!$lista_tipos_productos){return false;}
                    ////FIN FILTRADO POR TIPOS DE PRODUCTOS//
                    
                    ///BUSQUEDA POR TITULO
                    try{
                        $query = "select distinct ta.id_titulos from titulos_atributos as ta 
                            inner join titulos_lista_precios as tlp on tlp.id_titulos=ta.id_titulos
                            where 
                            ta.llave='titulo' 
                            and tlp.id_lista_precios=:id_lista_precios 
                            and tlp.id_tipos_productos in ($lista_tipos_productos) 
                            and ta.valor like '%".$data['searchString_like']."%' limit :offset,:limit";
                        $conn_prepare  = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_lista_precios', $lista_precios,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':limit', $data['limit'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':offset', $data['offset'],PDO::PARAM_INT);
                        $conn_prepare->execute() ;
                        return $conn_prepare->fetchAll( );
                    }catch(PDOException $e){
                        echo $e->getMessage();
                        return false;
                    }
                    //// FIN BUSQUEDA POR TITULO
                    
                }
                
                
                function busquedaEnAutores($data){
                    $lista_precios = $this->seleccionarListaPrecios();
                    
                    //FILTRADO POR TIPOS DE PRODUCTOS///
                    $lista_tipos_productos = $this->seleccionarListaTiposProductos($data);
                    if(!$lista_tipos_productos){return false;}
                    ////FIN FILTRADO POR TIPOS DE PRODUCTOS//
                    
                    ///BUSQUEDA POR AUTORES
                    try{
                        $query = "select distinct ta.id_titulos from titulos_autores as ta 
                            inner join autores as a on a.id_autores=ta.id_autores 
                            inner join titulos_lista_precios as tlp on tlp.id_titulos=ta.id_titulos
                            where 
                            tlp.id_lista_precios=:id_lista_precios 
                            and tlp.id_tipos_productos in ($lista_tipos_productos) 
                            and a.nombre like '%".$data['searchString_like']."%' limit :offset,:limit";
                        $conn_prepare  = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_lista_precios', $lista_precios,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':limit', $data['limit'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':offset', $data['offset'],PDO::PARAM_INT);

                        $conn_prepare->execute() ;
                        return $conn_prepare->fetchAll( );
                    }catch(PDOException $e){
                        echo $e->getMessage();
                        return false;
                    }
                    //// FIN BUSQUEDA POR AUTORES
                    
                }
                
                function busquedaEnCategorias($data){
                    
                    $lista_precios = $this->seleccionarListaPrecios();
                    
                    //FILTRADO POR TIPOS DE PRODUCTOS///
                    $lista_tipos_productos = $this->seleccionarListaTiposProductos($data);
                    if(!$lista_tipos_productos){return false;}
                    ////FIN FILTRADO POR TIPOS DE PRODUCTOS//
                    
                    ///BUSQUEDA POR CATEGORIAS
                    try{
                        $query = "select distinct tc.id_titulos from titulos_categorias as tc 
                            inner join titulos_lista_precios as tlp on tlp.id_titulos=tc.id_titulos
                            inner join titulos_atributos as ta on ta.id_titulos=tc.id_titulos
                            where 
                            ta.llave='titulo'
                            and ta.valor like '%".$data['searchString_like']."%'  
                            and tlp.id_lista_precios=:id_lista_precios 
                            and tlp.id_tipos_productos in ($lista_tipos_productos) 
                            and tc.id_categorias=:id_categorias limit :offset,:limit";
                        $conn_prepare  = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_lista_precios', $lista_precios,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':limit', $data['limit'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':offset', $data['offset'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_categorias', $data['id_categorias'],PDO::PARAM_INT);

                        $conn_prepare->execute() ;
                        return $conn_prepare->fetchAll( );
                    }catch(PDOException $e){
                        echo $e->getMessage();
                        return false;
                    }
                    //// FIN BUSQUEDA POR CATEGORIAS
                    
                }
                
                function busquedaEnFechas($data){
                    
                    $lista_precios = $this->seleccionarListaPrecios();
                    
                    //FILTRADO POR TIPOS DE PRODUCTOS///
                    $lista_tipos_productos = $this->seleccionarListaTiposProductos($data);
                    if(!$lista_tipos_productos){return false;}
                    ////FIN FILTRADO POR TIPOS DE PRODUCTOS//
                    
                    ///BUSQUEDA POR RANGO DE FECHA
                    try{
                        $query = "select distinct ta1.id_titulos from titulos_atributos as ta1 
                            inner join titulos_lista_precios as tlp on tlp.id_titulos=ta1.id_titulos
                            inner join titulos_atributos as ta on ta.id_titulos=ta1.id_titulos
                            where 
                            ta.llave='titulo'
                            and ta.valor like '%".$data['searchString_like']."%'  
                            and tlp.id_lista_precios=:id_lista_precios 
                            and tlp.id_tipos_productos in ($lista_tipos_productos) 
                            and ta1.llave='fecha_pub'
                            and ta1.valor between '".$data['f_desde']."-01-01' and '".$data['f_hasta']."12-31'  
                            limit :offset,:limit";
                        $conn_prepare  = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_lista_precios', $lista_precios,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':limit', $data['limit'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':offset', $data['offset'],PDO::PARAM_INT);
                        

                        $conn_prepare->execute() ;
                        return $conn_prepare->fetchAll( );
                    }catch(PDOException $e){
                        echo $e->getMessage();
                        return false;
                    }
                    //// FIN BUSQUEDA POR FECHAS
                    
                }
                
                
                function palabrasaEliminar($cadena){
                    $palabras =array(' ','a','e','y','o','u','la', 'las','el','lo','los','en','para','con','que', 'de');
                    return (in_array(strtolower($cadena) , $palabras, false))?true:false;
                }
                
                function seleccionarListaTiposProductos($data){
                    $lista_tipos_productos = "";
                    if(isset($data['f_impreso'])){$lista_tipos_productos.=',1';}
                    if(isset($data['f_ebook'])){$lista_tipos_productos.=',2';}
                    if(isset($data['f_revista'])){$lista_tipos_productos.=',4';}
                    if(isset($data['f_suscripcion'])){$lista_tipos_productos.=',5';}
                    
                    return  ($lista_tipos_productos=='')?false:ltrim($lista_tipos_productos,',');
                    
                }
                function seleccionarListaPrecios(){
                    ////SELECCION DE LISTA DE PRECIOS
                        if(!isset($_SESSION['moneda'])){
                            $_SESSION['moneda']=1;
                        }
                        switch($_SESSION['moneda']){
                            case 1:{
                             $id_lista_precios = 1;
                             $_SESSION['decimales']=0;
                             break;
                            }
                            case 2:{
                                $id_lista_precios = 2;
                                $_SESSION['decimales']=2;
                                break;
                            }
                            case 3:{
                                $id_lista_precios = 3;
                                $_SESSION['decimales']=2;
                                break;
                            }
                            default :
                                $id_lista_precios=1;
                                $_SESSION['decimales']=0;
                        }
                        
                        return $id_lista_precios;
                }
                
                function getDetallesTitulo($id_titulos){
                    
                            $temp_array = array();
                            $temp_array['id_titulos'] = $id_titulos;
                            
                            $query = 'select * from titulos_atributos where id_titulos= :id_titulos';
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $id_titulos);
                            $conn_prepare->execute() ;
                            
                            $titulos_atributos = $conn_prepare->fetchAll( );
                            
                            foreach($titulos_atributos as $row2){
                                $temp_array[$row2['llave']]=$row2['valor'];
                            }
                            $temp_array['fecha_pub'] = substr($temp_array['fecha_pub'], 0,4);
                            $temp_array['id_lista_precios']=$this->seleccionarListaPrecios();
                            
                            ////AUTORES POR LIBRO////
                            $query = 'select a.nombre, a.id_autores from autores as a  inner join  titulos_autores as ta on ta.id_autores = a.id_autores where ta.id_titulos = :id_titulos';
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $id_titulos);
                            $conn_prepare->execute() ;
                            
                            $titulos_autores = $conn_prepare->fetchAll( );
                            $i=0;
                            foreach($titulos_autores as $autor){
                                $temp_array['autores'][$i]['id_autores']=$autor['id_autores'];
                                $temp_array['autores'][$i]['nombre']=$autor['nombre'];
                                $i++;
                            }
                            
                            /// FIN AUTORES POR LIBRO///////
                            
                            ////EDITORIALES POR LIBRO////
                            
                            $query = 'select e.id_editoriales,  e.nombre, e.imagen from editoriales as e inner join titulos_editoriales as te on e.id_editoriales = te.id_editoriales where te.id_titulos = :id_titulos and e.estado=\'activo\'';
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $id_titulos);
                            $conn_prepare->execute() ;
                            
                            $titulos_editoriales = $conn_prepare->fetchAll( );
                            $i=0;
                            foreach($titulos_editoriales as $editorial){
                                $temp_array['editoriales'][$i]['id_editoriales']=$editorial['id_editoriales'];
                                $temp_array['editoriales'][$i]['nombre']=$editorial['nombre'];
                                $temp_array['editoriales'][$i]['imagen']=$editorial['imagen'];
                                $i++;
                            }
                            
                            /// FIN EDITORIALES POR LIBRO///////
  
                             ////PRECIO Y TIPO DE PRODUCTO////
                            if(!isset($_SESSION['moneda'])){
                                $_SESSION['moneda']=1;
                            }
                            
                            $query = 'select TRUNCATE(tlp.precio,'.$_SESSION['decimales'].') as precio, tlp.id_tipos_productos, tlp.id_proveedores, tp.nombre, tp.imagen , m.nombre_corto as moneda
                                from titulos_lista_precios as tlp 
                                inner join tipos_productos as tp on tp.id_tipos_productos = tlp.id_tipos_productos 
                                inner join lista_precios as lp on lp.id_lista_precios = tlp.id_lista_precios
                                inner join monedas as m on m.id_moneda = lp.id_moneda
                                where tlp.id_titulos = :id_titulos 
                                    and lp.id_moneda =:id_moneda
                                    ';// and tlp.id_lista_precios = :id_lista_precios';
                            
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $id_titulos);
                            $conn_prepare->bindParam(':id_moneda', $_SESSION['moneda']);
                          //  $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios);
                            $conn_prepare->execute() ;
                            
                            $titulos_productos = $conn_prepare->fetchAll( );
                            
                            foreach($titulos_productos as $producto){
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['id_tipos_productos']=$producto['id_tipos_productos'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['nombre']=$producto['nombre'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['imagen']=$producto['imagen'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['precio']=$producto['precio'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['id_proveedores']=$producto['id_proveedores'];
                                $temp_array['tipo_producto'][$producto['id_tipos_productos']]['moneda']=$producto['moneda'];
                               
                            }
                            
                            /// FIN PRECIO Y TIPO PRODUCTOS///////
                    
                            
                           ////CATEGORIAS RELACIONADAS////
                            
                            $query = "select tc.id_categorias, c.nombre from titulos_categorias as tc 
                                inner join categorias as c on c.id_categorias = tc.id_categorias and c.estado='activo' 
                                where tc.id_titulos =:id_titulos and tc.id_categorias != 229 ";
                            
                            $conn_prepare  = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_titulos', $id_titulos);
                            $conn_prepare->execute() ;
                            
                            $categorias = $conn_prepare->fetchAll( );
                            $i=0;
                            foreach($categorias as $categoria){
                                $temp_array['categorias'][$i]['id_categorias']=$categoria['id_categorias'];
                                $temp_array['categorias'][$i]['nombre']=$categoria['nombre'];
                                $i++;
                            }
                            
                            /// FIN CATEGORIAS RELACIONADAS///////
                            return $temp_array;
                            
                }
            
	
                
                
        }
?>