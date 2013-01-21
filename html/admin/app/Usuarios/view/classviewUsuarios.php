<?php

class classviewUsuarios {
    public $id_modulos;
    function __construct($id_modulos){
        $this->id_modulos = $id_modulos;
    }
    function listUsuarios($data){
        $return = "<div class='listado'><table >
            <thead>
            <th>Nombre</th>
            <th>Email</th>
            <th>Estado</th>
            <th colspan='3'>Opciones</th>
            </thead>";
        foreach ($data as $row){
            $return.="<tr>".
                    "<td>".
                    $row['nombre'].
                    "</td>".
                    "<td>".
                    $row['email'].
                    "</td>".
                    "<td>".
                    $row['estado'].
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=formChangePasswd&id_usuarios=".$row['id_usuarios']."' >Cambiar Pasword</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=editUsuario&id_usuarios=".$row['id_usuarios']."' >Editar</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=delUsuario&id_usuarios=".$row['id_usuarios']."' >Borrar</a>".
                    "</td>".
                    "</tr>";
        }
        $return.="</table></div>";
        return $return;
    }
    
    function menuModule(){
        $return = "<h2 class='tituloModulo'>Administraci&oacute;n de Usuarios</h2><div class='menuModule'><ul>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=crearUsuario'>Crear Nuevo Usuario</a></li>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=listarUsuarios'>Listar Usuarios</a></li>".
                "</ul>
                </div>
                <div id='id_module' alt='$this->id_modulos'></div>";
        return $return;
    }
    
    function getFormEditUsuario($parametros,$data = false){

        if(!$data){
            
            $data['id_usuarios']="false";
            $data['passwd']="";
            $data['nombre']='';
            $data['email']="";
            $data['estado']='activo';
            $data['gruposusuarios']=false;
            
        }else{
            
        }
        
        $grupos_usuarios = "<div class='grupousuarios'>";
        foreach($parametros['gruposusuarios'] as $row){
            $checked='';
            if(is_array($data['gruposusuarios'])){
                foreach($data['gruposusuarios'] as $grupos){
                    if($row['id_grupos_usuarios']==$grupos['id_grupos_usuarios']){
                        $checked = 'CHECKED';
                    }
                }
            }
            
            $grupos_usuarios.="<p>".
                                "<input type='checkbox' name='".$row['nombre']."' $checked ></input>".$row['nombre'].
                              "</p>";
        }
        $grupos_usuarios.="</div>";
        
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
                    <input type='hidden' name='id_usuarios' value='".$data['id_usuarios']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='saveUsuario' />
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Creaci&oacute;n / Edici&oacute;n de Usuarios</h2></div>".
                    
                    "<p>".
                    "Nombre: ".
                    "<input type='text' name='nombre' value='".$data['nombre']."' >".
                    "</p>".
                    
                    "<p>".
                    "Email: ".
                    "<input type='text' name='email' value='".$data['email']."' >".
                    "</p>".
                    
                    "<p>".
                    "Estado: ".
                    $estado.
                    
                    "</p>".
                    "<p>".
                    "Grupos de usuarios: ".
                    $grupos_usuarios.
                    "</p>".
                    
                "<p><input type='submit' value='Guardar' class='botonGuardar'></p>".
                "</div>
                </form>";
        return $return;
    }
    
    function saveUsuario($data){
        return ($data)?"<div class='mensaje'><p>Usuario Salvado</p></div>":"<div class='mensaje'><p>Error guardando Usuario</p></div>";
    }
    function delUsuario($data){
        return ($data)?"<div class='mensaje'><p>Usuario Eliminado</p></div>":"<div class='mensaje'><p>Error eliminando Usuario</p></div>";
    }
    
    function formChangePasswd($data){
        $return = "<form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' name='id_usuarios' value='".$data['id_usuarios']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='savePasswd' />
                    
                    
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Cambio de password a Usuario</h2></div>".
                    "<p>".
                    "Nuevo Password: ".
                    "<input type='text' name='passwd' value='' >".
                    "</p>".
                    
                    
                "<p><input type='submit' value='Guardar' class='botonGuardar'></p>".
                "</div>
                </form>";
        return $return;
    }
    
    
    function savePasswd($data){
        return ($data)?"<div class='mensaje'><p>Pasword Actualizado</p></div>":"<div class='mensaje'><p>Error actualizando pasword</p></div>";
    }
}

?>
