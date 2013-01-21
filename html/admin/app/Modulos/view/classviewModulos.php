<?php

class classviewModulos {
    public $id_modulos;
    function __construct($id_modulos){
        $this->id_modulos = $id_modulos;
    }
    function listModulos($data){
        $return = "<div class='listado'><table >
            <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th colspan='2'>Opciones</th>
            </thead>";
        foreach ($data as $row){
            $return.="<tr>".
                    "<td>".
                    $row['id_modulos'].
                    "</td>".
                    "<td>".
                    $row['nombre'].
                    "</td>".
                    "<td>".
                    $row['estado'].
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=editModulo&id_modulos=".$row['id_modulos']."' >Editar</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=delModulo&id_modulos=".$row['id_modulos']."' >Borrar</a>".
                    "</td>".
                    "</tr>";
        }
        $return.="</table></div>";
        return $return;
    }
    
    function menuModule(){
        $return = "<h2 class='tituloModulo'>Administraci&oacute;n de Modulos</h2><div class='menuModule'><ul>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=crearModulo'>Crear Nuevo Modulo</a></li>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=listarModulos'>Listar Modulos</a></li>".
                "</ul>
                </div>
                <div id='id_module' alt='$this->id_modulos'></div>";
        return $return;
    }
    
    function getFormEditModulo($data = false){

        if(!$data){
            
            $data['id_modulos']="false";
            $data['nombre']='';
            $data['estado']='activo';
            
        }else{
            
        }
        
        $estado ="<select name='estado'>
                    <option value='activo'>Activo</option>
                    <option value='inactivo'>Inactivo</option>
                </select>";
        
        if($data['estado']=='activo'){
           $estado = str_replace("'activo'", "'activo' SELECTED", $estado); 
        }else{
           $estado = str_replace("'inactivo'", "'inactivo' SELECTED", $estado); 
        }
        
        
        $return = "<form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' name='id_modulos' value='".$data['id_modulos']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='saveModulo' />
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Creaci&oacute;n / Edici&oacute;n de Modulos</h2></div>".
                    
                    "<p>".
                    "Nombre: ".
                    "<input type='text' name='nombre' value='".$data['nombre']."' >".
                    "</p>".
                    
                    "<p>".
                    "Estado: ".
                    $estado.
                    
                    "</p>".
                    
                    
                "<p><input type='submit' value='Guardar' class='botonGuardar'></p>".
                "</div>
                </form>";
        return $return;
    }
    
    function saveModulo($data){
        return ($data)?"<div class='mensaje'><p>Modulo Salvado</p></div>":"<div class='mensaje'><p>Error guardando Modulo</p></div>";
    }
    function delModulo($data){
        return ($data)?"<div class='mensaje'><p>Modulo Eliminado</p></div>":"<div class='mensaje'><p>Error eliminando Modulo</p></div>";
    }
    
    
}

?>
