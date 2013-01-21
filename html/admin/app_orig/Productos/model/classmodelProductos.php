<?php
require_once("lib/dbConnection.php");

class classmodelProductos extends dbConnection{
    
    function listProductos($estado = false){
        $this->conn->beginTransaction();
        try{
            if($estado!=false){
                $estado = " AND titulos.estado='".$estado."'";
            }else{
                $estado = '';
            }
            $query = "select titulos_atributos.valor as titulo , titulos.estado, titulos.last_update,titulos.id_titulos, ta.valor as link_imagen , te.id_editoriales , e.nombre as editorial
                        from titulos_atributos 
                        inner join titulos on titulos.id_titulos=titulos_atributos.id_titulos 
                        inner join titulos_editoriales as te on te.id_titulos = titulos.id_titulos
                        inner join titulos_atributos as ta on ta.id_titulos=titulos.id_titulos and 
                        ta.llave='link_imagen' 
                        inner join editoriales as e on e.id_editoriales = te.id_editoriales
                        where titulos_atributos.llave = 'titulo' ".$estado." order by  last_admin_view , te.id_editoriales ASC limit 20  ";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->execute();
            $this->data = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
            if(is_array($this->data)){
                $last_admin_view = date('Y-m-d h:i:s');
                foreach($this->data as $row){
                    $query = "update titulos set last_admin_view=:last_admin_view where id_titulos=:id_titulos";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam(':last_admin_view',$last_admin_view,PDO::PARAM_STR);
                    $conn_prepare->bindParam(':id_titulos',$row['id_titulos'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                    var_dump($_SESSION);
                    //$this->audit("update",'usuario','tabla',$conn_prepare,array(':last_admin_view'=>$last_admin_view,':id_titulos'=>$row['id_titulos']));
                }
            }
            $this->conn->commit();
        }catch(PDOException $e){
            echo $e->getMessage();
            $this->conn->rollBack();
        }
        
        
    }
    
    function changeStatusItem($id_titulos, $estado){
        $this->conn->beginTransaction();
        $this->status = false;
        $this->data =false;
        try{
            $last_update = date('Y-m-d h:i:s');
            $query = "update titulos set estado=:estado, last_update=:last_update where id_titulos=:id_titulos ";
            
            $conn_prepare = $this->conn->prepare($query);
            
            $conn_prepare->bindParam(':estado',$estado,PDO::PARAM_STR);
            
            $conn_prepare->bindParam(':last_update',$last_update,PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
               
            $conn_prepare->execute();
            
           $this->conn->commit();
        }catch(PDOException $e){
            
            $this->conn->rollBack();
        }
        return $this->status;
        
    }
    
    function changeEditorialStatusItem($id_editoriales, $estado){
        $this->conn->beginTransaction();
        $this->status = false;
        $this->data =false;
        try{
            
            $last_update = date('Y-m-d h:i:s');
            
            $query = "update editoriales set estado=:estado, last_update=:last_update where id_editoriales=:id_editoriales";
            
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':estado',$estado,PDO::PARAM_STR);
            $conn_prepare->bindParam(':last_update',$last_update,PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_editoriales',$id_editoriales,PDO::PARAM_INT);
               
            $conn_prepare->execute();
            
            $query = "update titulos set estado=:estado, last_update=:last_update where id_titulos in (
                select distinct te.id_titulos from titulos_editoriales as te
                where te.id_editoriales=:id_editoriales)";
            
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':estado',$estado,PDO::PARAM_STR);
            $conn_prepare->bindParam(':last_update',$last_update,PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_editoriales',$id_editoriales,PDO::PARAM_INT);
               
            $conn_prepare->execute();
            
           $this->conn->commit();
        }catch(PDOException $e){
            
            $this->conn->rollBack();
        }
        return $this->status;
        
    }
    
    function getTiposProductos(){
        $query = "select * from tipos_destacados where estado='activo'";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getListaCategorias(){
        $query = "select * from categorias where id_padre='0'";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getListaEditoriales(){
        $query = "select * from editoriales where estado='activo'";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getListaAutores(){
        $query = "select * from autores order by nombre ASC";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getListaEventos(){
        $query = "select * from eventos";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    
    function getListaTitulosxCategoria($id_categorias){
        $query = "select ta.valor as nombre, ta.id_titulos ,tp.codigo from titulos_atributos as ta
            inner join titulos_categorias as tc on ta.id_titulos=tc.id_titulos 
            inner join titulos_proveedores as tp on tp.id_titulos=tc.id_titulos 
            where tc.id_categorias=:id_categorias and ta.llave='titulo' order by codigo, nombre ASC";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam(':id_categorias',$id_categorias,PDO::PARAM_INT);
        $conn_prepare->execute();
        return $conn_prepare->fetchAll(PDO::FETCH_NAMED);
    }
    function getDatosProducto($data){
        $query = "select * from destacados where id_destacados = :id_destacados";
        $conn_prepare = $this->conn->prepare($query);
        $conn_prepare->bindParam('id_destacados',$data['id_destacados'],PDO::PARAM_INT);
        $conn_prepare->execute();
        $return = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
        
        if(!is_array($return))return false;
        
        switch($return[0]['id_tipos_destacados']){
            case '1':{
                    $query = "select distinct * from view_destacados_titulos_destacados where id_destacados = :id_destacados";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam('id_destacados',$data['id_destacados'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $return[0]['detalle'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    break;   
            }
            
            case '2':{
                    $query = "select distinct * from view_destacados_titulos_categorias_destacados where id_destacados = :id_destacados";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam('id_destacados',$data['id_destacados'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $return[0]['detalle'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    break;   
            }
            case '3':{
                    $query = "select distinct * from view_destacados_titulos_editoriales_destacados where id_destacados = :id_destacados";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam('id_destacados',$data['id_destacados'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $return[0]['detalle'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    break;   
            }
            case '4':{
                    $query = "select distinct * from view_destacados_titulos_autores_destacados where id_destacados = :id_destacados";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam('id_destacados',$data['id_destacados'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $return[0]['detalle'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    break;   
            }
            case '5':{
                    $query = "select distinct * from view_destacados_titulos_eventos_destacados where id_destacados = :id_destacados";
                    $conn_prepare = $this->conn->prepare($query);
                    $conn_prepare->bindParam('id_destacados',$data['id_destacados'],PDO::PARAM_INT);
                    $conn_prepare->execute();
                    $return[0]['detalle'] = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
                    break;   
            }
        }
        
        
        return (is_array($return[0]['detalle']))?$return:false;
        
    }
    
    function saveProducto($data){

        switch($data['id_destacados']){
            case 'false':{
                return $this->saveNuevoProducto($data);
                break;
            }
            default:{
                return $this->saveEditProducto($data);
                break;
            }
        }
    }
    
    function saveNuevoProducto($data){
       
        $titulosProductos = $this->getTitulosProductos($data);
        if(!$titulosProductos)return false;
        $this->conn->beginTransaction();
        try{
            $query = "insert into destacados (id_tipos_destacados,nombre, inicio, fin,observaciones,estado) values(:id_tipos_destacados,:nombre, :inicio, :fin, :observaciones, :estado)";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_tipos_destacados',$data['id_tipos_destacados'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':inicio',$data['inicio'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fin',$data['fin'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':observaciones',$data['observaciones'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->execute();
            
            $lastId = $this->conn->lastInsertId('id_destacados');
            
            

            switch($data['id_tipos_destacados']){
                case '1':{
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_destacados(id_titulos,id_destacados) values(:id_titulos,:id_destacados)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '2':{
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_categorias_destacados(id_titulos,id_destacados,id_categorias) values(:id_titulos,:id_destacados,:id_categorias)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_categorias',$data['id_categorias'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '3':{
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_editoriales_destacados(id_titulos,id_destacados,id_editoriales) values(:id_titulos,:id_destacados,:id_editoriales)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_editoriales',$data['id_editoriales'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '4':{
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_autores_destacados(id_titulos,id_destacados,id_autores) values(:id_titulos,:id_destacados,:id_autores)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_autores',$data['id_autores'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '5':{
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_eventos_destacados(id_titulos,id_destacados,id_eventos) values(:id_titulos,:id_destacados,:id_eventos)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_eventos',$data['id_eventos'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
            }
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    function saveEditProducto($data){
        $titulosProductos = $this->getTitulosProductos($data);
        if(!$titulosProductos)return false;
        
        $this->conn->beginTransaction();
        try{
            $query = "update destacados set id_tipos_destacados=:id_tipos_destacados,nombre=:nombre, inicio=:inicio, fin=:fin, observaciones=:observaciones, estado=:estado where id_destacados = :id_destacados";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_tipos_destacados',$data['id_tipos_destacados'],PDO::PARAM_INT);
            $conn_prepare->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':inicio',$data['inicio'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':fin',$data['fin'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':observaciones',$data['observaciones'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':estado',$data['estado'],PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_destacados',$data['id_destacados'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $lastId=$data['id_destacados'];
            
            switch($data['id_tipos_destacados_anterior']){
                case '1':{
                        $query = "delete from titulos_destacados where id_destacados=:id_destacados";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->execute();
                    
                    break;
                }
                case '2':{
                        $query = "delete from titulos_categorias_destacados where id_destacados=:id_destacados";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->execute();
                    
                    break;
                }
                case '3':{
                        $query = "delete from titulos_editoriales_destacados where id_destacados=:id_destacados";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->execute();
                    
                    break;
                }
                case '4':{
                        $query = "delete from titulos_autores_destacados where id_destacados=:id_destacados";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->execute();
                     
                    break;
                }
                case '5':{
                        $query = "delete from titulos_eventos_destacados where id_destacados=:id_destacados";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->execute();
                   
                    break;
                }
            }
            
            
            switch($data['id_tipos_destacados']){
                case '1':{
                        
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_destacados(id_titulos,id_destacados) values(:id_titulos,:id_destacados)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '2':{
                      
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_categorias_destacados(id_titulos,id_destacados,id_categorias) values(:id_titulos,:id_destacados,:id_categorias)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_categorias',$data['id_categorias'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '3':{
                       
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_editoriales_destacados(id_titulos,id_destacados,id_editoriales) values(:id_titulos,:id_destacados,:id_editoriales)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_editoriales',$data['id_editoriales'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '4':{
                       
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_autores_destacados(id_titulos,id_destacados,id_autores) values(:id_titulos,:id_destacados,:id_autores)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_autores',$data['id_autores'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
                case '5':{
                       
                    foreach($titulosProductos as $id_titulos){
                        $query = "insert into titulos_eventos_destacados(id_titulos,id_destacados,id_eventos) values(:id_titulos,:id_destacados,:id_eventos)";
                        $conn_prepare = $this->conn->prepare($query);
                        $conn_prepare->bindParam(':id_destacados',$lastId,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_titulos',$id_titulos,PDO::PARAM_INT);
                        $conn_prepare->bindParam(':id_eventos',$data['id_eventos'],PDO::PARAM_INT);
                        $conn_prepare->execute();
                    }
                    break;
                }
            }
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){

            $e->getMessage();
            $this->conn->rollBack();
            return false;
        }
        
    }
    
    function delProducto($data){
        $this->conn->beginTransaction();
        try{
            $query = "select id_tipos_destacados from destacados where id_destacados=:id_destacados";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_destacados',$data['id_destacados'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $temp = $conn_prepare->fetchAll(PDO::FETCH_NAMED);
            
            if(isset($temp[0]['id_tipos_destacados'])){
                
                switch($temp[0]['id_tipos_destacados']){
                    case '1':{
                        $query = "delete from titulos_destacados where id_destacados=:id_destacados";
                    break;   
                    }
                    case '2':{
                        $query = "delete from titulos_categorias_destacados where id_destacados=:id_destacados";
                    break;   
                    }
                    case '3':{
                        $query = "delete from titulos_editoriales_destacados where id_destacados=:id_destacados";
                    break;   
                    }
                    case '4':{
                        $query = "delete from titulos_autores_destacados where id_destacados=:id_destacados";
                    break;   
                    }
                    case '5':{
                        $query = "delete from titulos_eventos_destacados where id_destacados=:id_destacados";
                    break;   
                    }
                }
            }
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_destacados',$data['id_destacados'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $query = "delete from destacados where id_destacados=:id_destacados";
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':id_destacados',$data['id_destacados'],PDO::PARAM_INT);
            $conn_prepare->execute();
            
            $this->conn->commit();
            return true;
        }catch(PDOException $e){
            $this->conn->rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    
    function getTitulosProductos($data){
        $return=false;
        for($i=0;$i<$data['numeroSeleccionados'];$i++){
            if(isset($data['seleccionado_'.$i])){
                $return[]=$data['seleccionado_'.$i];
            }
        }
        return $return;
    }
    
}

?>
