<?php
require_once('lib/dbConnection.php');

class classmodelSearchList extends dbConnection{
    
    function busquedaporTitulo($data){
            $this->data=false;
            if(strlen($data['searchString'])<1){
                return false;
            }

            $busqueda = explode(" " , $data['searchString']);
            $data['items_busqueda']=array();
            
            for($i=0;$i<sizeof($busqueda);$i++){
                if(!$this->palabrasaEliminar($busqueda[$i])){
                    $data['items_busqueda'][]=$busqueda[$i];
                }
            }
            
            if(!sizeof($data['items_busqueda'])>0){
                return false;
            }
            
            $filtro='';
                            
            foreach($data['items_busqueda'] as $titulo){

                $filtro.= "and tp.titulo like '%".preg_replace("/[^A-Za-z0-9]/", "",$titulo)."%' ";
            }
            $filtro = ltrim($filtro,'and');
            
            try{
                if($data['limit']==false){
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    where ta.llave='titulo' and ( $filtro )"; 

                    $conn_prepare = $this->conn->prepare($query);
                    
                }else{
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    where ta.llave='titulo' and ( $filtro ) 
                    limit :offset,:limit "; 

                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':limit',$data['limit'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':offset',$data['offset'],PDO::PARAM_INT);
                }
                
                $conn_prepare->execute();
                $this->data= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                ///CARGAR DATOS DE LOS TITULOS ENCONTRADOS
                $this->complementarDetallesResultadoBusqueda();
                
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
    }
    
    function complementarDetallesResultadoBusqueda(){
        if(sizeof($this->data)>0){
            
            for($i=0;$i<sizeof($this->data);$i++){
                //DATOS DE LOS AUTORES
                $query = "select a.nombre, a.id_autores from autores as a 
                inner join titulos_autores as ta on ta.id_autores=a.id_autores
                where ta.id_titulos='".$this->data[$i]['id_titulos']."'";
                $conn_prepare=$this->conn->prepare($query);
                $conn_prepare->execute();
                $autores = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                $this->data[$i]['autores']=(sizeof($autores)>0)?$autores:false;
                
                //DATOS DE EDITORIALES
                $query = "select e.nombre, e.id_editoriales from editoriales as e 
                inner join titulos_editoriales as te on te.id_editoriales=e.id_editoriales
                where te.id_titulos='".$this->data[$i]['id_titulos']."'";
                $conn_prepare=$this->conn->prepare($query);
                $conn_prepare->execute();
                $editoriales = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                $this->data[$i]['editoriales']=(sizeof($editoriales)>0)?$editoriales:false;
                
                //DATOS ISSN / ISBN
                $query = "select ta.valor as isbn13 from titulos_atributos as ta
                where  ta.llave='isbn13' and ta.id_titulos='".$this->data[$i]['id_titulos']."'";
                $conn_prepare=$this->conn->prepare($query);
                $conn_prepare->execute();
                $isbn13 = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                $this->data[$i]['isbn13']=(sizeof($isbn13)>0)?$isbn13:false;
                
                //DATOS PRECIO Y TIPO DE PRODUCTO
                if(!isset($_SESSION['moneda'])){
                    $_SESSION['moneda']=1;
                }
                
                $query = "select tlp.precio, m.decimales, m.nombre_corto, tlp.id_tipos_productos, tp.nombre as nombre_tipo_producto, tp.imagen as imagen_tipos_productos from titulos_lista_precios as tlp 
                        inner join lista_precios as lp on lp.id_lista_precios=tlp.id_lista_precios
                        inner join tipos_productos as tp on tp.id_tipos_productos = tlp.id_tipos_productos
                        inner join monedas as m on m.id_moneda = lp.id_moneda
                        where 
                        lp.id_moneda=".$_SESSION['moneda']." and
                        lp.fecha_fin >= (select current_date)
                        and lp.fecha_inicio < (select current_date)
                        and lp.estado='activo'
                        and tlp.id_titulos='".$this->data[$i]['id_titulos']."' and tlp.estado='activo';";
                $conn_prepare=$this->conn->prepare($query);
                $conn_prepare->execute();
                $precio = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                $this->data[$i]['precio']=(sizeof($precio)>0)?$precio:false;
            }
            
        }
    }
    
    function busquedaporAutor($data){
            $this->data=false;
            if(strlen($data['searchString'])<1){
                return false;
            }

            $busqueda = explode(" " , $data['searchString']);
            $data['items_busqueda']=array();
            
            for($i=0;$i<sizeof($busqueda);$i++){
                if(!$this->palabrasaEliminar($busqueda[$i])){
                    $data['items_busqueda'][]=$busqueda[$i];
                }
            }
            
            if(!sizeof($data['items_busqueda'])>0){
                return false;
            }
            
            $filtro='';
                            
            foreach($data['items_busqueda'] as $titulo){

                $filtro.= "and a.nombre_key like '%".preg_replace("/[^A-Za-z0-9]/", "",$titulo)."%' ";
            }
            $filtro = ltrim($filtro,'and');
            
            try{
                if($data['limit']==false){
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_autores as taut on taut.id_titulos=ta.id_titulos 
                    inner join autores as a on taut.id_autores=a.id_autores
                    where ta.llave='titulo' and ( $filtro )"; 

                    $conn_prepare = $this->conn->prepare($query);
                    
                }else{
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_autores as taut on taut.id_titulos=ta.id_titulos 
                    inner join autores as a on taut.id_autores=a.id_autores
                    where ta.llave='titulo' and ( $filtro ) 
                    limit :offset,:limit "; 

                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':limit',$data['limit'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':offset',$data['offset'],PDO::PARAM_INT);
                }
                
                $conn_prepare->execute();
                $this->data= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                ///CARGAR DATOS DE LOS TITULOS ENCONTRADOS
                $this->complementarDetallesResultadoBusqueda();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
    }
    
    function busquedaporEditorial($data){
            $this->data=false;
            if(strlen($data['searchString'])<1){
                return false;
            }

            $busqueda = explode(" " , $data['searchString']);
            $data['items_busqueda']=array();
            
            for($i=0;$i<sizeof($busqueda);$i++){
                if(!$this->palabrasaEliminar($busqueda[$i])){
                    $data['items_busqueda'][]=$busqueda[$i];
                }
            }
            
            if(!sizeof($data['items_busqueda'])>0){
                return false;
            }
            
            $filtro='';
                            
            foreach($data['items_busqueda'] as $titulo){

                $filtro.= "and e.nombre_key like '%".preg_replace("/[^A-Za-z0-9]/", "",$titulo)."%' ";
            }
            $filtro = ltrim($filtro,'and');
            
            try{
                if($data['limit']==false){
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_autores as taut on taut.id_titulos=ta.id_titulos 
                    inner join autores as a on taut.id_autores=a.id_autores
                    inner join titulos_editoriales as te on te.id_titulos = ta.id_titulos
                    inner join editoriales as e on e.id_editoriales=te.id_editoriales
                    where ta.llave='titulo' and ( $filtro ) "; 
                    $conn_prepare = $this->conn->prepare($query);
                }else{
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_autores as taut on taut.id_titulos=ta.id_titulos 
                    inner join autores as a on taut.id_autores=a.id_autores
                    inner join titulos_editoriales as te on te.id_titulos = ta.id_titulos
                    inner join editoriales as e on e.id_editoriales=te.id_editoriales
                    where ta.llave='titulo' and ( $filtro ) 
                    limit :offset,:limit "; 

                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':limit',$data['limit'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':offset',$data['offset'],PDO::PARAM_INT);
                }
                
                $conn_prepare->execute();
                $this->data= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                ///CARGAR DATOS DE LOS TITULOS ENCONTRADOS
                $this->complementarDetallesResultadoBusqueda();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
    }
    
    function busquedaporCategoria($data){
        
            $this->data=false;
            if(strlen($data['searchString'])<1){
                return false;
            }
            
            $busqueda = explode(" " , $data['searchString']);
            $data['items_busqueda']=array();
            
            for($i=0;$i<sizeof($busqueda);$i++){
                if(!$this->palabrasaEliminar($busqueda[$i])){
                    $data['items_busqueda'][]=$busqueda[$i];
                }
            }
            
            if(!sizeof($data['items_busqueda'])>0){
                return false;
            }
            
            $filtro='';
            /*                
            foreach($data['items_busqueda'] as $titulo){

                $filtro.= "and c.nombre like '%".preg_replace("/[^A-Za-z0-9]/", "",$titulo)."%' ";
            }
            $filtro = ltrim($filtro,'and');
            */
            $filtro = " c.nombre_key like '%".strtolower(preg_replace("/[^A-Za-z0-9]/","",$data['searchString']))."%'";
            
            try{
                if($data['limit']==false){
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , 
                    ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_categorias as tc on tc.id_titulos=ta.id_titulos 
                    inner join categorias as c on c.id_categorias = tc.id_categorias
                    where ta.llave='titulo' and ( $filtro )"; 

                    $conn_prepare = $this->conn->prepare($query);
                }else{
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , 
                    ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_categorias as tc on tc.id_titulos=ta.id_titulos 
                    inner join categorias as c on c.id_categorias = tc.id_categorias
                    where ta.llave='titulo' and ( $filtro ) 
                    limit :offset,:limit "; 

                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':limit',$data['limit'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':offset',$data['offset'],PDO::PARAM_INT);
                }
                
                $conn_prepare->execute();
                $this->data= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                ///CARGAR DATOS DE LOS TITULOS ENCONTRADOS
                $this->complementarDetallesResultadoBusqueda();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
    }
    
    function busquedaporIdCategoria($data){
        
            $this->data=false;
            if(strlen($data['searchString'])<1){
                return false;
            }

            $filtro = " c.id_categorias = '".(preg_replace("/[^0-9]/","",$data['searchString']))."'";
            try{
                if($data['limit']==false){
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , 
                    ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_categorias as tc on tc.id_titulos=ta.id_titulos 
                    inner join categorias as c on c.id_categorias = tc.id_categorias
                    where ta.llave='titulo' and ( $filtro )"; 
                    $conn_prepare = $this->conn->prepare($query);
                    
                }else{
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , 
                    ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    inner join titulos_categorias as tc on tc.id_titulos=ta.id_titulos 
                    inner join categorias as c on c.id_categorias = tc.id_categorias
                    where ta.llave='titulo' and ( $filtro ) 
                    limit :offset,:limit "; 
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':limit',$data['limit'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':offset',$data['offset'],PDO::PARAM_INT);
                }
                
                $conn_prepare->execute();
                $this->data= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                ///CARGAR DATOS DE LOS TITULOS ENCONTRADOS
                $this->complementarDetallesResultadoBusqueda();
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
    }
    
    function busquedaporIsbn($data){
            $this->data=false;
            if(strlen($data['searchString'])<1){
                return false;
            }

            $busqueda = explode(" " , $data['searchString']);
            $data['items_busqueda']=array();
            
            for($i=0;$i<sizeof($busqueda);$i++){
                if(!$this->palabrasaEliminar($busqueda[$i])){
                    $data['items_busqueda'][]=$busqueda[$i];
                }
            }
            
            if(!sizeof($data['items_busqueda'])>0){
                return false;
            }
            
            $filtro='';
                            
            foreach($data['items_busqueda'] as $titulo){

                $filtro.= "and tp.isbn like '%".preg_replace("/[^A-Za-z0-9]/", "",$titulo)."%' ";
            }
            $filtro = ltrim($filtro,'and');
            
            try{
                if($data['limit']==false){
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    where ta.llave='titulo' and ( $filtro ) "; 

                    $conn_prepare = $this->conn->prepare($query);
                }else{
                    $query = "select distinct ta.valor as titulo , tp.codigo,tp.isbn , ta.id_titulos from titulos_atributos as ta 
                    inner join titulos_proveedores as tp on tp.id_titulos=ta.id_titulos
                    where ta.llave='titulo' and ( $filtro ) 
                    limit :offset,:limit "; 

                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':limit',$data['limit'],PDO::PARAM_INT);
                    $conn_prepare->bindParam(':offset',$data['offset'],PDO::PARAM_INT);
                }
                
                $conn_prepare->execute();
                $this->data= $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                ///CARGAR DATOS DE LOS TITULOS ENCONTRADOS
                $this->complementarDetallesResultadoBusqueda();
                
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
    }
    
    
    function palabrasaEliminar($cadena){
        $palabras =array(' ','a','e','y','o','u','la', 'las','el','lo','los','en','para','con','que', 'de');
        return (in_array(strtolower($cadena) , $palabras, false))?true:false;
    }
    
}



?>
