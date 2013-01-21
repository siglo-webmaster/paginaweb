<?php

/**
 * Description of classviewShoppingcar
 *
 * @author oborja
 */
class classviewShoppingCar {
    public $head;
    
    function __construct (){
        $this->head= '<table width=75% cellspacing="0" cellpadding="0" border="0">
              <tbody><tr> 
                <td height="20" bgcolor="#990000">&nbsp;</td>
              </tr>
              <tr> 
                <td>
                        <font color="#990000"><span class="titulo_cat">Carrito de compras</span></font>
                        </td>
               </tr>
                </table> 
                    ';
    }
    
    function listCar($car){
        $print = $this->head;
        if($car==false){
            return $print.="<p>Carrito Vacio</p>";
        }
        
        $print.='<p><table id="zebra" class="path" width=100%>
            <thead>
            <tr>
            <th width=40%>Producto</th><th>Precios</th><th>Cantidad</th><th>Sub Totales</th><th>Totales</th><th>Opciones</th></tr>
            </thead>
            <tbody>';
        
        foreach($car as $producto){
            $precios='';
            foreach($producto['detalles']->item as $item){
                    $precios.="<div class='detalles'>".$item->nombre_formato.": ";
                    $precios.="C/U $ ".number_format((float)$item->precio,$_SESSION['decimales'])."";
                    $precios.="&nbsp;&nbsp;".$item->moneda."</div>";
                   
            }
            $cantidades='';
            foreach($producto['detalles']->item as $item){
                    $cantidades.="<div class='detalles'> ";
                    $cantidades.=$item->cantidad."</div>";
                   
            }
            
            $subtotales = '';
            $totales=0;
            foreach($producto['detalles']->item as $item){
                    $subtotales.="<div class='detalles'>";
                    $subtotales.="$".number_format((((float)$item->precio) * $item->cantidad),$_SESSION['decimales'])."";
                    $subtotales.="&nbsp;&nbsp;".$item->moneda."</div>";
                    $totales = $totales + ((((float)$item->precio) * $item->cantidad));
                    $moneda = $item->moneda;
            }
            $print.="<tr>".
                    "<td ><div class='botonEditar' id='".$producto['id_titulos']."' title='".$producto['titulo']."'>".$producto['titulo']."</div></td>".
                    "<td ><div class='botonEditar' id='".$producto['id_titulos']."' title='".$producto['titulo']."'>".$precios."</div></td>".
                    "<td ><div class='botonEditar' id='".$producto['id_titulos']."' title='".$producto['titulo']."'>".$cantidades."</div></td>".
                    "<td ><div class='botonEditar' id='".$producto['id_titulos']."' title='".$producto['titulo']."'>".$subtotales."</div></td>".
                    "<td ><div class='botonEditar' id='".$producto['id_titulos']."' title='".$producto['titulo']."'> $ ".number_format($totales,$_SESSION['decimales'])."&nbsp;&nbsp;".$moneda."</div></td>".
                    "<td >
                    
                        <div class='botonBorrar'  alt='".$producto['id_titulos']."' title='".$producto['titulo']."'> [ Borrar ]</div>
                           ".
                    "</td>".
                    "</tr>";
        }
        
        $print.='</tbody>
            </table></p>';
        $print.="<a href='index.php?action=crearPedido'>"._GUARDARCARRITO."</a></p>";
       
        return $print;
    }
    

    
     function redirect($url){
        $print = "<html>
            <head><meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=".$url."\">
            </head>
               </html>";
        return $print;
    }
    

    function getHome($data){
        $print = '<table align="center" width="400" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr> 
                    
                    <td style="text-align:right;">'.$data.'</td>
                    <td width="14" nowrap="nowrap" height="20">&nbsp;</td>    
                </tr>
                </tbody></table>';
       return $print;
    }
    function displayError($error){
        
        return "<font color='red'>ERROR: </font>".$error;
    }
    
    function carbarHeader(){
        
        $print = "<div id='barCar' class='barCar' alt='closed'>
                    <div class='windowButton' id='windowButton'>+</div>
                    <div class='resumenValor'>
                        <div class='titulo'>Valor:</div>
                        <div class='valor' id='cc_valor'>$600,000</div>
                    </div>
                    <div class='resumenItems'>
                        <div class='titulo'>Productos:</div><div class='valor' id='cc_productos'>20</div>
                    </div>
                    <div class='carritoimg'><img src='images/cestan.gif' ></img></div>
                    
                    <div id='barCardetalle' class='barCardetalle'>  
                        
                        
                    </div>
                    <div class='verMas' id='verMas'>Ver m&aacute;s detalles >></div>
                 </div>";
        
       return $print;
       
       /*
        * ESTRUCTURA DE UN ITEM EN EL CARRITO DE COMPRA
        * 
                        <div id='cc_item_1' class='barCaritem' onclick='getItem(\"2255\");'>
                            <div class='barCaritemimagen'><img src='images/nohay.gif'></img></div>
                            <div class='barCaritemdetalles'>
                                <div class='barCaritemtitulo'>Este es el titulo del libro</div>
                                <div class='barCaritemcantidad'>Cantidad: 20</div>
                                <div class='barCaritemvalor'>$20.000 c/u</div>
                            </div>
                        </div>
        */
    }
    
    function getContenidoCarritoPreview($car){
        if($car==false){
            return "<p>Carrito Vacio</p>";
        }
        
        $return ='';
        foreach($car as $producto){
            $return.="<div id='cc_item_".$producto['id_titulos']."' class='barCaritem' onclick='getItem(\"".$producto['id_titulos']."\");'>".
                        "<div class='barCaritemimagen'><img src='images/nohay.gif'></img></div>".
                        "<div class='barCaritemdetalles'>
                                <div class='barCaritemtitulo'>".$producto['titulo']."</div>
                        </div>".
                      "</div>";
        }
        return $return;
    }
    
    /*
    function loadinTime ($data){
        $contenido = _IMPRESOS.": ". $data['impreso']. "&nbsp;&nbsp;&nbsp;&nbsp;"._EBOOKS.": ". $data['ebook']. "&nbsp;&nbsp;&nbsp;&nbsp;". _VALORITEMS .": $ ".number_format($data['valor'],$_SESSION['decimales']);
        return "<html>
                    <head>
                    <title>Editorial Colombiana, Distribuidora de libros y eBooks. Librería Virtual SiglodelHombre.com</title>
                    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
                    <link rel=\"stylesheet\" href=\"css/style_sh.css\" type=\"text/css\">
                    <script>
                        function timeOut(timeoutPeriod) {
                            setTimeout('location.reload(true);',timeoutPeriod);
                        }
                    </script>
                    </head><body onload='JavaScript:timeOut(4000);'><div class=\"path\" style='text-align:right;align:right;width:200px; display: inline' >".$contenido." </div></body></html>";
    }
    */
    function formEditItemCar($datos){
        
        require_once("app/common/view/classviewCommon.php");
        $detalles = new classviewCommon();
        $view_item =$this->head. $detalles->showDetailsItem($datos['item']);
        
        $impreso_cheked = ($datos['car']['impreso'] > 0 )? 'CHECKED':'';
        $ebook_cheked = ($datos['car']['ebook'] > 0 )? 'CHECKED':'';
        
        $view_item.= "<p>"._COMPRAR.":
                    <form action='index.php'>
                    <table border='0' class='fondo' style='border-color:#ccc; border-width:1px; border-style:solid; margin: 0 0 0 10px;' cellspacing=5 cellpadding=5 >
                        <tr>
                        <th>Formato</th><th>Cantidad</th>
                        <td rowspan='3'>
                        <table border='0' cellspacing='10'>
                        <tr>
                        <td>
                        <input class='fondo' style='margin: 0 20px 0 0;' type='submit' value='"._GUARDARYCONTINUAR."' />
                        </td>
                        <td><a href='index.php?action=listCar' > [ Cancelar ] </a>
                        </td>
                        </tr>
                        </table>
                        </td>
                        </tr>
                        <tr>
                        <td><input type='checkbox' name='fimpreso' id='fimpreso' class='fondo' ".$impreso_cheked." />Impreso</td>
                        <td><select class='fondo' id='imcant' name='imcant' onChange='activarCheckbox(\"fimpreso\",this);'>";
       
        for($i=0;$i<=_MAXITEMSSHOP;$i++){
            $impreso_selected = ($i == $datos['car']['impreso'] )? 'SELECTED':'';
            
            $view_item.="<option value='".$i."' ".$impreso_selected.">".$i."</option>";
        }

        $view_item.="</select></td>
                        </tr>
                        <tr>
                        <td><input type='checkbox' name='felectronico' id='felectronico'  class='fondo' ".$ebook_cheked." />E-Book</td>
                        <td><select class='fondo' id='fecant' name='fecant' onChange='activarCheckbox(\"felectronico\",this);'>";
        
        for($i=0;$i<=_MAXITEMSSHOP;$i++){
            $ebook_selected = ($i == $datos['car']['ebook'] )? 'SELECTED':'';
            
            $view_item.="<option value='".$i."' ".$ebook_selected.">".$i."</option>";
        }
        
        $view_item.="</select></td>
                        </tr>
                    </table>
                    <input type='hidden' name='iditem' id='iditem' value='".$datos['item']['id_titulos']."' />  
                    <input type='hidden' name='action' value='saveeditItemCar' />
                    </form></p>
                    <script>
                        function activarCheckbox(idbox,select){
                            if(select.value > 0){
                                document.getElementById(idbox).checked = true;
                            }else{
                                document.getElementById(idbox).checked = false;
                            }
                        }
                    </script>
                    ";
        
        
        return $view_item;
    }
    
    function ingresoCarrito(){
        return "<div style='text-align:center;'><h3>"._ITEMINGRESADO."</h3></div>";
    }
    
}

?>
