<?php

class classviewClientes {
    public $id_modulos;
    function __construct($id_modulos){
        $this->id_modulos = $id_modulos;
    }
    function listClientes($data){
        $return = "<div class='listado'><table >
            <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Ciudad</th>
            <th>Estado</th>
            <th colspan='3'>Opciones</th>
            </thead>";
        foreach ($data as $row){
            $return.="<tr>".
                    "<td>".
                    $row['username'].
                    "</td>".
                    "<td>".
                    $row['nombre'].
                    "</td>".
                    "<td>".
                    $row['telefono'].
                    "</td>".
                    "<td>".
                    $row['direccion'].
                    "</td>".
                    "<td>".
                    $row['nombre_ciudad'].
                    "</td>".
                    "<td>".
                    $row['estado'].
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=formChangePasswd&id_clientes=".$row['id_clientes']."' >Cambiar Pasword</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=editCliente&id_clientes=".$row['id_clientes']."' >Editar</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=delCliente&id_clientes=".$row['id_clientes']."' >Borrar</a>".
                    "</td>".
                    "</tr>";
        }
        $return.="</table></div>";
        return $return;
    }
    
    function menuModule(){
        $return = "<h2 class='tituloModulo'>Administraci&oacute;n de Clientes</h2><div class='menuModule'><ul>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=crearCliente'>Crear Nuevo Cliente</a></li>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=listarClientes'>Listar Clientes</a></li>".
                "</ul>
                </div>
                <div id='id_module' alt='$this->id_modulos'></div>";
        return $return;
    }
    
    function getFormEditCliente($parametros,$data = false){

        if(!$data){
            $data['id_tipo_documento']="";
            $data['id_clientes']="false";
            $data['nit']="";
            $data['username']="";
            $data['passwd']="";
            $data['nombre']='';
            $data['direccion']="";
            $data['telefono']="";
            $data['email']="";
            $data['contacto']="";
            $data['telefono_contacto']="";
            $data['id_ciudades']="";
            $data['estado']='activo';
            
            $numero_seleccionados=0;
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
        
        $tipos = "<select name='id_tipo_documento' id='id_tipo_documento'>";
        $selected = '';
        foreach($parametros['documentos'] as $row){
            if($data['id_tipo_documento']==$row['id_tipo_documento']){
                $selected='SELECTED';
            }else{
                $selected='';
            }
            $tipos.="<option value='".$row['id_tipo_documento']."' $selected >".$row['nombre']."</option>";
        }
        $tipos.="</Select>";
    
        $ciudades = "<select name='id_ciudades' id='id_ciudades'>";
        $selected = '';
        foreach($parametros['ciudades'] as $row){
            if($data['id_ciudades']==$row['id_ciudades']){
                $selected='SELECTED';
            }else{
                $selected='';
            }
            $ciudades.="<option value='".$row['id_ciudades']."' $selected >".$row['nombre']."</option>";
        }
        $ciudades.="</Select>";

        
        $return = "<form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' name='id_clientes' value='".$data['id_clientes']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='saveCliente' />
                    <input type='hidden' name='id_clientes' value='".$data['id_clientes']."' />
                    
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Creaci&oacute;n / Edici&oacute;n de Clientes</h2></div>".
                    "<p>".
                    "Nombre de usuario: ".
                    "<input type='text' name='username' value='".$data['username']."' >".
                    "</p>".
                    "<p>".
                    "Nombre: ".
                    "<input type='text' name='nombre' value='".$data['nombre']."' >".
                    "</p>".
                    "<p>".
                    "Identificacion: ".
                    $tipos.
                    "<input type='text' name='nit' value='".$data['nit']."' >".
                    "</p>".
                    "<p>".
                    "Ciudad: ".
                    $ciudades.
                    "</p>".
                    "<p>".
                    "Direccion: ".
                    "<input type='text' name='direccion' value='".$data['direccion']."' >".
                    "</p>".
                    "<p>".
                    "Telefono: ".
                    "<input type='text' name='telefono' value='".$data['telefono']."' >".
                    "</p>".
                    "<p>".
                    "Email: ".
                    "<input type='text' name='email' value='".$data['email']."' >".
                    "</p>".
                    "<p>".
                    "Contacto: ".
                    "<input type='text' name='contacto' value='".$data['contacto']."' >".
                    "</p>".
                    "<p>".
                    "Telefono Contacto: ".
                    "<input type='text' name='telefono_contacto' value='".$data['telefono_contacto']."' >".
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
    
    function saveCliente($data){
        return ($data)?"<div class='mensaje'><p>Cliente Salvado</p></div>":"<div class='mensaje'><p>Error guardando cliente</p></div>";
    }
    function delCliente($data){
        return ($data)?"<div class='mensaje'><p>Cliente Eliminado</p></div>":"<div class='mensaje'><p>Error eliminando Cliente</p></div>";
    }
    
    function formChangePasswd($data){
        $return = "<form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' name='id_clientes' value='".$data['id_clientes']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='savePasswd' />
                    <input type='hidden' name='id_clientes' value='".$data['id_clientes']."' />
                    
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Cambio de password a Cliente</h2></div>".
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
