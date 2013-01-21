<?php
class classSHEV2 {
    
    public $array;
    public $conn;
    public $status;
    public $categorias;
    public $registros;
    
    function __construct(){
        $param = $this->getInput();
        if($param){
            $file = $this->fileRequest($param);
            if(!$file){exit(1);}
            $this->obtenerRegistros($file);
        }else{ exit(0);}
        
        try{
            $this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->status=true;
            
            $query = "select * from categorias where nombre_key is null";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->execute();
            $categorias = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
            if(sizeof($categorias)>0){
                echo "\nCreando llaves de categorias ";
                foreach($categorias as $row){
                    echo ".";
                    $nombre_key = strtolower(ereg_replace("[^A-Za-z0-9]", "",$row['nombre']));
                    $query = "update categorias set nombre_key='$nombre_key' where id_categorias='".$row['id_categorias']."'";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->execute();
                }
                echo "\nllaves de categorias creadas\n";
            }
            
            
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        echo "\nIniciando Creacion de Registros\n";
        
        $i=0;
        foreach($this->registros as $reg){
            echo "\n$i. ";
            $i++;
            $this->crearArray($reg);
            $this->procesarArray();
        }
        echo "\n\nRegistros procesados:".$i."\n\n";
        exit(0);
        $this->correcciones();
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
            }
            
        }catch (Exception $e){
            echo $e->getMessage();
        }
        return $f;
    }
    
    function obtenerRegistros($file){
        $file = explode('#@#',$file);
        foreach($file as $row){
            $row = trim($row);
            if($row!=''){
                $this->registros[]=$row;
            }
        }
    }
    
    
    function crearArray($file){
        unset ($this->array);
        $campos_key =array("codigo","codigoweb","isbn","titulo","autores","edicion","abstract","paginas","numero_edicion",
                            "numero","editoriales","coleccion","categoria","subcategoria","precio",
                            "moneda","fecha","idbarras","peso","caratula","formato","iva","temas","tipo","tipo_producto");
        
        $file = explode('~',$file);

        for ($i=0;$i<sizeof($campos_key);$i++){
            if(isset($file[$i])){
                $valor = trim($file[$i],'"');
                if($valor!=''){
                    $campo[$campos_key[$i]]= utf8_encode($valor);
                }else{
                    $campo[$campos_key[$i]]='';
                }
            }else{
                $campo[$campos_key[$i]]='';
            }
            
        }
        
        ///PROCESAR LLAVES ISBN
        if(isset($campo['isbn'])){
            $campo['isbn'] = ereg_replace("[^0-9]", "",$campo['isbn']);
        }else{
            $campo['isbn'] = '';
        }
        
        //PROCESAR Precio
        $campo['precio'] = (int)$campo['precio'];
        
        
        //PROCESAR IMAGEN
        $campo['link_imagen']='images/caratulasSHE/'.strtoupper($campo['codigo']).'_g.jpg';
        
        //procesar titulo
        if(isset($campo['titulo'])){
            $campo['titulo']=utf8_encode($campo['titulo']);
        }
        
        ///PROCESAR FECHAS
        $campo['fecha'] = explode(" ",$campo['fecha']);
        $campo['fecha'] = mb_substr($campo['fecha'][0], 0, 10);
        
        
        $temp=explode("/",trim($campo['fecha']));
        if(isset($temp[1])){
            if(isset($temp[2])){
                $campo['fecha'] = $temp[2]."-".$temp[1]."-".$temp[0];
            }else{
                $campo['fecha'] = $temp[0]."-1-1";
            }
        }else{
            $campo['fecha'] = $temp[0]."-1-1";
        }
        
        
        ////PROCESAR CAPO DE AUTORES
        
        
        if(isset($campo['autores'])){
            $temp = explode('|',$campo['autores']);
            unset($campo['autores']);
            foreach($temp as $autor){
                $autor = trim($autor,'"');
                if($autor!=''){
                    $campo['autores'][]=utf8_encode($autor);
                }
            }
        }else{
            $campo['autores'] = array();
        }
        
        ////PROCESAR CAPO DE EDITORIALES
        
        
        if(isset($campo['editoriales'])){
            $temp = explode('|',$campo['editoriales']);
            unset($campo['editoriales']);
            foreach($temp as $editorial){
                $editorial = trim($editorial,'"');
                if($editorial!=''){
                    $campo['editoriales'][]=utf8_encode($editorial);
                }
                
            }
        }
        
        ////PROCESAR CAPO DE TEMAS
        
        
        if(isset($campo['temas'])){
            $temp = explode('|',$campo['temas']);
            unset($campo['temas']);
            foreach($temp as $tema){
                $tema = trim($tema,'"');
                if($tema!=''){
                    $campo['temas'][]=utf8_encode($tema);
                }
                
            }
        }
        
        
        //PROCESAR CAMPOS CATEGORIAS Y SUBCATEGORIAS
        if(isset($campo['categoria'])){
            $campo['categorias']=array(utf8_encode($campo['categoria']));
            unset($campo['categoria']);
        }
        if(isset($campo['subcategoria'])){
            array_push($campo['categorias'],utf8_encode($campo['subcategoria']));
            unset($campo['subcategoria']);
        }
        
        
        $this->array[] = $campo;
        return;
    }

    
    function procesarArray(){
        foreach($this->array as $producto){
          try{
              echo "Procesando ". $producto['codigo']."    ";
              $materias = $this->comprobarCategoriasProveedores($producto); //OK
              if(!is_array($materias)){
                 continue;
              }
              echo ".";
              $editoriales = $this->comprobarEditoriales($producto);
              if(!is_array($editoriales)){
                 continue;
              }
              echo ".";
              $autores = $this->comprobarAutores($producto);
              echo ".";
 
              $estado = "activo";
              $id_proveedores = 1;
              
              
              switch($producto['tipo_producto']){
                  case '0':{
                      $id_tipos_productos = 1;
                      $id_lista_precios = 1;
                      break;
                  }
                  case '1':{
                      $id_tipos_productos = 4;
                      $id_lista_precios = 1;
                      break;
                  }
              }
              
              $titulo = utf8_decode(strip_tags($producto['titulo']));
              $titulo_key =  ereg_replace("[^A-Za-z0-9]", "",$titulo);
              $isbn13 = ereg_replace("[^A-Za-z0-9]", "",$producto['isbn']);
              
              $this->conn->beginTransaction();
              
              ////COMPROBAR SI EL PRODUCTO YA EXISTE !!
              
              $query = "SELECT * FROM titulos_proveedores WHERE id_proveedores = :id_proveedores and codigo= :codigo and titulo = :titulo and isbn = :isbn";
              $conn_prepare = $this->conn->prepare($query);
              $conn_prepare->bindParam(':id_proveedores', $id_proveedores,PDO::PARAM_INT);
              $conn_prepare->bindParam(':isbn', $isbn13,PDO::PARAM_STR);
              $conn_prepare->bindParam(':codigo', $producto['codigo'],PDO::PARAM_STR);
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
                    $conn_prepare->bindParam(':codigo', $producto['codigo'],PDO::PARAM_STR);
                    $conn_prepare->bindParam(':titulo', $titulo_key,PDO::PARAM_STR);
                    $conn_prepare->execute();

                }
                echo ".";
              //// FIN COMPROBAR SI EL TITULO YA EXISTE
                
              $key_val = array('isbn13'=>$isbn13,
                                'titulo'=>$titulo,
                                'link_imagen'=>$producto['link_imagen'],
                                'fecha_pub'=>$producto['edicion'],
                                'resenya'=>utf8_decode(strip_tags($producto['abstract'],'')),
                                'paginas'=>$producto['paginas'],
                                'codigoweb'=>$producto['codigoweb'],
                                'caratula'=>$producto['caratula'],
                                'formato'=>$producto['formato'],
                                'coleccion'=>$producto['coleccion'],
                                'peso'=>$producto['peso']
                  );
              
              foreach($key_val as $llave=>$valor){
                  
                    $query = "INSERT INTO titulos_atributos (id_titulos, llave, valor) values (:id_titulos, :llave, :valor)";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_titulos', $last_id,PDO::PARAM_INT);
                    $conn_prepare->bindParam(':llave', $llave,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':valor', $valor,PDO::PARAM_STR);
                    $conn_prepare->execute();
              }
              echo ".";
              
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
              echo ".";
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
              
              echo ".";
              
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
                    $conn_prepare->bindParam(':precio', $producto['precio'], PDO::PARAM_INT);
                    $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                    $conn_prepare->execute();

                }else{

                    $query = "insert into titulos_lista_precios (id_titulos, id_lista_precios, id_proveedores, id_tipos_productos, precio, estado ) values (:id_titulos, :id_lista_precios, :id_proveedores, :id_tipos_productos, :precio, :estado )";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                    $conn_prepare->bindParam(':precio', $producto['precio'], PDO::PARAM_INT);
                    $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                    $conn_prepare->execute();
                }

              //// ACTUALIZAR LAS OTRAS LISTAS DE PRECIOS POR MONEDA
                
                echo ".";
                
                /// LISTA EN EUROS
                $id_lista_precios =  2 ; 
                $id_moneda = 2;
                $query = "delete from titulos_lista_precios where id_titulos = :id_titulos and id_proveedores = :id_proveedores and id_tipos_productos = :id_tipos_productos and id_lista_precios =:id_lista_precios";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->execute();
                echo ".";
                $query = "insert into titulos_lista_precios (id_titulos, id_lista_precios, id_proveedores, id_tipos_productos, precio, estado ) select :id_titulos, :id_lista_precios, :id_proveedores, :id_tipos_productos, (". $producto['precio']."/m.tasa_actual), :estado   from monedas as m where m.id_moneda=:id_moneda";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_moneda', $id_moneda, PDO::PARAM_INT);
                $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                $conn_prepare->execute();
                
                //FIN LISTA EN PESOS
                echo ".";
                /// LISTA EN DOLARES 
                $id_lista_precios =  3 ; 
                $id_moneda = 3;
                $query = "delete from titulos_lista_precios where id_titulos = :id_titulos and id_proveedores = :id_proveedores and id_tipos_productos = :id_tipos_productos and id_lista_precios =:id_lista_precios";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->execute();
                echo ".";
                $query = "insert into titulos_lista_precios (id_titulos, id_lista_precios, id_proveedores, id_tipos_productos, precio, estado ) select :id_titulos, :id_lista_precios, :id_proveedores, :id_tipos_productos, (".$producto['precio']."/m.tasa_actual), :estado   from monedas as m where m.id_moneda=:id_moneda";
                $conn_prepare = $this->conn->prepare($query);
                $conn_prepare->bindParam(':id_titulos', $last_id, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_lista_precios', $id_lista_precios, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_proveedores', $id_proveedores, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_tipos_productos', $id_tipos_productos, PDO::PARAM_INT);
                $conn_prepare->bindParam(':id_moneda', $id_moneda, PDO::PARAM_INT);
                $conn_prepare->bindParam(':estado', $estado, PDO::PARAM_INT);
                $conn_prepare->execute();
                
                //FIN LISTA EN DOLARES
                
                echo ".";
                /// FIN ACTUALIZAR LAS OTRAS LISTAS DE PRECIOS POR MONEDA
              
              ///// FIN LISTAS DE PRECIOS
              
                ////INGRESAR EL TITULO EN LAS CATEGORIAS RESPECTIVAS
              $producto['id_titulos']=$last_id;
              echo '[';
              $this->storeTitulosCategorias($producto);
              echo "].";
              $this->conn->commit(); 
              
              $this->storeTitulosCatPro($last_id,$materias);
              echo ".";
              
              
              echo " OK";
              //$this->storeTitulosAutores($last_id,$autores);

           }catch (PDOException $e){
                    echo $e->getMessage();
                    $this->conn->rollBack();
           }
          
        }
   
    }
    
    function comprobarAutores($producto){
        
        $array_autores = array();
        if(!isset($producto['autores'])){
            return false;
        }
        if(!is_array($producto['autores'])){
            return false;
        }
        foreach($producto['autores'] as $contributor){
           
            $autor = trim(utf8_decode($contributor));
            $autor_key = strtolower(ereg_replace("[^A-Za-z0-9]", "",$autor));
            
            if($autor==''){
                echo "Autor Vacio";
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
        $id_proveedores = 1;
        
        
        foreach($producto['categorias'] as $materia){
           
            
           $materia = strip_tags($materia);   
            $materia = utf8_decode(trim($materia)) ;
            $codigo = ereg_replace("[^A-Za-z0-9]", "",$materia);
            if($materia==''){
                echo "\n".$producto['codigo']." Materia Vacia";
                
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
        if(!isset($producto['editoriales'] )){
            echo "\n".$producto['codigo']. " Editoriales no definido\n";
            return false;
        }
        foreach($producto['editoriales'] as $editorial){
           
            $editorial2 = strtolower(trim(utf8_decode($editorial)));
            $editorial2_key = ereg_replace("[^a-z0-9]", "",$editorial2);
            
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
    
            
        function storeTitulosCategorias($producto){
            
            foreach($producto['categorias'] as $categoria){
                
                $nombre_key=strtolower(ereg_replace("[^A-Za-z0-9]","",$categoria));
                $query = "select tc.* from titulos_categorias as tc 
                            inner join categorias as c on c.id_categorias=tc.id_categorias
                            where c.nombre_key='".$nombre_key."' and tc.id_titulos=:id_titulos";
                $conn_prepare = $this->conn->prepare($query);
                
                $conn_prepare->bindParam(':id_titulos', $producto['id_titulos'], PDO::PARAM_INT);
                $conn_prepare->execute();
                $temp = $conn_prepare->fetchAll();
                if(sizeof($temp)>0){
                    echo " already in ";
                }else{
                    
                    $query = "select c.id_categorias from categorias as c 
                            where c.nombre_key='".$nombre_key."'";
                    
                    $conn_prepare = $this->conn->prepare($query);
                    
                    $conn_prepare->execute();
                    $id_categorias = $conn_prepare->fetchAll();
                    if(sizeof($id_categorias)>0){
                        $query="insert into titulos_categorias(id_titulos,id_categorias) values(:id_titulos,:id_categorias)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_titulos',$producto['id_titulos'],PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_categorias',$id_categorias[0]['id_categorias'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                        echo " strored ";
                    }else{ 
                        echo " *Error: not found: " .$nombre_key ;
                        
                    }
                    
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
