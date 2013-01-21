<?php
class classOnixV3 {
    
    public $xml;
    public $conn;
    public $status;
    public $categorias;
    
    function __construct(){
        $param = $this->getInput();
        echo "\n***** \t$param \t*****";
        if($param){
            $file = $this->fileRequest($param);
            if(!$file){
                echo "\nERROR DE CARGA [".__LINE__."]: no file found -> ".$param;
                sleep(60);
                exit(1);
                
                }
                
            try{
                
                $this->xml = simplexml_load_string ($file);
                
            }catch(ErrorException $e){
                echo $e->getMessage();
                exit(0);
            }
            
            if($this->xml == false){
                echo "\nERROR DE CARGA [".__LINE__."]: xml == false ";
                sleep(10);
                exit(0);
            }
            
        }else{
            echo "\nERROR DE CARGA [".__LINE__."]: no param";
            sleep(60);
             exit(0);
        }
        
        try{
            $this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->status=true;
        }catch (PDOException $e){
            echo $e->getMessage();
            echo "\nERROR DE CARGA [".__LINE__."]: no detabase connect";
            sleep(60);
            exit(0);
        }
        
        $this->procesarXml();
         exit(0);
        
    }
    
    function getInput() {
        $fr = fopen("php://stdin", "r");
        $input = '';
        while (!feof ($fr)) {
            $input .= fgets($fr);
        }
        fclose($fr);
        $input = trim($input);
        return (sizeof($input)>0)?$input:false;
    }
    
    function fileRequest($file){
        $f = false;
        try{
            $f = file_get_contents($file);
            if(!$f){
                echo "archivo no encontrado";
            }else{
                $f = rtrim($f,_PIEONIX);
                $f = _CABECERAONIX.$f._PIEONIX;
            }
            
        }catch (Exception $e){
            echo $e->getMessage();
        }
        return $f;
    }
    
    function alertar(){
        echo "\n";
        for($i=0;$i<10;$i++){
            echo '*';
        }
        echo "\nAlerta\n";
        for($i=0;$i<10;$i++){
            echo '*';
        }
         echo "\n";
         sleep(120);
    }
    
    function procesarXml(){
        foreach($this->xml->Product as $producto){
           //  echo "\n".$producto->NotificationType."-> ".$producto->DescriptiveDetail->TitleDetail->TitleElement->TitleText;
            switch($producto->NotificationType){
                case '01':{//Early notification: Use for a complete record issued earlier than approximately six months before publication.
                    echo "\nEarly notification Not proceced\n";
                    return 0;
                    break;   
                }
                case '02':{//Advance notification (confirmed): Use for a complete record issued to confirm advance information 
                              //approximately six months before publication; or for a complete record issued after that date 
                              //and before information has been confirmed from the book-in-hand. 
                    echo "\nAdvance notification Not proceced\n";
                    return 0;
                    break;   
                }
                case '03':{//Notification confirmed on publication: 	Use for a complete record issued to confirm advance 
                              //information at or just before actual publication date; or for a complete record 
                              //issued at any later date. 
                             
                              $this->crear_actualizarProducto($producto);
                            
                 break;   
                }
                case '04':{//Update (partial): In ONIX 3.0 only, use when sending a ‘block update’ record. 
                              //In previous ONIX releases, ONIX updating has generally been by complete record
                              //replacement using code 03, and code 04 is not used. 
                             // $this->crear_actualizarProducto($producto);
                             echo "\n[ Update Parcial requerido]\n";
                             $this->alertar();
                             return 0;
                             
                 break;   
                }
                case '05':{//Delete: 	Use when sending an instruction to delete a record which was previously issued.
                              // Note that a Delete instruction should NOT be used when a product is cancelled, 
                              // put out of print, or otherwise withdrawn from sale: 
                              // this should be handled as a change of Publishing status, 
                              //leaving the receiver to decide whether to retain or delete the record. 
                              //A Delete instruction is only used when there is a particular reason
                              //to withdraw a record completely, eg because it was issued in error. 
                              echo "\n [Borrado requerido]\n";
                              $this->alertar();
                              return 0;
                 break;   
                }
                case '08':{//Notice of sale: 	Notice of sale of a product, from one publisher to another: 
                              //sent by the publisher disposing of the product.
                 break;   
                }
                case '09':{//Notice of acquisition: 	Notice of acquisition of a product, 
                              //by one publisher from another: sent by the acquiring publisher.
                 break;   
                }

                default:{
                    
                    echo "\nERROR DE CARGA [".__LINE__."]: Accion no definida".$producto->NotificationType;
                    sleep(10);
                    return 0;
                }
            }
          
        }
        
   
    }
    
    function crear_actualizarProducto($producto){
        try{
              
              $materias = $this->comprobarCategoriasProveedores($producto); //OK
              if(!is_array($materias)){
                 echo "\nADVERTENCA DE CARGA [".__LINE__."]: fallo comprobarCategoriasProveedores 
                     El item no quedara asociado a una materia o tema en particular.\n";
                  
                 
              }
              
              $editoriales = $this->comprobarEditoriales($producto);
              if(!is_array($editoriales)){
                  echo "\nERROR DE CARGA [".__LINE__."]: fallo comprobarEditoriales";
                  sleep(60);
                 return 0;
              }
              
              $autores = $this->comprobarAutores($producto);
              if(!is_array($autores)){
                   echo "\nADVERTENCA DE CARGA [".__LINE__."]: fallo comprobarAutores 
                     El item no quedara asociado a un autor.\n";
              }
              
              /*TIPO DE PRODUCTO*/
              switch($producto->DescriptiveDetail->ProductForm){
                  case 'BA':
                  case 'BB':
                  case 'BC':
                  case 'BD':
                  case 'BE':
                  case 'BF':
                  case 'BG':
                  case 'BH':
                  case 'BI':
                  case 'BJ':
                  case 'BK':
                  case 'BL':
                  case 'BM':
                  case 'BN':
                  case 'BO':
                  case 'BP':
                  case 'BZ':
                  {//LIBRO IMPRESO (PDO)
                      $id_tipos_productos = 3;
                      break;
                  }
                  case 'ED':{//LIBRO ELECTRONICO
                      $id_tipos_productos = 2;
                      break;
                  }
                  case 'BN':{
                      echo "\n\nADVERTENCIA DE CARGA: [".__LINE__."] Tipo de producto PArt-work (Fasiculo) no sera cargado . Cod:".$producto->DescriptiveDetail->ProductForm."\n";
                      exit(0);
                      break;
                  }
                  default :{
                      echo "\n\nERROR DE CARGA: [".__LINE__."] Tipo de producto no reconocido ->".$producto->DescriptiveDetail->ProductForm."\n";
                      sleep(1000);
                      exit(0);
                  }
              }
              
              
              /*FIN TIPO DE PRODUCTO*/
              
              /*OBTENER ISBN O ISSN*/
              $isbn13 = false;
              foreach($producto->ProductIdentifier as $identificador){
                  switch($identificador->ProductIDType){
                      case '01':{
                          break;
                      }
                      case '15':{
                          $isbn13 = preg_replace("[^A-Za-z0-9]", "",$identificador->IDValue);
                          echo " ".$producto->RecordReference ." -> ".$identificador->IDValue;
                          break;
                      }
                      default:{
                        echo "\n\nERROR DE CARGA: [".__LINE__."] Tipo de identificador no reconocido ->".$identificador->ProductIDType."\n";
                        sleep(5);
                        
                    }
                  }
                  
              }
              
              if($isbn13==false){
                  exit(0);
              }
              /*FIN ISBN O  ISSN*/
              
              
              $estado = "activo";
              
              
              
              $id_proveedores = 2;
              $id_lista_precios = 5;
              $recordReference = $producto->RecordReference;
              $titulo = utf8_decode(strip_tags($producto->DescriptiveDetail->TitleDetail->TitleElement->TitleText));
              $titulo_key =  preg_replace("[^A-Za-z0-9]", "",$titulo);
              
              
              $this->conn->beginTransaction();
              
              ////COMPROBAR SI EL PRODUCTO YA EXISTE !!
              
              $query = "SELECT * FROM titulos_proveedores WHERE id_proveedores = :id_proveedores and codigo= :codigo and titulo = :titulo and isbn = :isbn";
              $conn_prepare = $this->conn->prepare($query);
              $conn_prepare->bindParam(':id_proveedores', $id_proveedores,PDO::PARAM_INT);
              $conn_prepare->bindParam(':isbn', $isbn13,PDO::PARAM_STR);
              $conn_prepare->bindParam(':codigo', $recordReference,PDO::PARAM_STR);
              $conn_prepare->bindParam(':titulo', $titulo_key,PDO::PARAM_STR);
              $conn_prepare->execute();
              $temp = $conn_prepare->fetchAll();
              if(sizeof($temp)>0){
                    $last_id = $temp[0]['id_titulos'];
                    $query = "DELETE FROM titulos_atributos WHERE id_titulos =:id_titulos";
                    $conn_prepare =$this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_titulos',$last_id,PDO::PARAM_INT);
                    $conn_prepare->execute();

              }else{
                    
                    $query = "INSERT INTO titulos (estado) values(:estado)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':estado', $estado);
                    $conn_prepare->execute();
                    $last_id = $this->conn->lastInsertId('id_titulos');
                    
                    $query = "INSERT INTO titulos_proveedores (id_proveedores, id_titulos, isbn, codigo, titulo) value (:id_proveedores, :id_titulos, :isbn, :codigo, :titulo)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_proveedores', $id_proveedores,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_titulos', $last_id,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':isbn', $isbn13,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':codigo', $recordReference,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':titulo', $titulo_key,PDO::PARAM_STR);
                    $conn_prepare->execute();

                }

              //// FIN COMPROBAR SI EL TITULO YA EXISTE
              
              $key_val = array('isbn13'=>$isbn13,
                                'titulo'=>$titulo,
                                'link_imagen'=>$producto->CollateralDetail->SupportingResource->ResourceVersion->ResourceLink,
                                'fecha_pub'=>$producto->PublishingDetail->PublishingDate->Date,
                                'resenya'=>utf8_decode(strip_tags($producto->CollateralDetail->TextContent->Text,'')),
                                'paginas'=>$producto->ContentDetail->ContentItem->TextItem->NumberOfPages,
                                'xml'=>$this->xml->asXML()
                  );
              
              foreach($key_val as $llave=>$valor){
                  
                    $query = "INSERT INTO titulos_atributos (id_titulos, llave, valor) values (:id_titulos, :llave, :valor)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_titulos', $last_id,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':llave', $llave,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':valor', $valor,PDO::PARAM_STR);
                    $conn_prepare->execute();
              }
             
              
              /////RELACION TITULOS EDITORIALES
              
              $id_colecciones ='';
              
              foreach($editoriales as $editorial){
                  
                  $query = "select * from titulos_editoriales where id_editoriales = :id_editoriales  and id_titulos = :id_titulos";
                  $conn_prepare = $this->conn->prepare($query);
                  $conn_prepare->bindParam(':id_editoriales', $editorial, PDO::PARAM_INT);
                  $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                  $conn_prepare->execute();
                  
                  $temp = $conn_prepare->fetchAll();

                  if(sizeof($temp)>0){
                      
                  }else{
                      
                        $query = "insert into titulos_editoriales (id_editoriales, id_titulos, id_colecciones) values (:id_editoriales, :id_titulos, :id_colecciones)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_editoriales', $editorial, PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_colecciones', $id_colecciones, PDO::PARAM_INT);
                        $conn_prepare->execute();
                      
                  }
                  
              }
              
              /// FIN RELACION TITULOS EDITORIALES
              
               /////RELACION TITULOS AUTORES
              
              if(is_array($autores)){
                  foreach($autores as $autor){   
                    $query = "select * from titulos_autores where id_autores = :id_autores  and id_titulos = :id_titulos";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_autores', $autor, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                    $conn_prepare->execute();

                    $temp = $conn_prepare->fetchAll();

                    if(sizeof($temp)>0){

                    }else{

                            $query = "insert into titulos_autores (id_autores, id_titulos) values (:id_autores, :id_titulos)";
                            $conn_prepare = $this->conn->prepare($query);
                            $conn_prepare->bindParam(':id_autores', $autor, PDO::PARAM_INT);
                            $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                            $conn_prepare->execute();
                    }

                }
              }
              
              
              
              /// FIN RELACION TITULOS AUTORES
              
              
              
              ///// LISTAS DE PRECIOS

                $query = "select * from titulos_lista_precios where id_titulos = :id_titulos and id_proveedores = :id_proveedores and id_tipos_productos = :id_tipos_productos and id_lista_precios =:id_lista_precios";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->execute();

                $temp = $conn_prepare->fetchAll();

                if(sizeof($temp)>0){
                    $query = "update titulos_lista_precios set precio = :precio, estado= :estado where id_titulos = :id_titulos and id_proveedores = :id_proveedores and id_tipos_productos = :id_tipos_productos and id_lista_precios =:id_lista_precios";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':precio', $producto->ProductSupply->SupplyDetail->Price->PriceAmount, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                    $conn_prepare->execute();

                }else{

                    $query = "insert into titulos_lista_precios (id_titulos, id_lista_precios, id_proveedores, id_tipos_productos, precio, estado ) values (:id_titulos, :id_lista_precios, :id_proveedores, :id_tipos_productos, :precio, :estado )";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':precio', $producto->ProductSupply->SupplyDetail->Price->PriceAmount, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                    $conn_prepare->execute();
                }

              //// ACTUALIZAR LAS OTRAS LISTAS DE PRECIOS POR MONEDA
                
                /// LISTA EN PESOS 
                $id_lista_precios =  4 ; //LISTA E-Books EN PESOS
                $id_moneda = 2;
                $query = "delete from titulos_lista_precios where id_titulos = :id_titulos and id_proveedores = :id_proveedores and id_tipos_productos = :id_tipos_productos and id_lista_precios =:id_lista_precios";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->execute();
                
                $query = "insert into titulos_lista_precios (id_titulos, id_lista_precios, id_proveedores, id_tipos_productos, precio, estado ) select :id_titulos, :id_lista_precios, :id_proveedores, :id_tipos_productos, (m.tasa_actual * ".$producto->ProductSupply->SupplyDetail->Price->PriceAmount."), :estado   from monedas as m where m.id_moneda=:id_moneda";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_moneda', $id_moneda, PDO::PARAM_INT);
                $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                $conn_prepare->execute();
                
                //FIN LISTA EN PESOS
                
                /// LISTA EN DOLARES 
                $id_lista_precios =  6 ; //LISTA E-Books EN PESOS
                $id_moneda = 2;
                $query = "delete from titulos_lista_precios where id_titulos = :id_titulos and id_proveedores = :id_proveedores and id_tipos_productos = :id_tipos_productos and id_lista_precios =:id_lista_precios";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->execute();
                
                $query = "insert into titulos_lista_precios (id_titulos, id_lista_precios, id_proveedores, id_tipos_productos, precio, estado ) select :id_titulos, :id_lista_precios, :id_proveedores, :id_tipos_productos, ((m2.tasa_actual / m1.tasa_actual) * ".$producto->ProductSupply->SupplyDetail->Price->PriceAmount."), :estado  from  monedas as m1 inner join monedas as m2 on m2.id_moneda = 2 where m1.id_moneda=3";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                 $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                $conn_prepare->execute();
                
                //FIN LISTA EN DOLARES
                
                
                /// FIN ACTUALIZAR LAS OTRAS LISTAS DE PRECIOS POR MONEDA
              
              ///// FIN LISTAS DE PRECIOS
                
                
                //ACTUALIZAR ULTIMA FECHA DE CARGA
                $date = date('Y-m-d h:i:s');
                $query = "update titulos set last_update=:date where id_titulos=:id_titulos";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_titulos', $last_id,PDO::PARAM_INT);
                $conn_prepare->bindParam(':date', $date,PDO::PARAM_STR);
                $conn_prepare->execute();
                //FIN ACTUALIZAR ULTIMA FECHA DE CARGA
              
              $this->conn->commit(); 
              if($materias!=false){
                  $this->storeTitulosCatPro($last_id,$materias);
              }
              
              
              
              //$this->storeTitulosAutores($last_id,$autores);

           }catch (PDOException $e){
                    echo $e->getMessage();
                    $this->conn->rollBack();
                    echo "\nERROR DE CARGA [".__LINE__."]: ROLLBACK";
                    sleep(200);
                    return(0);
           }
    }
    
    function comprobarAutores($producto){
        
        $array_autores = array();
        
        foreach($producto->DescriptiveDetail->Contributor as $contributor){
           
            $autor = trim(utf8_decode($contributor->PersonName));
            $autor_key = strtolower(preg_replace("[^A-Za-z0-9]", "",$autor));
            
            if($autor==''){
                echo "\nAutor Vacio";
                continue;
            }
            try{
                    $query = "select distinct * from autores where nombre_key  = :nombre_key ";

                    $conn_prepare=$this->conn->prepare($query);
                    $conn_prepare->bindParam(':nombre_key', $autor_key,PDO::PARAM_STR);
                    $conn_prepare->execute();
                    $temp = $conn_prepare->fetchAll();

                    if(sizeof($temp)>0){
                        $array_autores[] = $temp[0]['id_autores'];
                        
                    }else{
                        $this->conn->beginTransaction();
   
                        $conn_prepare = $this->conn->prepare("insert into autores (nombre,nombre_key) values ( :nombre, :nombre_key)");
                        $conn_prepare->bindParam(':nombre', $autor,PDO::PARAM_STR);
                        $conn_prepare->bindParam(':nombre_key', $autor_key,PDO::PARAM_STR);
                        $conn_prepare->execute();

                        $array_autores[] = $this->conn->lastInsertId('id_autores');

                        $this->conn->commit();

                    }
                    
                    return $array_autores;
                

            }catch (PDOException $e){

                echo $e->getMessage();
                $this->conn->rollBack();
                return false;

            }
        }
        
    }
    
    function comprobarCategoriasProveedores($producto){
        $array_materias = array();
        $id_proveedores = 3;
        $return = false;
        
        foreach($producto->DescriptiveDetail->Subject as $materia){
           switch($materia->SubjectSchemeIdentifier){
               case '12':{
                   try{
                       $query = "select * from bic_codelist where codigo=:codigo";
                       $conn_prepare = $this->conn->prepare($query);
                       $conn_prepare->bindParam(':codigo',$materia->SubjectCode,PDO::PARAM_STR);
                       $conn_prepare->execute();
                       $codigo = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                       if(!isset($codigo[0])){
                           echo "Codigo no encontrado en tabla bic_codelist : ".$materia->SubjectCode."\n";
                           sleep(10);
                           continue;
                       }else{
                           
                           $materia = $codigo[0]['descripcion'];
                       }
                   }catch(PDOException $e){
                       echo $e->getMessage();
                       echo "Codigo no encontrado en tabla bic_codelist\n";
                       sleep(60);
                       continue;
                   }
                   
                   break;
               }
               case '20':
               case '24':{
                    if(isset($materia->MainSubject)){ //Categoria principal
                        $materia = strip_tags($materia->SubjectHeadingText);   
                    }else{
                        $materia = strip_tags($materia->SubjectHeadingText);
                    }
                    break;   
               }
               default:{
                   echo "\nERROR DE CARGA [".__LINE__."]: ITEM CON CAMPOS DE CODIGO DE MATERIA NO RECONOCIDO: (".$materia->SubjectSchemeIdentifier.")\n Parada de emeregencia!!!!";
                   sleep(3600);
                   exit(1);
                   
               }
           }
            
            
            $materia = utf8_decode(trim($materia)) ;
            $codigo = preg_replace("[^A-Za-z0-9]", "",$materia);
            if($materia==''){
                echo "\nERROR DE CARGA [".__LINE__."]: ITEM CON CAMPOS DE MATERIA VACIA.
                    \El item no quedara asociado a una materia";
                continue;
            }
            try{
                $query = "select id_categorias_proveedores from categorias_proveedores where id_proveedores = :id_proveedores and codigo = :codigo ";

                    $conn_prepare=$this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_proveedores', $id_proveedores,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':codigo', $codigo,PDO::PARAM_STR);
                    $conn_prepare->execute();
                    $temp = $conn_prepare->fetchAll();
                    if(sizeof($temp)>0){
                        foreach($temp as $row){
                            $array_materias[]=$row['id_categorias_proveedores'];
                        }

                    }else{
                        $this->conn->beginTransaction();

                        $conn_prepare = $this->conn->prepare("insert into categorias_proveedores (id_proveedores, codigo, nombre) values (:id_proveedores, :codigo, :nombre)");
                        $id_materias = rand(0000,9999).substr($materia, 0, 10);
                        $conn_prepare->bindParam(':id_proveedores', $id_proveedores,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':codigo', $codigo,PDO::PARAM_STR);
                        $conn_prepare->bindParam(':nombre', $materia,PDO::PARAM_STR);
                        $conn_prepare->execute();
                        $array_materias[] = $this->conn->lastInsertId('id_categorias_proveedores');

                        $this->conn->commit();
                    
                    }
                
                    return $array_materias;
                

                 }catch (PDOException $e){

                echo $e->getMessage();
                $this->conn->rollBack();
                return false;

            }
        }
    }
    

    
     function comprobarEditoriales($producto){
        $array_editoriales = array();
        
        foreach($producto->PublishingDetail->Imprint->ImprintIdentifier->IDValue as $editorial){
           
            $editorial2 = strtolower(trim(utf8_decode($editorial)));
            $editorial2_key = preg_replace("[^a-z0-9]", "",$editorial2);
            
            if($editorial2==''){
                echo "Editorial Vacio";
                return false;
            }
            try{
                    $query = "select distinct * from editoriales where nombre_key  = :nombre_key ";

                    $conn_prepare=$this->conn->prepare($query);
                    $conn_prepare->bindParam(':nombre_key', $editorial2_key,PDO::PARAM_STR);
                    $conn_prepare->execute();
                    $temp = $conn_prepare->fetchAll();

                    if(sizeof($temp)>0){
                        $array_editoriales[] = $temp[0]['id_editoriales'];
                        
                    }else{
                        $this->conn->beginTransaction();
   
                        $conn_prepare = $this->conn->prepare("insert into editoriales (nombre,nombre_key,estado) values ( :nombre, :nombre_key, 'activo')");
                        $conn_prepare->bindParam(':nombre', $editorial2,PDO::PARAM_STR);
                        $conn_prepare->bindParam(':nombre_key', $editorial2_key,PDO::PARAM_STR);
                        $conn_prepare->execute();

                        $array_editoriales[] = $this->conn->lastInsertId('id_editoriales');

                        $this->conn->commit();

                    }
                    
                    return $array_editoriales;
                

            }catch (PDOException $e){

                echo $e->getMessage();
                $this->conn->rollBack();
                return false;

            }
        }
    }
    

    
        /*! \fn storeMateria()
                \brief storeMateria crea la relacion entre el titulo a crear y la materia a la que pertenece.
                \param $isbn Codigo del libro
                \param $materias es una cadena de caracteres que contiene los codigos de materias separados por "|"
        */
        public function storeTitulosCatPro($id_titulos, $materias){
                
                foreach($materias as $materia){
                    $this->conn->beginTransaction();
                    try{

                        $materia = (trim($materia));
                        if(strlen($materia)>0){
                                
                                $query = "SELECT * from titulos_cat_pro where id_categorias_proveedores =:id_categorias_proveedores and id_titulos= :id_titulos";
                                $conn_prepare = $this->conn->prepare($query);
                                $conn_prepare->bindParam(':id_categorias_proveedores',$materia, PDO::PARAM_STR);
                                $conn_prepare->bindParam(':id_titulos',$id_titulos, PDO::PARAM_INT);
                                $conn_prepare->execute();
                                $temp = $conn_prepare->fetchAll();
                                
                                if(sizeof($temp)>0){
                                    
                                }else{
                                    $query = "INSERT INTO titulos_cat_pro (id_categorias_proveedores,id_titulos) VALUES (:id_materias,:id_titulos)";
                                    $conn_prepare = $this->conn->prepare($query);
                                    $conn_prepare->bindParam(':id_materias',$materia, PDO::PARAM_STR);
                                    $conn_prepare->bindParam(':id_titulos',$id_titulos, PDO::PARAM_INT);
                                    $conn_prepare->execute();

                                }
                                
                        }
                        $this->conn->commit();

                    }catch(PDOException $e){
                        $this->error_log.="<h4>Store titulos_cat_pro: </h4>".$e->getMessage();
                        $this->nerror_log++;
                        $this->conn->rollback();
                    }
                }

        }
        
        
      function correcciones(){
          ////CORREGIR FECHAS EN CERO
            $this->conn->beginTransaction();
            $query = "UPDATE titulos set fecha_pub='2012-01-01' where fecha_pub='0000-00-00'";
            $conn_prepare = $this->conn->prepare($query);
            
            $conn_prepare->execute();
            $this->conn->commit();
            
            ////CORREGIR AUTORES VACIOS
            $this->conn->beginTransaction();
            $query = "UPDATE titulos set autores='Varios autores' where autores in('',null,'VV.AA','')";
            $conn_prepare = $this->conn->prepare($query);
            
            $conn_prepare->execute();
            $this->conn->commit();
          
      }
        

    
     
}
?>
