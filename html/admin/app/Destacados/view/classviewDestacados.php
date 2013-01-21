<?php

class classviewDestacados {
    public $id_modulos;
    function __construct($id_modulos){
        $this->id_modulos = $id_modulos;
    }
    function listDestacados($data){
        $return = "<div class='listado'><table >
            <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Tipo Destacado</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>
            <th colspan='2'>Opciones</th>
            </thead>";
        foreach ($data as $row){
            $return.="<tr>".
                    "<td>".
                    $row['id_destacados'].
                    "</td>".
                    "<td>".
                    $row['nombre'].
                    "</td>".
                    "<td>".
                    $row['tipo_destacados'].
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
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=editDestacado&id_destacados=".$row['id_destacados']."' >Editar</a>".
                    "</td>".
                    "<td>".
                    "<a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=delDestacado&id_destacados=".$row['id_destacados']."' >Borrar</a>".
                    "</td>".
                    "</tr>";
        }
        $return.="</table></div>";
        return $return;
    }
    
    function menuModule(){
        $return = "<h2 class='tituloModulo'>Destacados</h2><div class='menuModule'><ul>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=crearDestacado'>Crear Nuevo Destacado</a></li>".
                "<li><a href='index.php?action=loadModule&id_module=$this->id_modulos&opt=listarDestacados'>Listar Destacados</a></li>".
                "</ul>
                </div>
                <div id='id_module' alt='$this->id_modulos'></div>";
        return $return;
    }
    
    function getFormEditDestacado($tipo_destacados,$data = false){

        if(!$data){
            $data['nombre']='';
            $data['inicio']=date("Y-m-d");
            $data['fin']=date("Y-m-d");
            $data['estado']='activo';
            $data['id_destacados']='false';
            $data['id_tipos_destacados']='';
            $data['id_tipos_destacados_anterior']='';
            $data['detalle']='';
            $data['observaciones']='';
            $numero_seleccionados=0;
        }else{
            $numero_seleccionados=sizeof($data['detalle']);
            $data['id_tipos_destacados_anterior']=$data['id_tipos_destacados'];
            $data['inicio'] = explode(' ',$data['inicio']);
            $data['inicio']=$data['inicio'][0];
            $data['fin'] = explode(' ',$data['fin']);
            $data['fin']=$data['fin'][0];
        }
       
        $seleccionados= "";
        
        if($data['detalle']>0){
            $i=0;
            foreach($data['detalle']as $item){
                $seleccionados.="<div id='".$i."' class='tituloSeleccionado'>
                                <input type='hidden' name='seleccionado_".$i."' value='".$item['id_titulos']."' />".
                                "<div id='botonBorrar_".$i."' class='botonBorrar' alt='".$i."'>
                                <img src='../images/borrar_small.png' /></div>".
                                "<div class='caratula'><img src='../images/caratulasSHE/".$item['codigo']."_g.jpg' /></div>".
                                $item['codigo']."  ".$item['titulo'].
                                "</div>";
                $i++;
            }
            if(isset($data['detalle'][0]['sel'])){
                $sel= $data['detalle'][0]['sel'];
            }else{
                $sel='';
            }
            
        }else{
            $sel='';
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
        
        $tipos = "<select name='id_tipos_destacados' id='id_tipos_destacados'>";
        $selected = '';
        foreach($tipo_destacados as $row){
            if($data['id_tipos_destacados']==$row['id_tipos_destacados']){
                $selected='SELECTED';
            }else{
                $selected='';
            }
            $tipos.="<option value='".$row['id_tipos_destacados']."' $selected >".$row['nombre']."</option>";
        }
        $tipos.="</Select>";
        
        
        $return = "<form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' name='id_destacados' value='".$data['id_destacados']."' />
                    <input type='hidden' name='id_tipos_destacados_anterior' value='".$data['id_tipos_destacados_anterior']."' />
                    <input type='hidden' name='action' value='loadModule' />
                    <input type='hidden' name='id_module' value='$this->id_modulos' />
                    <input type='hidden' name='opt' value='saveDestacado' />
                    <input type='hidden' name='sel' id='sel' value='".$sel."' >
                    <div class='formulario'>".
                    "<div class='titulo'><h2>Creaci&oacute;n / Edici&oacute;n de Destacados</h2></div>".
                    "<p>".
                    "Nombre Destacado: ".
                    "<input type='text' name='nombre' value='".$data['nombre']."' >".
                    "</p>".
                    "<p>".
                    "Estado: ".
                    $estado.
                    
                    " Tipo de Destacado: ".
                    $tipos.
                    "</p>".
                    "<p><div id='seleccionDestacados'></div></p>".
                    "<p>".
                    "Fecha Inicio: ".
                    "<input type='text' name='inicio' id='inicio' value='".$data['inicio']."' size='10'>".
                    
                    " Fecha Fin: ".
                    "<input type='text' name='fin' id='fin' value='".$data['fin']."' size='10' >".
                    "</p>".
                    "<p>".
                    "Observaciones: ".
                    "<input type='text' name='observaciones' value='".$data['observaciones']."' >".
                    "</p>".
                    "<p><h3>Titulos a destacar</h3>".
                    "<div id='paneles'></div>".
                    "</p>".
                    "<div id='panelSeleccionados' class='panelSeleccionados'>".$seleccionados."</div>
                        <input type='hidden' id='numeroSeleccionados' name='numeroSeleccionados' value='".$numero_seleccionados."' />".
                "<p><input type='submit' value='Guardar' class='botonGuardar'></p>".
                "</div>
                </form>";
        return $return;
    }
    
    function saveDestacado($data){
        return ($data)?"<div class='mensaje'><p>Destacado Salvado</p></div>":"<div class='mensaje'><p>Error guardando Destacado</p></div>";
    }
    function delDestacado($data){
        return ($data)?"<div class='mensaje'><p>Destacado Eliminado</p></div>":"<div class='mensaje'><p>Error eliminando Destacado</p></div>";
    }
    
    function getListaCategorias($data,$selected=''){
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
