<?php


class classviewSearchList {

    function generarListado($data){
        $print='<div class="resultadosBusqueda">';
        if($data!=false){
            if(sizeof($data)>0){
                foreach($data as $row){
                    if(file_exists('images/caratulasSHE/'.$row['codigo'].'_g.jpg')){
                        $imagen = '<img src="'.'images/caratulasSHE/'.$row['codigo'].'_g.jpg'.'" ></img>';
                    }else{
                        $imagen='<img src="images/nohay.gif"></img>';
                    }
                    if($row['autores']!=false){
                        $autores='';
                        foreach($row['autores'] as $autor){
                            $autores.=", <a href='index.php?action=searchList&opt=autor&searchString=".$autor['nombre']."'>".$autor['nombre']."</a>";
                        }
                        $autores = ltrim($autores,', ');
                    }else{
                        $autores='';
                    }
                    if($row['editoriales']!=false){
                        $editoriales='';
                        foreach($row['editoriales'] as $editorial){
                            $editoriales.=", <a href='index.php?action=searchList&opt=editorial&searchString=".$editorial['nombre']."'>".$editorial['nombre']."</a>";
                        }
                        $editoriales = ltrim($editoriales,', ');
                    }else{
                        $editoriales='';
                    }
                    
                    if($row['isbn13']!=false){
                        $isbn13='';
                        foreach($row['isbn13'] as $isbn){
                            $isbn13.=" ".$isbn['isbn13'];
                        }
                        
                    }else{
                        $isbn13='';
                    }
                    
                    if($row['precio']!=false){
                        $precios='';
                       
                        foreach($row['precio'] as $precio){
                            $precios.="<div class='valor'>".number_format($precio['precio'],$precio['decimales'])." ".$precio['nombre_corto']."</div> <img src='".$precio['imagen_tipos_productos']."' alt='".$precio['nombre_tipo_producto']."'></img>";
                        }
                        
                    }else{
                        $precios='';
                       
                    }

                    $print.="<div class='listadoSearch' onClick='getItem(\"".$row['id_titulos']."\");' >
                        <div class='imagenListado'>".$imagen."</div>
                        
                        <div class='texto'>
                            <div class='titulo' >".substr($row['titulo'],0,90)."</div>
                            <div class='autor'>$autores</div>
                            
                            <div class='isbn'>ISBN/ISSN:$isbn13</div>
                            <div class='editorial'>Editorial: $editoriales</div>
                        </div>
                        <div class='precio'>".$precios."</div>
                        
                     </div>";
                }
            }
        }
        $print.='</div><div id="list" class="list"><div id="first"></div><div id="last"></div></div>';
        return $print;
        
    }
    function showParametrosBusqueda($data){
        $return = "<div class='resumenbusqueda'>Busqueda por ".$data['opt']." \"".$data['returnSearch']."\"<div class='exportar'> <a href='generadorXLS.php?opt=generarXLS&opt2=".$data['opt']."&searchString=".$data['searchString']."'><img src='images/excel.gif'></img></a></div></div>
            <div class='tituloresultadosbusqueda'>Resultados de la busqueda:</div>";
        return $return;
    }
    
    function generarXLS($data){
        require_once("lib/xls.class.php");
        $xl = new xls();
        ///GENERAR LA CABECERA DEL ARCHIVO
        
        $cabeceras = array('EDITORIAL','CODIGO','ISBN','CODIGO DE BARRAS','TITULO',
                            'EDICION','AUTOR','PRECIO','PAGINAS','FORMATO','PESO',
                            'CARATULA','AREA','SUBAREA','TEMA','COLECCION');
        
        for($i=0;$i<sizeof($cabeceras);$i++){
            $xl->add_cell(($i+1).":1",$cabeceras[$i]);
        }
        ///FIN CABECERA DEL ARCHIVO
        
        $j=2;
        
        if($data!=false){
            foreach($data as $row){
                
                $editoriales='';
                if(isset($row['editoriales'])){
                    if(sizeof($row['editoriales'])>0){
                        foreach($row['editoriales'] as $editorial){
                            if(isset($editorial['nombre'])){
                                $editoriales.=", ".utf8_decode($editorial['nombre']);
                            }
                        }
                        $editoriales = ltrim($editoriales,', ');
                    }
                    
                 }
                $xl->add_cell("1:".$j , $editoriales);
                
                
                if(!isset($row['codigo'])){$row['codigo']='';}
                $xl->add_cell("2:".$j , $row['codigo']);
                
                if(!isset($row['isbn'])){$row['isbn']='';}
                $xl->add_cell("3:".$j , $row['isbn']);
                
                if(!isset($row['titulo'])){$row['titulo']='';}
                $xl->add_cell("5:".$j , utf8_decode($row['titulo']));
                
                $autores='';
                if(isset($row['autores'])){
                    if(sizeof($row['autores'])>0){
                        foreach($row['autores'] as $autor){
                            if(isset($autor['nombre'])){
                                $autores.=", ".utf8_decode($autor['nombre']);
                            }
                        }
                        $autores = ltrim($autores,', ');
                    }
                    
                 }
                $xl->add_cell("7:".$j , $autores);
                
                if(!isset($row['precio'][0]['precio'])){$row['precio'][0]['precio']='';}
                $xl->add_cell("8:".$j , number_format($row['precio'][0]['precio'],0));
                
                $j++;
            }
            $xl->execute("consulta_".date('Y-m-d_h:i:s').".xls");
        }
        
        
    }
    
}

?>
