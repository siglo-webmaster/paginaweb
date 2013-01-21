<?php

class classviewEventos {
    function listEventos($data,$id_module){
        $return = "<div class='listado'><table >
            <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Tipo Evento</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>
            <th colspan='2'>Opciones</th>
            </thead>";
        foreach ($data as $row){
            $return.="<tr>".
                    "<td>".
                    $row['id_eventos'].
                    "</td>".
                    "<td>".
                    $row['nombre'].
                    "</td>".
                    "<td>".
                    $row['tipo_eventos'].
                    "</td>".
                    "<td>".
                    $row['inicio'].
                    "</td>".
                    "<td>".
                    $row['fin'].
                    "</td>".
                    "<td>".
                    $row['estado'].
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$id_module&opt=editEvento&id_eventos=".$row['id_eventos']."' >Editar</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$id_module&opt=delEvento&id_eventos=".$row['id_eventos']."' >Borrar</a>".
                    "</td>".
                    "</tr>";
        }
        $return.="</table></div>";
        return $return;
    }
    
    function menuModule($id_module){
        $return = "<h2 class='tituloModulo'>Eventos</h2><div class='menuModule'><ul>".
                "<div class='menuModule'><ul>".
                "<li><a href='index.php?action=loadModule&id_module=$id_module&opt=crearEvento'>Crear Nuevo Evento</a></li>".
                "<li><a href='index.php?action=loadModule&id_module=$id_module&opt=listarEventos'>Listar Eventos</a></li>".
                "</ul>
                </div>";
        return $return;
    }
    
    function getFormEditEvento($tipo_eventos,$id_module,$data = false){
        if(!$data){
            $data['nombre']='';
            $data['inicio']=date("Y-m-d");
            $data['fin']=date("Y-m-d");
            $data['estado']='activo';
            $data['id_eventos']='false';
            $data['id_tipo_eventos']='';
        }else{
            $data['inicio']=explode(' ',$data['inicio']);
            $data['inicio']=$data['inicio'][0];
            $data['fin']=explode(' ',$data['fin']);
            $data['fin']=$data['fin'][0];
        }
        
        if(isset($data['detalle'])){
            foreach($data['detalle'] as $row){
                $temp[$row['llave']]=$row['valor'];
            }
            unset($data['detalle']);
            $data['detalle']=$temp;
        }else{
            $data['detalle']['imagen']='';
            $data['detalle']['descripcion']='';
        }
        if(!isset($data['detalle']['imagen'])){
            $data['detalle']['imagen']='';
        }
        if(!isset($data['detalle']['descripcion'])){
            $data['detalle']['descripcion']='';
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
        
        $tipos = "<select name='id_tipo_eventos'>";
        $selected = '';
        foreach($tipo_eventos as $row){
            if($data['id_tipo_eventos']==$row['id_tipo_eventos']){
                $selected='SELECTED';
            }else{
                $selected='';
            }
            $tipos.="<option value='".$row['id_tipo_eventos']."' $selected >".$row['nombre']."</option>";
        }
        $tipos.="</Select>";
        
        
        $return = "<form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' name='id_eventos' value='".$data['id_eventos']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$id_module' />
                    <input type='hidden' name='opt' value='saveEvento' />
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Creaci&oacute;n / Edici&oacute;n de Eventos</h2></div>".
                    "<p>".
                    "<strong>Nombre Evento: </strong>".
                    "<input type='text' name='nombre' value='".$data['nombre']."' >".
                    "</p>".
                    "<p>".
                    "<strong>Estado: </strong>".
                    $estado.
                    
                    "<strong> Tipo de Evento: </strong>".
                    $tipos.
                    "</p>".
                    "<p>".
                    "<strong>Fecha Inicio: </Strong>".
                    "<input type='text' name='inicio' id='inicio' value='".$data['inicio']."' size='10'>".
                    
                    "<strong> Fecha Fin: </strong>".
                    "<input type='text' name='fin' id='fin' value='".$data['fin']."' size='10'>".
                    "</p>".
                    "<p>".
                    "<strong>Descripci&oacute;n:</strong> ".
                    "<input type='text' name=descripcion value='".$data['detalle']['descripcion']."' >".
                    "</p>".
                    "<p>".
                    "<strong>Imagen: </strong>".
                    "<input type='file' name='imagen'  >".
                    "<input type='hidden' name='imagen_actual' value='".$data['detalle']['imagen']."' />".
                    "</p>".
                    "<p>"."<img src='../".$data['detalle']['imagen']."' />"."</p>".
                "<p><input type='submit' value='Guardar'></p>".
                "</div>
                </form>";
        return $return;
    }
    
    function saveEvento($data){
        return ($data)?"<div class='mensaje'><p>Evento Salvado</p></div>":"<div class='mensaje'><p>Error guardando Evento</p></div>";
    }
    function delEvento($data){
        return ($data)?"<div class='mensaje'><p>Evento Eliminado</p></div>":"<div class='mensaje'><p>Error eliminando Evento</p></div>";
    }
}

?>
