<?php

class classviewMicrositios {
    public $id_modulos;
    function __construct($id_modulos){
        $this->id_modulos = $id_modulos;
    }
    function listMicrositios($data){
        $return = "<div class='listado'><table >
            <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>plantilla</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>
            <th colspan='2'>Opciones</th>
            </thead>";
        foreach ($data as $row){
            $return.="<tr>".
                    "<td>".
                    $row['id_micrositios'].
                    "</td>".
                    "<td>".
                    $row['nombre'].
                    "</td>".
                    "<td>".
                    $row['plantilla'].
                    "</td>".
                    "<td>".
                    $row['fecha_inicio'].
                    "</td>".
                    "<td>".
                    $row['fecha_fin'].
                    "</td>".
                    "<td>".
                    $row['estado'].
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=editMicrositios&id_micrositios=".$row['id_micrositios']."' >Editar</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=delMicrositios&id_micrositios=".$row['id_micrositios']."' >Borrar</a>".
                    "</td>".
                    "</tr>";
        }
        $return.="</table></div>";
        return $return;
    }
    
    function menuModule(){
        $return = "<h2 class='tituloModulo'>Micrositios</h2><div class='menuModule'><ul>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=crearMicrositio'>Crear Nuevo Micrositio</a></li>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=listarMicrositios'>Listar Micrositios</a></li>".
                "</ul>
                </div>
                <div id='id_module' alt='$this->id_modulos'></div>";
        return $return;
    }
    
    function getFormEditMicrositio($plantillas,$data = false){

        if(!$data){
            $data['nombre']='';
            $data['estado']='activo';
            $data['id_micrositios']='false';
            $data['fecha_inicio']=date('Y-m-d');
            $data['fecha_fin']=date('Y-m-d');
            $data['plantilla']='';
            $numero_seleccionados=0;
        }
        $plantilla="<select name='plantilla'>";
        foreach($plantillas as $row){
            if($row==$data['plantilla']){
                $selected="SELECTED";
            }else{
                $selected="";
            }
            $plantilla .= "<option value='".$row."' $selected >$row</option>";
        }
        $plantilla.="</select>";
        
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
                    <input type='hidden' name='id_micrositios' value='".$data['id_micrositios']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='saveMicrositio' />
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Creaci&oacute;n / Edici&oacute;n de Micrositios</h2></div>".
                    "<p>".
                    "Nombre Micrositio: ".
                    "<input type='text' name='nombre' value='".$data['nombre']."' >".
                    "</p>".
                    "<p>".
                    "Plantilla: ".
                    $plantilla.
                    "</p>".
                    "<p>Fecha Inicio <input type='text' name='fecha_inicio' value='".$data['fecha_inicio']."'></input></p>".
                    "<p>Fecha Fin <input type='text' name='fecha_fin' value='".$data['fecha_fin']."'></input></p>".
                    "<p>".
                    "Estado: ".
                    $estado.
                   
                    "</p>".
                "<p><input type='submit' value='Guardar' class='botonGuardar'></p>".
                "</div>
                </form>";
        return $return;
    }
    
    function saveMicrositio($data){
        return ($data)?"<div class='mensaje'><p>Micrositio Salvado</p></div>":"<div class='mensaje'><p>Error guardando Micrositio</p></div>";
    }
    function delMicrositio($data){
        return ($data)?"<div class='mensaje'><p>Micrositio Eliminado</p></div>":"<div class='mensaje'><p>Error eliminando Micrositio</p></div>";
    }
    
    function getListaMicrositios($data,$selected=''){
        $return='<strong>Categor&iacute;a:</strong> <select name="id_categorias">';
        foreach($data as $row){
            if($row['id_categorias']==$selected){
                $sel = " SELECTED ";
            }else{
                $sel= "";
            }
            $return.="<option value='".$row['id_categorias']."' $sel >".utf8_encode($row['nombre'])."</option>";
        }
        $return.="</select>";
        return $return;
    }
    
    function getListaEditoriales($data,$selected=''){
        $return='<strong>Editoriales:</strong> <select name="id_editoriales">';
        foreach($data as $row){
            if($row['id_editoriales']==$selected){
                $sel = " SELECTED ";
            }else{
                $sel= "";
            }
            $return.="<option value='".$row['id_editoriales']."' $sel>".utf8_encode($row['nombre'])."</option>";
        }
        $return.="</select>";
        return $return;
    }
    
    function getListaAutores($data,$selected=''){
        $return='<strong>Autores:</strong> <select name="id_autores">';
        foreach($data as $row){
            if($row['id_autores']==$selected){
                $sel = " SELECTED ";
            }else{
                $sel= "";
            }
            $return.="<option value='".$row['id_autores']."' $sel>".$row['nombre']."</option>";
        }
        $return.="</select>";
        return $return;
    }
    
    function getListaEventos($data, $selected=''){
        $return='<strong>Eventos:</strong> <select name="id_eventos">';
        foreach($data as $row){
            if($row['id_eventos']==$selected){
                $sel = " SELECTED ";
            }else{
                $sel= "";
            }
            $return.="<option value='".$row['id_eventos']."' $sel >".$row['nombre']."</option>";
        }
        $return.="</select>";
        return $return;
    }
    
    function getPanelesCategorias($data){
        $return='<div class=\'panelDerecho\'> <select name="panelCategorias" id="panelCategorias" size="'.sizeof($data).'" alt="'.sizeof($data).'" onChange=\'loadRight();\'>';
        foreach($data as $row){
            $return.="<option value='".$row['id_categorias']."' >".utf8_encode($row['nombre'])."</option>";
        }
        $return.="</select></div><div id='panelDerecho' class='panelDerecho'></div>
            <div id='selector' class='selector'>Agregar</div>
            ";
        return $return;
    }
    
    function getPanelDerecho($data){
        if(sizeof($data)>0){
            $return = "
            <select name='titulos' id='titulos' size='20' multiple=\"multiple\">";
            foreach ($data as $row){
                $return.="<option value='".$row['id_titulos']."'>".$row['codigo']."  ".$row['nombre']."</option>";
            }
            $return.="</select>";
            return $return;
        }else{
              return  "No hay titulos en la categoria seleccionada.";
        }
        
    }
}

?>
