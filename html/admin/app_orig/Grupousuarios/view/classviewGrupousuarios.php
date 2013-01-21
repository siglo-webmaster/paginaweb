<?php

class classviewGrupousuarios {
    public $id_modulos;
    function __construct($id_modulos){
        $this->id_modulos = $id_modulos;
    }
    function listGrupousuarios($data){
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
                    $row['id_grupos_usuarios'].
                    "</td>".
                    "<td>".
                    $row['nombre'].
                    "</td>".
                    "<td>".
                    $row['estado'].
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=editGrupousuario&id_grupos_usuarios=".$row['id_grupos_usuarios']."' >Editar</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=delGrupousuario&id_grupos_usuarios=".$row['id_grupos_usuarios']."' >Borrar</a>".
                    "</td>".
                    "</tr>";
        }
        $return.="</table></div>";
        return $return;
    }
    
    function menuModule(){
        $return = "<h2 class='tituloModulo'>Administraci&oacute;n de Grupousuarios</h2><div class='menuModule'><ul>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=crearGrupousuario'>Crear Nuevo Grupousuario</a></li>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=listarGrupousuarios'>Listar Grupousuarios</a></li>".
                "</ul>
                </div>
                <div id='id_module' alt='$this->id_modulos'></div>";
        return $return;
    }
    
    function getFormEditGrupousuario($parametros,$data = false){

        if(!$data){
            
            $data['id_grupos_usuarios']="false";
            $data['nombre']='';
            $data['estado']='activo';
            $data['modulos']=false;
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
        
        
        $modulos = "<div class='modulos'>";
        foreach($parametros as $row){
            $checked='';
            
            if(isset($data['modulos'])){
                
                foreach($data['modulos'] as $lsmodulos){
                    if($row['id_modulos']==$lsmodulos['id_modulos']){
                        $checked = 'CHECKED';
                    }
                }
            }
            
            $modulos.="<p>".
                                "<input type='checkbox' name='".$row['nombre']."' $checked ></input>".$row['nombre'].
                              "</p>";
        }
        $modulos.="</div>";
        
        $return = "<form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' name='id_grupos_usuarios' value='".$data['id_grupos_usuarios']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='saveGrupousuario' />
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Creaci&oacute;n / Edici&oacute;n de Grupousuarios</h2></div>".
                    
                    "<p>".
                    "Nombre: ".
                    "<input type='text' name='nombre' value='".$data['nombre']."' >".
                    "</p>".
                    
                    "<p>".
                    "Estado: ".
                    $estado.
                    
                    "</p>".
                    
                    "<p>".
                    "Modulos: ".
                    $modulos.
                    
                    "</p>".
                    
                "<p><input type='submit' value='Guardar' class='botonGuardar'></p>".
                "</div>
                </form>";
        return $return;
    }
    
    function saveGrupousuario($data){
        return ($data)?"<div class='mensaje'><p>Grupousuario Salvado</p></div>":"<div class='mensaje'><p>Error guardando Grupousuario</p></div>";
    }
    function delGrupousuario($data){
        return ($data)?"<div class='mensaje'><p>Grupousuario Eliminado</p></div>":"<div class='mensaje'><p>Error eliminando Grupousuario</p></div>";
    }
    
    
}

?>
