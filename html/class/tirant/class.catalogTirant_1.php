<?php

/*! \brief Genera el catalogo electronico de Tirant lo Blanch
Obtiene de una url el lisado de libros del proveedor Tirant lo Blanch una vez obtiene el listado lo procesa y lo inserta dentro de una 
base de datos (*.dbm) la cual sera posteriormente utilizada para la pagina web 
siglodelhombe version 3
\author    Oscar Borja
\version   1
\date      2012-03-01 
\copyright GNU Public License.
*/
/*! \class catalogTirant
*/

require_once ("config.php");
	class catalogTirant{
		public  $urlSource; /*!< Direccion web del catalogo que ofrece el proveedor*/
		public  $status; /*!< variable de control del objeto que indca el estado de las transacciones realizadas*/
		public  $catalog; /*!< esta variable va a contener el catalogo primero como cadena de texto y luego como matriz para insercion en la base de datos*/
		public  $conn; /*!< coneccion a la base de datos*/
		public  $fiels; /*!< Numero de campos importados */
		public  $error_log; /*!< Log de errores durante la importacion del archivo*/
		public  $nerror_log; /*!< Numero de lineas ignoradas en esta transaccion por no cumplir con parametros para ser importadas*/
		
		/*! \fn __construct($url)
			\brief En el constructor de clase nos  aseguramos que la url del listado sea valida y hacemos la conexion a la base de datos
			\param url direccion web del catalogo de libros
		*/
		function __construct($url){
			try{
				$url = trim($url);
				if(strcmp($url,'')!=0){
					$this->urlSource = $url;
					$this->catalog="";
					$this->fiels =0;
					$this->error_log='';
					$this->nerror_log=0;
					$this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD);
                                        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        $this->status=true;
				}else{
					$this->status =false;
				}
			}catch (Exception $e){
				echo $e->getMessage();
			
			}
		}
		
		/*! \fn generarCatalogo()
			\brief esta funcion se encara de hacer toda la imortacion del catalogo e introducirla dentro de la base de datos
		*/
		public function generarCatalogo(){
			if($this->getCatalog()){
				if($this->doCatalog()){
					if($this->truncateCatalog()){
						if($this->storeCatalog()){
							echo "<p>CATALOGO GENERADO CORRECTAMENTE</p>";
							echo "<p><b>Total registros procesados:</b>".$this->fiels."</p>";
							if($this->nerror_log>0){
								echo "<p><b>Total registros ignorados:</b>".$this->nerror_log."</p>";
								echo "<p><b>Log:</b>".$this->error_log."</p>";
							}
							return true;
						}else{
							echo "falla storeCatalog";
						}
					}else{
						echo "falla truncateCatalog";
					}
				}else{
					echo "falla doCatalog";
				}
				
			}else{
				echo "falla getCatalog";
			}
			return false;
		}
		
		/*! \fn getCatalog()
			\brief getCatalog: Esta funcion lee linea a linea el catalogo de libros y los introduce dentro del atrubuto catalog
		*/
		public  function getCatalog(){
			try{
				$file = fopen ($this->urlSource, "r");
				if (!$file) {
					$this->status=false;
				}else{
					while (!feof ($file)) {
						$this->catalog.= fgets($file).chr(27);	
					}
					$this->status=true;
				}
				fclose($file);
			}catch (Exception $e){
				$this->status=false;
			}
			return $this->status;
		}
		
		/*! \fn getReview($url)
			\brief getReview Lee el resumen de cada libro y lo retorna
			\warning No usar este metodo porque puede colgar el servidor al procesar listas muy largas
			\param $url la direccion del review
			\return retorna el resumen del libro o falso en caso de error
		*/
		public  function getReview($url){
		$return = '';
			try{
				$file = fopen ($url, "r");
				if (!$file) {
					return false;
				}else{
					while (!feof ($file)) {
						$return.= fgets($file);	
					}
				}
				fclose($file);
			}catch (Exception $e){
				return false;
			}
			return $return;
		}
		
		/*! \fn doCatalog()
			\brief doCatalog convierte la cadena alamcenada dentro del atributo catalog en una matriz y coloca como llave el nombre de los campos que por defecto trae el archivo de catalogo del proveedor
		*/
		public  function doCatalog(){
			$temp = explode(chr(27),$this->catalog);
			$keys = $temp[0];
			$keys = explode(chr(9),$keys);
			$temp_key=array();
			foreach($keys as $key){
				$temp_key[]=trim($key);
			}
			unset($keys);
			$keys=$temp_key;
			unset($temp[sizeof($temp)-1]);
			unset($temp[0]);
			$this->catalog=array();
			foreach($temp as $row ){
				$row = explode(chr(9),$row);
				if(sizeof($keys)==sizeof($row)){
					$temp_row=array();
					foreach($row as $value){
						$temp_row[]=trim($value);
					}
					$row_with_keys = array_combine($keys ,$temp_row);
					
					$row_with_keys['fecha_pub']=$this->dofechaPub($row_with_keys['fecha_pub']);/*!< Formateamos la checha de edicion del libro*/
					$row_with_keys['autor']=$this->doAutores($row_with_keys['autor']);/*!< formateamos la lista de autores */
					//$row_with_keys['link_detalle']=$this->getReview($row_with_keys['link_detalle']); /*!< No usar este metodo porque puede provocar colgadas en el servidor*/
					$this->catalog[]=$row_with_keys;
					$this->fiels++;
				}else{
					$this->error_log.='<p>Linea ignorada por no cumplir parametros ->> '.implode(',',$row).' <<- </p>';
					$this->nerror_log++;
				}
			}
			return $this->status;
		}
		
		
		/*! \fn date dofechaPub($fecha_publicacion)
			\brief Toma la fecha de publicacion del libro y la formatea de acuerdo alos parametros para publicacion
			\param $fecha_publicacion Trae la fecha a formatear
			\return Fecha formateada
		*/
		public  function dofechaPub($fecha_publicacion){
			$fecha = explode('/',$fecha_publicacion);
			if(sizeof($fecha)>1){
				$return=$fecha[1];
			}else{
				$return=$fecha[0];
			}
			return $return."-01-01";
		}
		
		/*! \fn string doAutores($lista_autores)
			\brief Esta funcion formatea el lidtado de autores de acuerdo a lo requerido por la base de datos
			\param $lista_autores una cadena con los autores con separador '|'
			\return cadena de caracteres con los autores separados por coma
		*/
		public function doAutores($lista_autores){
			$autores = explode('|',$lista_autores);
			$return='';
			foreach($autores as $autor){
				$return.= trim($autor) . ", ";
			}
			$return = trim ($return,", ");
			return $return;
		}
		
		/*! \fn truncateCatalog()
			\brief truncateCatalog limpia el archivo de base de datos de salida
		*/
		public  function truncateCatalog(){
			$this->conn->beginTransaction();
			try{
				$this->conn->exec("DELETE FROM titulos");
                                $this->conn->exec("DELETE FROM titulos_materias");
                                $this->conn->exec("ALTER TABLE titulos AUTO_INCREMENT=1");
				$this->conn->commit();
				$this->status = true;
			}catch(PDOException $e){
				$this->conn->rollback();
				$this->status = false;
			}
			return $this->status;
		}
		
		/*! \fn storeCatalog()
			\brief storeCatalog alamcena la matriz catalog en la base de datos de salida
		*/
		public  function storeCatalog(){
			
			try{
				$editorial=1;
                                $estado=1;
                                foreach ($this->catalog as $row){
                                        $this->conn->beginTransaction();
					$query= "INSERT INTO titulos(isbn13,titulo,link_detalle,link_imagen,autores, id_editoriales, fecha_pub, link_indice,link_resenya, precio, paginas, estado )
								VALUES (:isbn13, :titulo, :link_detalle, :link_imagen, :autores,  :id_editoriales, :fecha_pub, :link_indice, :link_resenya, :precio, :paginas, :estado )";
					$conn_prepare = $this->conn->prepare($query);
                                        $conn_prepare->bindParam(':isbn13',$row['isbn13'], PDO::PARAM_STR);
					$conn_prepare->bindParam(':titulo',$row['titulo'], PDO::PARAM_STR);
                                        $conn_prepare->bindParam(':link_detalle',$row['link_detalle'], PDO::PARAM_STR);
                                        $conn_prepare->bindParam(':link_imagen',$row['link_imagen'], PDO::PARAM_STR);
					$conn_prepare->bindParam(':autores',$row['autor'], PDO::PARAM_STR);
                                        $conn_prepare->bindParam(':id_editoriales',$editorial, PDO::PARAM_INT);
                                        $conn_prepare->bindParam(':fecha_pub',$row['fecha_pub'], PDO::PARAM_STR);
					$conn_prepare->bindParam(':link_indice',$row['link_indice'], PDO::PARAM_STR);
					$conn_prepare->bindParam(':link_resenya',$row['link_resenya'], PDO::PARAM_STR);
					$conn_prepare->bindParam(':precio',$row['precio'], PDO::PARAM_INT);
					$conn_prepare->bindParam(':paginas',$row['paginas'], PDO::PARAM_INT);
					$conn_prepare->bindParam(':estado',$estado, PDO::PARAM_INT);
					
					$conn_prepare->execute();
					$last_id = $this->conn->lastInsertId('id_titulos');
                                        $this->conn->commit();
                                        
					$this->storeTitulosMaterias($last_id,$row['materia']);/*!< Almacenamos la relacion de los titulos creados con sus respectivas materias */

				}
				
				$this->status=true;
			}catch(Exception $e){
				$this->error_log.="<h4>Store Catalog: </h4>".$e->getMessage();
                                $this->nerror_log++;
				$this->status = false;
				$this->conn->rollback();
			}
			return $this->status;
		}
		
		/*! \fn storeMateria()
			\brief storeMateria crea la relacion entre el titulo a crear y la materia a la que pertenece.
			\param $isbn Codigo del libro
			\param $materias es una cadena de caracteres que contiene los codigos de materias separados por "|"
		*/
		public function storeTitulosMaterias($id_titulos, $materias){
			$materias = explode('|',trim(trim($materias),'|'));
			foreach($materias as $materia){
                            try{
                                
				$materia = (trim($materia));
				if(strlen($materia)>0){
                                        $this->conn->beginTransaction();
					$query = "INSERT INTO titulos_materias (id_materias,id_titulos) VALUES (:id_materias,:id_titulos)";
					$conn_prepare = $this->conn->prepare($query);
					$conn_prepare->bindParam(':id_materias',$materia, PDO::PARAM_STR);
					$conn_prepare->bindParam(':id_titulos',$id_titulos, PDO::PARAM_INT);
					$conn_prepare->execute();
                                        $this->conn->commit();
				}
                                
                            }catch(PDOException $e){
                                $this->error_log.="<h4>Store Titulos_materias: </h4>".$e->getMessage();
                                $this->nerror_log++;
                                $this->conn->rollback();
                            }
			}
			
		}
	}
?>