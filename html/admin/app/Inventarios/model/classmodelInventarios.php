<?php
require_once("lib/dbConnection.php");

class classmodelInventarios extends dbConnection{
    
    function listInventarios($estado = false){
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
                    
                    /*LOG DE AUDITORIA*/
                    if(!$this->audit("update",$_SESSION['userAdmin'],$_SESSION['nombre'],'titulos',$query,array(':last_admin_view'=>$last_admin_view,':id_titulos'=>$row['id_titulos']))){
                        $this->conn->rollBack();
                        return false;
                    }
                    /*FIN LOG DE AUDITORIA*/
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
            
            /*LOG DE AUDITORIA*/
            if(!$this->audit("update",$_SESSION['userAdmin'],$_SESSION['nombre'],'titulos',$query,array(':estado'=>$estado,':last_update'=>$last_update,':id_titulos'=>$id_titulos))){
                $this->conn->rollBack();
                return false;
            }
            /*FIN LOG DE AUDITORIA*/
            
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
            
            /*LOG DE AUDITORIA*/
            if(!$this->audit("update",$_SESSION['userAdmin'],$_SESSION['nombre'],'editoriales',$query,array(':estado'=>$estado,':last_update'=>$last_update,':id_editoriales'=>$id_editoriales))){
                $this->conn->rollBack();
                return false;
            }
            /*FIN LOG DE AUDITORIA*/
            
            $query = "update titulos set estado=:estado, last_update=:last_update where id_titulos in (
                select distinct te.id_titulos from titulos_editoriales as te
                where te.id_editoriales=:id_editoriales)";
            
            $conn_prepare = $this->conn->prepare($query);
            $conn_prepare->bindParam(':estado',$estado,PDO::PARAM_STR);
            $conn_prepare->bindParam(':last_update',$last_update,PDO::PARAM_STR);
            $conn_prepare->bindParam(':id_editoriales',$id_editoriales,PDO::PARAM_INT);
               
            $conn_prepare->execute();
            
            /*LOG DE AUDITORIA*/
            if(!$this->audit("update",$_SESSION['userAdmin'],$_SESSION['nombre'],'titulos',$query,array(':estado'=>$estado,':last_update'=>$last_update,':id_editoriales'=>$id_editoriales))){
                $this->conn->rollBack();
                return false;
            }
            /*FIN LOG DE AUDITORIA*/
            
           $this->conn->commit();
        }catch(PDOException $e){
            
            $this->conn->rollBack();
        }
        return $this->status;
        
    }
    
    
}

?>
