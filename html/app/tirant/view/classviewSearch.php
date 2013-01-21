<?php


class classviewSearch {
    public $print;

    function getFormStandar($data=''){
        $this->print = "<div class='mainSearch' id='mainSearch'>
                <form id='formulariobusqueda' method='post' autocomplete='off'>
                <input type='hidden' name='action'  value='searchList' />
                <input type='hidden' name='opt'  value='titulo' />
                <div class='tituloBusqueda'>B&uacute;squeda:</div>
                <input type='text' name='searchString' id='searchString' class='searchString' value='".$data."' />
                <div id='verOpcionesAvanzadas' class='verOpcionesAvanzadas' alt='show'>Ver Busqueda Avanzada</div>
                <input type='hidden' name='tipoBusqueda' id='tipoBusqueda' value='clasic' />
                <div id='opcionesAvanzadas' class='opcionesAvanzadas'>
                    <div class='loadingBusqueda' ><img src='images/loading_bar2.gif' /></div>
                    <div class='opcionesBusqueda' id='opcionesBusqueda'>    
                    </div>
                    <div class='menuTipoBusqueda'>
                        <div class='opcionInactiva' alt='editoriales'>Filtrar por Editorial</div>
                        <div class='opcionInactiva' alt='autores'>Filtrar por Autor</div>
                        <div class='opcionInactiva' alt='categorias'>Filtrar por Categor&iacute;a</div>
                        <div class='opcionInactiva' alt='fecha'>Filtrar por Fecha</div>
                    </div>
                    <div class='menuFormatos'>
                        
                        <p class='formato'><input class='checkBoxFormatos' type='checkbox' name='f_impreso' id='f_impreso' checked >Impreso</input></p>
                        <p class='formato'><input class='checkBoxFormatos' type='checkbox' name='f_ebook' id='f_ebook' checked >Ebook</input></p>
                        <p class='formato'><input class='checkBoxFormatos' type='checkbox' name='f_revista' id='f_revista' checked >Revistas</input></p>
                        <p class='formato'><input class='checkBoxFormatos' type='checkbox' name='f_suscripcion' id='f_suscripcion' checked >Suscripciones</input></p>
                        <p class='titulo'>Formatos: </p>
                    </div>
                    
                </div>
                
                </form>
                <div id='autocomplete' class='autocomplete' alt='true'>
                </div>
            </div>
            ";
    }
    function getEditoriales($data){
        $return = "<div class='titulo'>Editorial: </div><div class='selectBusqueda'><select name='id_editoriales' id='id_editoriales'>";
        foreach($data as $row){
            $return.="<option value='".$row['id_editoriales']."'>".$row['nombre']."</option>";
        }
        return $return."</Select></div>";
    }
    
    function getAutores($data){
        $return = "<div class='titulo'>Autor: </div><div class='selectBusqueda'><select name='id_autores' id='id_autores'>";
        foreach($data as $row){
            $return.="<option value='".$row['id_autores']."'>".  ($row['nombre'])."</option>";
        }
        return $return."</Select></div>";
    }
    
    function getCategorias($data){
        $return = "<div class='titulo'>Categor&iacute;a: </div><div class='selectBusqueda'><select name='id_categorias' id='id_categorias'>";
        foreach($data as $row){
            $return.="<option value='".$row['id_categorias']."'>". utf8_encode($row['nombre'])."</option>";
        }
        return $return."</Select></div>";
    }
    
    function getFechas(){
        $return = "<div class='titulo'>Fecha edici&oacute;n desde: </div>
            <input type='text' name='f_desde' id='f_desde' class='fechas'/>
            <div class='titulo'> hasta: </div>
            <input type='text' name='f_hasta' id='f_hasta' class='fechas'/>";
        return $return;
    }
    
    function busquedaGeneral($data, $param){
        require_once("app/tirant/view/itemHTML.php");
        $items = new itemHTML();
                                                     
        foreach($data as $row){
            $items->addItem($row);
        }
        $items->closeItems();

        $return=$items->items."</div>";
        
        
        
        $return.= "Parametros Recibidos para busqueda: ";
        foreach($param as $key=>$value){
            $return.="<p>$key = > $value</p>";
        }
        
        return $return;
    }
    
    function getResultadoPreview($result,$queryString){
        
        
        if(sizeof($result['titulos'])>0){
            $this->print.="<div class='seccion'>
                            <div class='titulo'>Titulos</div><div class='contenido'><ul >";
            foreach($result['titulos'] as $row){
                $this->print.= "<a href='#' onClick='getItem(\"".$row['id_titulos']."\");' ><li class='tituloQuickSearch' id='1' title='titulo'  >";
                if(file_exists("images/caratulasSHE/".$row['codigo']."_g.jpg")){
                    $this->print.="<img src='images/caratulasSHE/".$row['codigo']."_g.jpg' ></img>";
                }else{
                    $this->print.="<img src='images/nohay.gif' ></img>";
                }
                
                $this->print.=$row['valor']."</li></a>";

            }
            $this->print.="</ul></div>
                    <div class='verMasResultados'><a href='index.php?action=searchList&opt=titulo&searchString=".$queryString."'>Ver mas resultados ...</a></div>
                    </div>";
            
        }
        
        if(sizeof($result['autores'])>0){
              $this->print.="<div class='seccion'>
                            <div class='titulo'>Autores</div><div class='contenido'><ul >";
            foreach($result['autores'] as $row){
                $this->print.= "<a href='index.php?action=searchList&opt=autor&searchString=".$row['nombre']."'><li>";
                $this->print.= $row['nombre'];
                $this->print.= "</li></a>";

            }
            $this->print.="</ul></div>
                <div class='verMasResultados'><a href='index.php?action=searchList&opt=autor&searchString=".$queryString."'>Ver mas resultados ...</a></div>
                 </div>";
        }
        
        if(sizeof($result['categorias'])>0){
              $this->print.="<div class='seccion'>
                            <div class='titulo'>Categor&iacute;as</div><div class='contenido'><ul >";
            foreach($result['categorias'] as $row){
                $this->print.= "<a href='index.php?action=searchList&opt=categoria&searchString=".utf8_encode($row['nombre'])."'><li>";
                $this->print.= utf8_encode($row['nombre']);
                $this->print.= "</li></a>";

            }
            $this->print.="</ul></div>
                <div class='verMasResultados'><a href='index.php?action=searchList&opt=categoria&searchString=".$queryString."'>Ver mas resultados ...</a></div>
                 </div>";
        }
        
        if(sizeof($result['editoriales'])>0){
              $this->print.="<div class='seccion'>
                            <div class='titulo'>Editoriales</div><div class='contenido'><ul >";
            foreach($result['editoriales'] as $row){
                $this->print.= "<a href='index.php?action=searchList&opt=editorial&searchString=".$row['nombre']."'><li>";
                $this->print.= $row['nombre'];
                $this->print.= "</li></a>";

            }
            $this->print.="</ul></div>
                <div class='verMasResultados'><a href='index.php?action=searchList&opt=editorial&searchString=".$queryString."'>Ver mas resultados ...</a></div>
                 </div>";
        }
        
        if(sizeof($result['isbn'])>0){
            
            $this->print.="<div class='seccion'>
                    <div class='titulo'>ISBN</div><div class='contenido'><ul >";
            foreach($result['isbn'] as $row){
                $this->print.= "<a href='index.php?action=searchList&opt=isbn&searchString=".$row['isbn']."'><li>";
                $this->print.= $row['isbn'];
                $this->print.= "</li></a>";

            }
            $this->print.="</ul></div>
                <div class='verMasResultados'><a href='index.php?action=searchList&opt=isbn&searchString=".$queryString."'>Ver mas resultados ...</a></div>
                 </div>";
        }
        return $this->print;
        
    }
    
    function detalleItem($data,$car=false){
        $data = $data[0];
        $resenya ='';
        if(isset($data['autores'])){
            if(is_array($data['autores'])){
                foreach($data['autores'] as $temp){
                    if(!isset($autores)){
                        $autores='';
                    }else{
                        $autores.=",&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    $autores.='<a href="index.php?action=listCatalogo&id_autores='.$temp['id_autores'].'">'. $temp['nombre'].'</a>';
                }
                
            }else{
                $autores='';
            }
            
        }else{
            $autores='';
        }
        
        $editoriales='';
        foreach($data['editoriales'] as $temp){
            $editoriales.=  ' <a href="index.php?action=listCatalogo&id_editoriales='.$temp['id_editoriales'].'">'.$temp['nombre']."</a> |";
        }
        $editoriales = rtrim($editoriales,"|");
        
        $categorias='';
        if(isset($data['categorias'])){
            $categorias='Categor&iacute;as: ';
            foreach($data['categorias'] as $temp){
                $categorias.=' <a href="index.php?action=listCatalogo&theme='.$temp['id_categorias'].'">'.$temp['nombre'].'</a>,';
            }
            $categorias = rtrim($categorias,',');
        }
        
        $formatos_precio='';
        
        if($car!=false){
                $productos_cantidad_formato=array();
                foreach($car->productos->producto as $producto){
                    if($producto->id_titulos ==  $data['id_titulos']){
                        foreach($producto->detalles->item as $item){
                            $productos_cantidad_formato[(int)$item->id_tipo_formato]['cantidad']=$item->cantidad;
                            $productos_cantidad_formato[(int)$item->id_tipo_formato]['proveedor']=$item->id_proveedor;
                            $productos_cantidad_formato[(int)$item->id_tipo_formato]['subtotal']=$item->cantidad;
                        }
                    }
                }  
            }
            
            $css_libro = "libro_detalle_search";
            $temp_cantidades='';
            for($i=0;$i<=_MAXITEMSSHOP;$i++){
                $temp_cantidades.="<option value='".$i."'>".$i."</option>";
            }
            $i=0;
            $total = 0;
            $formatos_precio.="<ul class='precio'>";
            foreach($data['tipo_producto'] as $temp){
                $cantidades = $temp_cantidades;
                $subtotal=0;
                if(isset($productos_cantidad_formato[$temp['id_tipos_productos']])){
                    if((int)$productos_cantidad_formato[$temp['id_tipos_productos']]['proveedor']==$temp['id_proveedores']){
                        $cantidades = str_replace("value='".$productos_cantidad_formato[$temp['id_tipos_productos']]['cantidad']."'","value='".$productos_cantidad_formato[$temp['id_tipos_productos']]['cantidad']."' SELECTED ", $cantidades);
                        $subtotal = (int)$productos_cantidad_formato[$temp['id_tipos_productos']]['subtotal'] * ($temp['precio']);
                        $total+=$subtotal; 
                        $subtotal = number_format($subtotal,$_SESSION['decimales']);
                    }
                }
                $imagenes_formatos ='<div class="formatos">';
                switch($temp['id_tipos_productos']){
                    case '1':{
                        
                        $imagenes_formatos.="<img src='images/impreso.jpg' >";
                        break;
                    }
                    case '2':{
                        
                        $imagenes_formatos.="<img src='images/ebook.jpg' >";
                    }
                    
                }
                    
                $formatos_precio.="<li><b>".$temp['nombre'].":</b> $ ".number_format($temp['precio'],$_SESSION['decimales'])." ".$temp['moneda'].
                        "<input type='hidden' name='precio_".$temp['id_tipos_productos']."' id='precio_".$temp['id_tipos_productos']."' value='".$temp['precio']."' />
                        <input type='hidden' name='id_tipos_productos_".$i."'  id='id_tipos_productos_".$i."' class='id_tipos_productos_".$i."' value='".$temp['id_tipos_productos']."'/>
                        <input type='hidden' name='id_proveedores_".$temp['id_tipos_productos']."'  id='id_proveedores_".$temp['id_tipos_productos']."' class='id_proveedores_".$temp['id_tipos_productos']."' value='".$temp['id_proveedores']."'/>    
                        <select name='cantidades_".$temp['id_tipos_productos']."' id='cantidades_".$temp['id_tipos_productos']."' class='cantidades' alt='".$temp['id_tipos_productos']."' onChange='cambioCantidades(this,\"".$temp['id_tipos_productos']."\");'>".$cantidades."</select>".
                        " $ <input type='text' name='subtotal_".$temp['id_tipos_productos']."' id='subtotal_".$temp['id_tipos_productos']."' value='".$subtotal."' size='12'readonly />".
                        "</li>";
                $i++;
            }
            

            $numero_tipo_productos = $i;
          
            
            $formatos_precio =" 
                    <div class=\"formatos_precios\">
                    <form action='#'>
                    <input type='hidden' class='numero_tipos_productos' name='numero_tipos_productos' id='numero_tipos_productos' value='".$numero_tipo_productos."' />
                    <input type='hidden' name='id_titulos' id='id_titulos' class='id_titulos' value='".$data['id_titulos']."' />
                     <input type='hidden' name='id_lista_precios' id='id_lista_precios' class='id_lista_precios' value='".$data['id_lista_precios']."' />
                     $formatos_precio
                     <p>
                     <div id='agregarItem' class='enlaceboton' onClick='agregarItem();' >Guardar</div>
                    </p>
                    <p>
                     <div id='total' name='total' class='total'>$".number_format($total,$_SESSION['decimales'])."</div>
                    </p>
                    <input type='hidden'  id='numero_decimales' value='".$_SESSION['decimales']."' ></input>
                    </form>
                    
                    </div><p>".utf8_encode($data['resenya'])."</p>";
        
            
        $return = '<div class="libro_detalle_search" id="'.$data['id_titulos'].'" title="'.$data['titulo'].'" >';
        
     //   if(file_exists($data['link_imagen'])){
            $imagen = '<img  border="0" src="'.$data['link_imagen'].'" >';
     //   }else{
     //       $imagen='<img  border="0" src="images/nohay.gif" >';
      //  }
    
    $return.='
            <div class="contenedorimagen">
            <!-- LINK DE DETALLES EN LA IMAGEN DEL ARTICULO -->
            
            '.$imagen.'
            <!-- FIN LINK DE DETALLES EN LA IMAGEN DEL ARTICULO -->			
            </div> <!-- Fin contenedorimagen-->

            <!-- LINK DE DETALLES EN EL TITULO DEL ARTICULO -->
            <div class="titulo">'.$data['titulo'].'</div>
            <!-- FIN LINK DE DETALLES EN EL TITULO DEL ARTICULO -->
            <!--ISBN -->
            <div class="isbn">
                <strong>ISBN: </strong> '.$data['isbn13'].'
            </div>
            <!-- Fin isbn -->           
            <!--DATOS DEL LIBRO -->
            <div class="autores">
                <strong>Autor(es):</strong> '.$autores.'
            </div>
            
            <div class="editoriales">
                <strong>Editorial:</strong>'.$editoriales.'
            </div>
            <div class="anyo">
                <strong>A&ntilde;o:</strong>&nbsp;&nbsp;&nbsp;'.$data['fecha_pub'].'
            </div>
            
            <!--FIN DATOS DEL LIBRO -->											
            <!-- FORMULARIO --> 
            '.$formatos_precio.'
            <!-- FIN FORMULARIO -->
            <!--categorias -->
            '.$categorias.'
            <!-- Fin categorias-->
            ';
        
        $return.="</div>";
        
        return $return;
    }
    
    
}

?>
