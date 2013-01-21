<?php
class itemHTML{
    public $items;
    public $contador;
    public $indice;
    public $head;
    public $foot;
    function __construct($action=null,$data=null){
        $this->head=$this->foot='';
        if($action!=null){
            switch($action){
                case 'reg':{
                    
                    break;
                }
            }
        }else{
            
           $this->contador=0;
           $this->head="<div id='list'><div id='first'></div><h3>RESULTADOS DE LA BUSQUEDA</h3>";
           $this->foot='<div id=\"last\"></div></div>';
           if(isset($_REQUEST['id_editoriales'])){
               if($_REQUEST['id_editoriales']!=''){
                   $this->head="<div class='destacadosEditoriales'><div class='titulo'><h2>DESTACADOS</h2></div><div id='destacadosEditoriales'></div></div>".$this->head;
               }
           }
           
        }
    }
    function addTitle(){
        return "<p><span class=\"titulo_cat\">Cat&aacute;logo</span></p>
                   ";
    }
    
    function getDetallesItem($data,$car=false){
     
        $resenya ='';
        if(isset($data['autores'])){
            if(is_array($data['autores'])){
                
                foreach($data['autores'] as $temp){
                    if(!isset($autores)){
                        $autores='';
                    }else{
                        $autores.=",&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    $autores.='<a href="index.php?action=listCatalogo&id_autores='.$temp['id_autores'].'">'.htmlentities($temp['nombre']).'</a>';
                }
                
            }else{
                $autores='';
            }
            
        }else{
            $autores='';
        }
        
        
        $editoriales='';
        foreach($data['editoriales'] as $temp){
            $editoriales.=  ' <a href="index.php?action=listCatalogo&id_editoriales='.$temp['id_editoriales'].'">'. htmlentities($temp['nombre'])."</a> |";
           /* if($temp['imagen']!=''){
                $imagen='<img src="'.$temp['imagen'].'" />';
            }else{
                $imagen = '';
            }
            $editoriales.='<div class="editorial"><a href="index.php?action=listCatalogo&id_editoriales='.$temp['id_editoriales'].'">'.  htmlentities($temp['nombre']).$imagen.'</a></div><br/>';*/
        }
        $editoriales = rtrim($editoriales,"|");
        
        $categorias='';
        if(isset($data['categorias'])){
            $categorias='Categor&iacute;as: ';
            foreach($data['categorias'] as $temp){
                $categorias.=' <a href="index.php?action=listCatalogo&theme='.$temp['id_categorias'].'">'.htmlentities($temp['nombre']).'</a>,';
            }
            $categorias = rtrim($categorias,',');
        }
        
        
        $formatos_precio='';
        //INICIO DETALLE     
        if(isset($data['detalleItem'])){
            
            if($car!=false){
                $productos_cantidad_formato=array();
                foreach($car->productos->producto as $producto){
                    if($producto->id_titulos ==  $data['id_titulos']){
                        foreach($producto->detalles->item as $item){
                            $productos_cantidad_formato[(int)$item->id_tipo_formato]['cantidad']=$item->cantidad;
                            $productos_cantidad_formato[(int)$item->id_tipo_formato]['proveedor']=$item->id_proveedor;
                        }
                    }
                }  
            }
            
            $css_libro = "libro_detalle";
            $temp_cantidades='';
            for($i=0;$i<=_MAXITEMSSHOP;$i++){
                $temp_cantidades.="<option value='".$i."'>".$i."</option>";
            }
            $i=0;
            
            $formatos_precio.="<ul class='precio'>";
            foreach($data['tipo_producto'] as $temp){
                $cantidades = $temp_cantidades;
                
                if(isset($productos_cantidad_formato[$temp['id_tipos_productos']])){
                    if((int)$productos_cantidad_formato[$temp['id_tipos_productos']]['proveedor']==$temp['id_proveedores']){
                        $cantidades = str_replace("value='".$productos_cantidad_formato[$temp['id_tipos_productos']]['cantidad']."'","value='".$productos_cantidad_formato[$temp['id_tipos_productos']]['cantidad']."' SELECTED ", $cantidades);                       
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
                        <select name='cantidades_".$temp['id_tipos_productos']."' id='cantidades_".$temp['id_tipos_productos']."' class='cantidades' alt='".$temp['id_tipos_productos']."'>".$cantidades."</select>".
                        " $ <input type='text' name='subtotal_".$temp['id_tipos_productos']."' id='subtotal_".$temp['id_tipos_productos']."' value='0' size='12'readonly />".
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
                     <div id='agregarItem' class='enlaceboton' >Guardar</div>
                    </p>
                    <p>
                     <div id='total' name='total' class='total'></div>
                    </p>
                    </form>
                    
                    </div><p>".$data['resenya']."</p>";

        ////////FIN DETALLE
        }else{
            $css_libro = "libro";
            $formatos_precio.="<ul class='precio'>";
            $imagenes_formatos ='<div class="formatos">';
            foreach($data['tipo_producto'] as $temp){
                $formatos_precio.="<li><b>".$temp['nombre'].":</b>   $ ".number_format($temp['precio'],$_SESSION['decimales'])." ".$temp['moneda']."
                        </li>";
            }
            $formatos_precio.="</ul>";
            
            $formatos_precio.='<iframe name="cargador" id="cargador"  style="display:none;" ></iframe>';
            $formulario = "";
        }
        
        if(isset($data['list'])){
            $return='';
        }else{
            $return = '<div class="'.$css_libro.'" id="'.$data['id_titulos'].'" title="'.$data['titulo'].'" >';
        }
        if(file_exists($data['link_imagen'])){
            $imagen = '<img  border="0" src="'.$data['link_imagen'].'" >';
        }else{
            $imagen='';
        }
        $return.='
            <div class="contenedorimagen">
            <!-- LINK DE DETALLES EN LA IMAGEN DEL ARTICULO -->
            
            '.$imagen.'
            <!-- FIN LINK DE DETALLES EN LA IMAGEN DEL ARTICULO -->			
            </div> <!-- Fin contenedorimagen-->

            <!-- LINK DE DETALLES EN EL TITULO DEL ARTICULO -->
            <div class="titulo">'.htmlentities($data['titulo']).'</div>
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
        
        $return.="<div id='numero_decimales' alt='".$_SESSION['decimales']."' style='display:none;'></div>";
        
        if(isset($data['list'])){
            
        }else{
            $return.= '</div>';
        }
        
        return $return;
    }
    
    function addItem($data){
        $this->items[]=array('detalle'=>$this->getDetallesItem($data),'id_titulos'=>$data['id_titulos'],'titulo'=>$data['titulo']);
        $this->contador++;
    }
    
    function closeItems($list = false){
        if($list){
            require_once("app/common/view/classviewXML.php");
            
            foreach($this->items as $row){
                    $temp[]=array('id_titulos'=>  utf8_encode($row['id_titulos']),'titulo'=>  utf8_encode($row['titulo']));
                }
            
           $return = new classviewXML();
           $return->generarListado($temp);
           $this->items = $return->string;
        }else{
            if(sizeof($this->items)>0){
                $temp = "";
                foreach($this->items as $row){
                    $temp.=$row['detalle'];
                }
                $this->items=$this->head.$temp.$this->foot;

            }
        }

    }
    
    
    
    /*! \brief Detalles del producto en la ventana emergente*/
    function detalleItem($data,$car=false){
        $data[0]['detalleItem']=true;
        $item = $this->getDetallesItem($data[0],$car);
        
        
        
        $cabecera = '<html>
            <head>
            <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
            <LINK REL=StyleSheet HREF="css/sh_detalleitem_css.css" TYPE="text/css" MEDIA=all>
            <link rel="stylesheet" type="text/css" media="screen" href="css/nyroModal.css"  />
            <link href="lib/jquery/jquery-ui.css" rel="stylesheet" type="text/css"/>
            <script src="lib/jquery/jquery.min.js"></script>
            <script src="lib/jquery/jquery-ui.min.js"></script>
            <script src="lib/sh_detalleitem_scripts.js"></script>

            </head>
            <body> <div id="container"';
        $pie ='</div></body></html>';


                    
           return $cabecera.$item.$pie;
    }
    
    function setPaginacion($data){
        
        $paginas = "";

        $this->indice="";
        
        if($data['numpages']<=1) return; 
        
        $busqueda = "&title=".$data['title']."&theme=".$data['theme']."&autor=".$data['autor']."&isbn=".$data['isbn']."&date_publish=".$data['date_publish']."&id_editoriales=".$data['editoriales'];
       
        $paginas = $data['numpages'];
        
        $tabla ="<table border='0' ><tr><td  class=\"texto\">[ ";
       
        for($i=1;$i<=$paginas;$i++){
            $offset = (($i - 1)*$data['limit']);
            if($i!=$data['page']){
                $this->indice.="<a href='index.php?action=listCatalogo&page=".$i."&limit=".$data['limit']."&offset=".$offset.$busqueda."' \">".$i."</a> |";
            }else{
                $this->indice.=$i." |";
            }
        }
        if($data['page']>1){
            $this->indice="<a href='index.php?action=listCatalogo&page=".($data['page']-1)."&limit=".$data['limit']."&offset=".(($data['page']-2)*$data['limit']).$busqueda."' > << Anterior</a> ||&nbsp;&nbsp;&nbsp;&nbsp; ".$this->indice;
        }
        if($data['page']<$paginas){
            $this->indice.="&nbsp;&nbsp;&nbsp;&nbsp;|| <a href='index.php?action=listCatalogo&page=".($data['page']+1)."&limit=".$data['limit']."&offset=".(($data['page'])*$data['limit']).$busqueda."' class='next-posts'>  Siguiente >> ]</a>";
        }
        $this->indice= $tabla.$this->indice."</tr></table>";
    }

}
?>
