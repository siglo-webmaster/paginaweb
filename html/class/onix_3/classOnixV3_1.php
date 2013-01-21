<?php
class classOnixV3 {
    
    public $xml;
    public $conn;
    public $status;
    public $categorias;
    
    function __construct(){
        $param = $this->getInput();
        if($param){
            $file = $this->fileRequest($param);
            if(!$file){exit(1);}
            
            $this->xml = simplexml_load_string ($file);
            
        }else{ exit(0);
            try{
                $this->xml = simplexml_load_file(_ONIXFILE);
                //$xml->Header->SentDateTime
            }catch(Exception $e){
                echo $e->getMessage();
                $this->status = false;
            }
        }
        
        try{
            $this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->status=true;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        
        $this->porcesarXml();
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
            }else{
                $f = rtrim($f,_PIEONIX);
                $f = _CABECERAONIX.$f._PIEONIX;
            }
            
        }catch (Exception $e){
            echo $e->getMessage();
        }
        return $f;
    }
    
    function porcesarXml(){
        foreach($this->xml->Product as $producto){
          try{
              $materias = $this->comprobarMaterias($producto);
              if(!is_array($materias)){
                 
                 continue;
              }
              $editoriales = $this->comprobarEditoriales($producto);
              if(!is_array($editoriales)){
                 continue;
              }
              $estado = 1;
              $detalle = '';
              
              
              
              $this->conn->beginTransaction();
              $query = "INSERT INTO titulos (isbn13, codigo_proveedor, titulo, link_detalle, link_imagen, autores, id_editoriales, fecha_pub, link_indice, link_resenya, precio, paginas, estado) ". 
                  " VALUES (:isbn13, :codigo_proveedor, :titulo, :link_detalle, :link_imagen, :autores, :id_editoriales, :fecha_pub, :link_indice, :link_resenya, :precio, :paginas, :estado)";
              $conn_prepare = $this->conn->prepare($query);
              $conn_prepare->bindParam(':isbn13', $producto->ProductIdentifier->IDValue);
              $conn_prepare->bindParam(':codigo_proveedor', $producto->RecordReference);
              $conn_prepare->bindParam(':titulo', utf8_decode(strip_tags($producto->DescriptiveDetail->TitleDetail->TitleElement->TitleText)));
              $conn_prepare->bindParam(':link_detalle', $detalle);
              $conn_prepare->bindParam(':link_imagen', $producto->CollateralDetail->SupportingResource->ResourceVersion->ResourceLink);
              $conn_prepare->bindParam(':autores', utf8_decode(strip_tags($producto->DescriptiveDetail->Contributor->PersonName)));
              $conn_prepare->bindParam(':id_editoriales', $editoriales[0]);
              $conn_prepare->bindParam(':fecha_pub', $producto->PublishingDetail->PublishingDate->Date);
              $conn_prepare->bindParam(':link_indice', $detalle);
              $conn_prepare->bindParam(':link_resenya', utf8_decode(strip_tags($producto->CollateralDetail->TextContent->Text,'')));
              $conn_prepare->bindParam(':precio', $producto->ProductSupply->SupplyDetail->Price->PriceAmount);
              $conn_prepare->bindParam(':paginas', $producto->ContentDetail->ContentItem->TextItem->NumberOfPages);
              $conn_prepare->bindParam(':estado', $estado);
              
              $conn_prepare->execute();
              $last_id = $this->conn->lastInsertId('id_titulos');
              $this->conn->commit(); 
              
              $this->storeTitulosMaterias($last_id,$materias);

           }catch (PDOException $e){
                    echo $e->getMessage();
           }
          
        }
   
    }
    
    function comprobarMaterias($producto){
        $array_materias = array();
        foreach($producto->DescriptiveDetail->Subject as $materia){
           
            if(isset($materia->MainSubject)){ //Categoria principal
                $materia = strip_tags($materia->SubjectHeadingText);   
            }else{
                $materia = strip_tags($materia->SubjectHeadingText);
            }
            
            $materia = utf8_decode(trim($materia)) ;
            
            if($materia==''){
                echo "Materia Vacia";
                return false;
            }
            try{
                $query = "select id_materias from materias where nombre = :materia ";

                    $conn_prepare=$this->conn->prepare($query);
                    $conn_prepare->bindParam(':materia', $materia,PDO::PARAM_STR);
                    $conn_prepare->execute();
                    $temp = $conn_prepare->fetchAll();
                    if(sizeof($temp)>0){
                        $array_materias[] = $temp[0]['id_materias'];
                        

                    }else{
                        $this->conn->beginTransaction();

                    $conn_prepare = $this->conn->prepare("insert into materias (id_materias, nombre) values (:id_materias,:materia)");
                    $id_materias = rand(0000,9999).substr($materia, 0, 10);
                    $conn_prepare->bindParam(':id_materias', $id_materias,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':materia', $materia,PDO::PARAM_STR);
                    $conn_prepare->execute();
                    $array_materias[] = $this->conn->lastInsertId('id_materias');
                    
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
           
            $editorial2 = trim(utf8_decode($editorial));
            
            if($editorial2==''){
                echo "Editorial Vacio";
                return false;
            }
            try{
                    $query = "select distinct * from editoriales where nombre  LIKE :editorial ";

                    $conn_prepare=$this->conn->prepare($query);
                    $conn_prepare->bindParam(':editorial', $editorial2,PDO::PARAM_STR);
                    $conn_prepare->execute();
                    $temp = $conn_prepare->fetchAll();

                    if(sizeof($temp)>0){
                        $array_editoriales[] = $temp[0]['id_editoriales'];
                        
                    }else{
                        $this->conn->beginTransaction();

                        $conn_prepare = $this->conn->prepare("insert into editoriales (nombre) values (:nombre)");
                        $conn_prepare->bindParam(':nombre', $editorial2,PDO::PARAM_STR);
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
        public function storeTitulosMaterias($id_titulos, $materias){
                
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
