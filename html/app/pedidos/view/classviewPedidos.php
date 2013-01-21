<?php
/**
 * Description of classviewPedidos
 *
 * @author oborja
 */
class classviewPedidos {
    public $head;
    
    function __construct (){
        if(!isset($_SESSION['decimales'])){
            $_SESSION['decimales']=0;
        }
        $this->head= '<table width="75%" cellspacing="0" cellpadding="0" border="0">
              <tbody><tr> 
                <td height="20" bgcolor="#990000">&nbsp;</td>
              </tr>
              <tr> 
                <td>
                        <font color="#990000"><span class="titulo_cat">Pedidos</span></font>
                        </td>
               </tr>
                </table> 
                    ';
    }
    
    function listarPedidos($data){
        if(!(sizeof($data)>0)) return $this->head."<p>Fitrar por estado: <a href='index.php?action=listarPedidos&opt=todos'>Todos</a> - <a href='index.php?action=listarPedidos&opt=activos'>Activos</a> - <a href='index.php?action=listarPedidos&opt=enproceso'>En Proceso</a> - <a href='index.php?action=listarPedidos&opt=cerrados'>Cerrados<a></p>";
        $return =$this->head;
        $return.="<p>Fitrar por estado: <a href='index.php?action=listarPedidos&opt=todos'>Todos</a> - <a href='index.php?action=listarPedidos&opt=activos'>Activos</a> - <a href='index.php?action=listarPedidos&opt=enproceso'>En Proceso</a> - <a href='index.php?action=listarPedidos&opt=cerrados'>Cerrados<a></p>";
        $return.= "<table id='zebra' class='path'>
            <thead>
            <tr>
            <th>"._NPEDIDO."</th>
            <th>"._FPEDIDO."</th>
            <th>"._VPEDIDO."</th>
            <th>"._MPEDIDO."</th>
            <th>"._ESTADOPEDIDO."</th>
            <th>"._OPCIONES."</th>
            </tr></thead><tbody>";
        
        foreach($data as $row){
            switch($row['estado_orden']){
                case _ACTIVA:{
                    $opciones_pedido = "<a href='index.php?action=procesarPedido&id_pedido=".$row['id_ordenes']."'>"._PROCESARPEDIDO."</a> | 
                        <a href='index.php?action=borrarPedido&id_pedido=".$row['id_ordenes']."'>"._BORRAR."</a>";
                    break;   
                }
                case _ENPROCESO:{
                    $opciones_pedido = "<a href='index.php?action=verDetalles&id_pedido=".$row['id_ordenes']."'>ver detalles</a>";
                    break;   
                }
                case _PROCESADA:
                case _ANULADA: {
                    $opciones_pedido = "<a href='index.php?action=verDetalles&id_pedido=".$row['id_ordenes']."'>Ver detalles</a>";
                    break;   
                }
            }
            $return.="<tr>
                <td>".$row['id_ordenes']."</td>".
                    "<td>".$row['fecha_creacion']."</td>".
                    "<td>$ ".number_format($row['valor'],$_SESSION['decimales'])."</td>".
                    "<td>".$row['moneda']."</td>".
                    "<td>".$row['estado_orden']."</td>".
                    "<td>".$opciones_pedido."</td>".
                "</tr>";
        }
        $return.='</tbody></table>';
        return $return;
    }
    
    function formdatosPedidoCliente($data){
        if(!(sizeof($data['details'])>0)) return _NOITEMSENELPEDIDO;
        $return =$this->head;
        $separador="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        
        if(sizeof($data['detalles_transportadoras'])>0){
            $boton_pago='<div id="botonMetodoPago" class="enlaceboton" alt="'.$data['brief'][0]['id_ordenes'].'">Continuar con el proceso de pago</div>';
            foreach($data['detalles_transportadoras'] as $row){
                $detalles_transportadora='<h3>Informaci&oacute;n de despacho:</h3><p>';
                $detalles_transportadora.=" <strong>Cont&aacute;cto:</strong>".$row['nombre_destinatario'];
                $detalles_transportadora.=" <strong>Direcci&oacute;n:</strong>".$row['direccion_entrega'];
                $detalles_transportadora.=" ".$row['nombre_ciudad'];
                $detalles_transportadora.=",".$row['nombre_pais'];
                $detalles_transportadora.="<br><strong>Tel&eacute;fono:</strong> ".$row['telefono_destinatario'];
                $detalles_transportadora.=" <strong>E-mail:</strong>".$row['email_destinatario'];
                $detalles_transportadora.="<br><strong>Transportadora:</Strong>".$row['nombre_transportadora'];
                $detalles_transportadora.="<br><strong>Observaci&oacute;nes:</strong>".$row['observaciones'];
                $detalles_transportadora.="</p>";
                
                $total ="<strong>Total:</strong>$".  number_format($data['brief'][0]['valor'] + $data['brief'][0]['fletes'],$_SESSION['decimales'])." ".$data['brief'][0]['moneda'];
                $fletes ="<strong>Fletes:</strong>$".number_format($data['brief'][0]['fletes'],$_SESSION['decimales'])." ".$data['brief'][0]['moneda'];
            }
            
        }else{
            $boton_pago='';
            $detalles_transportadora="Aun no ha definido direcci&oacuten de despacho";
            $total = "";
            $fletes='';
        }
        
        
        
        $return.= "
            <div id='CuerpoPedido'>
            <p>
            
            <table class='zebra1' >
                <tr>
                <td><div id='orden' alt='".$data['brief'][0]['id_ordenes']."'> <strong>Orden # :</strong>".$data['brief'][0]['id_ordenes']."</div></td>
                <td><strong>Fecha Pedido: </strong>".$data['brief'][0]['fecha_creacion']."</td>
                <td><strong>Peso: </strong>".number_format($data['brief'][0]['peso'])." gramos</td>
                <td ><strong>Subtotal:</strong> $ ".(number_format($data['brief'][0]['valor'],$_SESSION['decimales']))." ".$data['brief'][0]['moneda']."    </td>
                    <td>".$fletes."</td>
                <td>".$total."</td>
                </tr>
           </table>
           <table>
            <tr>
                <td><div class='enlaceboton' id='calcularFletes' alt='".$data['brief'][0]['id_ordenes']."' >Cambiar Direcci&oacute;n de despacho</div></td>
                <td>".$boton_pago."</td>    
                </tr>
            </table>
               </p>
               
               <p><div id='direcciondespacho' style='margin: 5px 0 10px 30px;'>".$detalles_transportadora."</div></p>
             
               <div class='zebra1'>
                <input type='radio' name='selecdireccion' class='tipodireccion' value='unica' checked />Usar una &uacute;nica direcci&oacute;n para el envio <br />
                
                  <input type='hidden' name='TipoDir' id='TipoDir' value='unica' />
                    
                    
                 <input type='radio' name='selecdireccion' class='tipodireccion' value='varias' />Usar varias direcci&oacute;nes para el envio
                </div>";
        
        
        
        ////// SELECCION DE  ENVIO 
        
        $return.="<p><table border=0 width=100%>
            <tr style='vetical-align:top;'>
            <td width=49% vertical-align:top;>";
        
        ///////////////TABLA IZQUIERDA
        $fisicos='false';
        $return.="<table  class='zebra1' style='border-color:#aaa;border-width:1px;border-style:solid;'>
            <thead>
            <tr>
            <th>"._TITULO."</th>
            <th>Tipo</th>
            <th >Peso</th>
            <th>Cant</th>
            <th>Pend</th>
            <th  class='multi' >Enviar</th>
            </tr></thead><tbody id='items'>";
        foreach($data['details'] as $row){
            if($row['id_tipos_productos']!=2){$fisicos='true';}
            $select = "<select name='enviar_".$row['id_titulos']."_".$row['tipo_producto']."' id='enviar_".$row['id_titulos']."_".$row['tipo_producto']."' class='prodSel' title='".$row['id_titulos']."_".$row['tipo_producto']."' type='".$row['tipo_producto']."' alt=\"".$row['titulo']."\">";
            for($i=0;$i<=$row['cantidad'];$i++){
                $select.="<option value='$i'>$i</option>";
            }
            $select.="</select>";
            $peso = ($row['id_tipos_productos']==1)?$row['peso']:0;
            $return.="<tr>
                    <td>".$row['titulo']."</td>
                    <td>".$row['tipo_producto']."</td>
                    <td>".$peso." gr</td>    
                    <td>".$row['cantidad']."</td>
                    <td><div id='pend_".$row['id_titulos']."_".$row['tipo_producto']."' alt='".$row['cantidad']."'>".$row['cantidad']."</div></td>
                    <td class='multi'>$select</td>
                    
                    </tr>";
                    
        }
        $return.="</tbody></table>
           </td> ";
        
        $return.='<div id="fisicos" alt="'.$fisicos.'"></div>';
        
        /////////////SEPARADOR ////////
        $return.="<td  class='multi' id='arrowMulti' ><img src='images/flechaverde.png' alt='agregar'></td>";
        ///////////////////////
        
        
        
        
        ///////////////TABLA DERECHA
         
        
        $return.="<input type=hidden id='numerofilas' value='0' /><td class='multi' style='vertical-align:top;' width=50%>
            <table class='zebra1' style='border-color:#aaa;border-width:1px;border-style:solid;' width=100%    >
            <thead>
            <tr>
            <th>"._TITULO."</th>
            <th>Tipo</th>
            <th>Cant</th>
            <th>direcci&oacute;n</th>
            </tr></thead><tbody id='itemsProgramados'>";
        
        $return.="</tbody></table>
            ";
        
        /////////////////
        
        
        $return .="</td></tr></table></p><br/>";
        
        ///////////
        /*
        if(!strncmp($data['brief'][0]['estado_despacho'],_SINDATOS,sizeof(_SINDATOS)) ){
            $return.='<div id="botonMetodoPago" class="enlaceboton" alt="'.$data['brief'][0]['id_ordenes'].'">Continuar con el proceso de pago</div>';
        }
         * 
         */
        ////////////
        
        return $return."</div>";
    }

    
      function detallesPedidoCliente($data){
        if(!(sizeof($data['details'])>0)) return _NOITEMSENELPEDIDO;
        $return =$this->head;
        $separador="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        
        if(sizeof($data['detalles_transportadoras'])>0){
            $boton_pago='<div id="botonMetodoPago" class="enlaceboton" alt="'.$data['brief'][0]['id_ordenes'].'">Continuar con el proceso de pago</div>';
            foreach($data['detalles_transportadoras'] as $row){
                $detalles_transportadora='<h3>Informaci&oacute;n de despacho:</h3><p>';
                $detalles_transportadora.=" <strong>Cont&aacute;cto:</strong>".$row['nombre_destinatario'];
                $detalles_transportadora.=" <strong>Direcci&oacute;n:</strong>".$row['direccion_entrega'];
                $detalles_transportadora.=" ".$row['nombre_ciudad'];
                $detalles_transportadora.=",".$row['nombre_pais'];
                $detalles_transportadora.="<br><strong>Tel&eacute;fono:</strong> ".$row['telefono_destinatario'];
                $detalles_transportadora.=" <strong>E-mail:</strong>".$row['email_destinatario'];
                $detalles_transportadora.="<br><strong>Transportadora:</Strong>".$row['nombre_transportadora'];
                $detalles_transportadora.="<br><strong>Observaci&oacute;nes:</strong>".$row['observaciones'];
                $detalles_transportadora.="</p>";
                
                $total ="<strong>Total:</strong>$".  number_format($data['brief'][0]['valor'] + $data['brief'][0]['fletes'],$_SESSION['decimales'])." ".$data['brief'][0]['moneda'];
                $fletes ="<strong>Fletes:</strong>$".number_format($data['brief'][0]['fletes'],$_SESSION['decimales'])." ".$data['brief'][0]['moneda'];
            }
            
        }else{
            $boton_pago='';
            $detalles_transportadora="";
            $total = "";
            $fletes='';
        }
        
        
        
        $return.= "
            <div id='CuerpoPedido'>
            <p>
            
            <table class='zebra1' >
                <tr>
                <td><div id='orden' alt='".$data['brief'][0]['id_ordenes']."'> <strong>Orden # :</strong>".$data['brief'][0]['id_ordenes']."</div></td>
                <td><strong>Fecha Pedido: </strong>".$data['brief'][0]['fecha_creacion']."</td>
                <td><strong>Peso: </strong>".number_format($data['brief'][0]['peso'])." gramos</td>
                <td ><strong>Subtotal:</strong> $ ".(number_format($data['brief'][0]['valor'],$_SESSION['decimales']))." ".$data['brief'][0]['moneda']."    </td>
                    <td>".$fletes."</td>
                <td>".$total."</td>
                </tr>
           </table>
               </p>
               
               <p><div id='direcciondespacho' style='margin: 5px 0 10px 30px;'>".$detalles_transportadora."</div></p>";
        
        
        
        ////// SELECCION DE  ENVIO 
        
        $return.="<p><table border=0 width=100%>
            <tr style='vetical-align:top;'>
            <td width=49% vertical-align:top;>";
        
        ///////////////TABLA IZQUIERDA
        $fisicos='false';
        $return.="<table  class='zebra1' style='border-color:#aaa;border-width:1px;border-style:solid;'>
            <thead>
            <tr>
            <th>"._TITULO."</th>
            <th>Tipo</th>
            <th >Peso</th>
            <th>Cant</th>
            <th>Pend</th>
            <th  class='multi' >Enviar</th>
            </tr></thead><tbody id='items'>";
        foreach($data['details'] as $row){
            if($row['id_tipos_productos']!=2){$fisicos='true';}
            $select = "<select name='enviar_".$row['id_titulos']."_".$row['tipo_producto']."' id='enviar_".$row['id_titulos']."_".$row['tipo_producto']."' class='prodSel' title='".$row['id_titulos']."_".$row['tipo_producto']."' type='".$row['tipo_producto']."' alt=\"".$row['titulo']."\">";
            for($i=0;$i<=$row['cantidad'];$i++){
                $select.="<option value='$i'>$i</option>";
            }
            $select.="</select>";
            $peso = ($row['id_tipos_productos']==1)?$row['peso']:0;
            $return.="<tr>
                    <td>".$row['titulo']."</td>
                    <td>".$row['tipo_producto']."</td>
                    <td>".$peso." gr</td>    
                    <td>".$row['cantidad']."</td>
                    <td><div id='pend_".$row['id_titulos']."_".$row['tipo_producto']."' alt='".$row['cantidad']."'>".$row['cantidad']."</div></td>
                    <td class='multi'>$select</td>
                    
                    </tr>";
                    
        }
        $return.="</tbody></table>
           </td> ";
        
        $return.='<div id="fisicos" alt="'.$fisicos.'"></div>';
        
        /////////////SEPARADOR ////////
        $return.="<td  class='multi' id='arrowMulti' ><img src='images/flechaverde.png' alt='agregar'></td>";
        ///////////////////////
        
        
        
        
        ///////////////TABLA DERECHA
         
        
        $return.="<input type=hidden id='numerofilas' value='0' /><td class='multi' style='vertical-align:top;' width=50%>
            <table class='zebra1' style='border-color:#aaa;border-width:1px;border-style:solid;' width=100%    >
            <thead>
            <tr>
            <th>"._TITULO."</th>
            <th>Tipo</th>
            <th>Cant</th>
            <th>direcci&oacute;n</th>
            </tr></thead><tbody id='itemsProgramados'>";
        
        $return.="</tbody></table>
            ";
        
        /////////////////
        
        
        $return .="</td></tr></table></p><br/>";
        
        ///////////
        /*
        if(!strncmp($data['brief'][0]['estado_despacho'],_SINDATOS,sizeof(_SINDATOS)) ){
            $return.='<div id="botonMetodoPago" class="enlaceboton" alt="'.$data['brief'][0]['id_ordenes'].'">Continuar con el proceso de pago</div>';
        }
         * 
         */
        ////////////
        
        return $return."</div>";
    }

    
    
    function formularioFletes($data,$datos_pedido){
      if(!sizeof($datos_pedido['detalles_transportadoras'])>0){
          $datos_pedido['detalles_transportadoras'][0]['id_paises']='';
          $datos_pedido['detalles_transportadoras'][0]['id_ciudades']='';
          $datos_pedido['detalles_transportadoras'][0]['nombre_ciudad']='';
          $datos_pedido['detalles_transportadoras'][0]['id_transportadoras']='';
          $datos_pedido['detalles_transportadoras'][0]['nombre_destinatario']='';
          $datos_pedido['detalles_transportadoras'][0]['telefono_destinatario']='';
          $datos_pedido['detalles_transportadoras'][0]['email_destinatario']='';
          $datos_pedido['detalles_transportadoras'][0]['direccion_entrega']='';
          $datos_pedido['detalles_transportadoras'][0]['observaciones']='';
      }
      
        $paises = "
            <select name='paises' id='paises' >
                    <option value='' SELECTED></option>";
        foreach($data['paises'] as $row){
            if($datos_pedido['detalles_transportadoras'][0]['id_paises']==$row['id_paises']){
                $selected=" SELECTED ";
            }else{
                $selected = "";
            }
            $paises.="<option value='".$row['id_paises']."' $selected >".$row['nombre']."</option>";
        }
        $paises.="</select>";
        
        $ciudades = "<select name='ciudades' id='ciudades' >
                    <option value='".$datos_pedido['detalles_transportadoras'][0]['id_paises']."' SELECTED >".$datos_pedido['detalles_transportadoras'][0]['nombre_ciudad']."</option>";
        
        $ciudades.="</select>";
        
        $transportadoras = "<select name='transportadoras' id='transportadoras' >
                    <option value='' SELECTED></option>";
        foreach($data['transportadoras'] as $row){
            if($datos_pedido['detalles_transportadoras'][0]['id_transportadoras']==$row['id_transportadoras']){
                $selected=' SELECTED ';
            }else{
                $selected='';
            }
            $transportadoras.="<option value='".$row['id_transportadoras']."' $selected >".$row['nombre']."</option>";
        }
        $transportadoras.="</select>";
        $css_fisicos = (!strcmp($data['fisicos'],'true'))?'envioFisico':'ocultarenvioFisico';
        $return = "<h3 >Calculo de fletes para el env&iacute;o</h3>
         <form action='procesarPedido.php'>
        <input type='hidden' name='action' value='Step1' />
        <input type='hidden' name='id_orden' value='".$data['id_orden']."' />
        Contacto: <input type='text' name='contacto' id='contacto'size=25 value=\"".$datos_pedido['detalles_transportadoras'][0]['nombre_destinatario']."\"/>
        Tel&eacute;fono: <input type=text name='telefono' id='telefono' size=15  value=\"".$datos_pedido['detalles_transportadoras'][0]['telefono_destinatario']."\"/>
        E-mail: <input type='text' name='email' id='email  ' size='40' value=\"".$datos_pedido['detalles_transportadoras'][0]['email_destinatario']."\"/>
        Pais: ".$paises."
        Ciudad: ".$ciudades."
        Enviar por:".$transportadoras."
        Direccion de env&iacute;o:<input type=text  name='direccion' id='direccion' size='40' value=\"".$datos_pedido['detalles_transportadoras'][0]['direccion_entrega']."\"/>
        <div id='pesoengr' alt='".$data['peso']."'>Peso: ".number_format($data['peso'])."gr </div>
        Valor del envio: $<input type='text' name='fletes' id='fletes' value='".($datos_pedido['brief'][0]['fletes'])."' READONLY /   size='12'>
        Observaciones del envio:<br / ><textarea rows=5 cols=50 name='observaciones' id='observaciones'>".$datos_pedido['detalles_transportadoras'][0]['observaciones']."</textarea>
        <input type='submit' value='Guardar'></input>
        </form>";
        
        return $return;
    }
    
    function formularioFletesMulti($data,$datos_pedido){
      if(!sizeof($datos_pedido['detalles_transportadoras'])>0){
          $datos_pedido['detalles_transportadoras'][0]['id_paises']='';
          $datos_pedido['detalles_transportadoras'][0]['id_ciudades']='';
          $datos_pedido['detalles_transportadoras'][0]['nombre_ciudad']='';
          $datos_pedido['detalles_transportadoras'][0]['id_transportadoras']='';
          $datos_pedido['detalles_transportadoras'][0]['nombre_destinatario']='';
          $datos_pedido['detalles_transportadoras'][0]['telefono_destinatario']='';
          $datos_pedido['detalles_transportadoras'][0]['email_destinatario']='';
          $datos_pedido['detalles_transportadoras'][0]['direccion_entrega']='';
          $datos_pedido['detalles_transportadoras'][0]['observaciones']='';
      }
      
        $paises = "
            <select name='paises' id='paises' >
                    <option value='' SELECTED></option>";
        foreach($data['paises'] as $row){
            if($datos_pedido['detalles_transportadoras'][0]['id_paises']==$row['id_paises']){
                $selected=" SELECTED ";
            }else{
                $selected = "";
            }
            $paises.="<option value='".$row['id_paises']."' $selected >".$row['nombre']."</option>";
        }
        $paises.="</select>";
        
        $ciudades = "<select name='ciudades' id='ciudades' >
                    <option value='".$datos_pedido['detalles_transportadoras'][0]['id_paises']."' SELECTED >".$datos_pedido['detalles_transportadoras'][0]['nombre_ciudad']."</option>";
        
        $ciudades.="</select>";
        
        $transportadoras = "<select name='transportadoras' id='transportadoras' >
                    <option value='' SELECTED></option>";
        foreach($data['transportadoras'] as $row){
            if($datos_pedido['detalles_transportadoras'][0]['id_transportadoras']==$row['id_transportadoras']){
                $selected=' SELECTED ';
            }else{
                $selected='';
            }
            $transportadoras.="<option value='".$row['id_transportadoras']."' $selected >".$row['nombre']."</option>";
        }
        $transportadoras.="</select>";
        $css_fisicos = (!strcmp($data['fisicos'],'true'))?'envioFisico':'ocultarenvioFisico';
        $return = "<h3 >Calculo de fletes para el env&iacute;o</h3>
         <form action='procesarPedido.php'>
        <input type='hidden' name='action' value='Step1' />
        <input type='hidden' name='id_orden' value='".$data['id_orden']."' />
        Contacto: <input type='text' name='contacto' id='contacto'size=25 value=\"".$datos_pedido['detalles_transportadoras'][0]['nombre_destinatario']."\"/>
        Tel&eacute;fono: <input type=text name='telefono' id='telefono' size=15  value=\"".$datos_pedido['detalles_transportadoras'][0]['telefono_destinatario']."\"/>
        E-mail: <input type='text' name='email' id='email  ' size='40' value=\"".$datos_pedido['detalles_transportadoras'][0]['email_destinatario']."\"/>
        Pais: ".$paises."
        Ciudad: ".$ciudades."
        Enviar por:".$transportadoras."
        Direccion de env&iacute;o:<input type=text  name='direccion' id='direccion' size='40' value=\"".$datos_pedido['detalles_transportadoras'][0]['direccion_entrega']."\"/>
        <div id='pesoengr' alt='".$data['peso']."'>Peso: ".number_format($data['peso'])."gr </div>
        Valor del envio: $<input type='text' name='fletes' id='fletes' value='".($datos_pedido['brief'][0]['fletes'])."' READONLY /   size='12'>
        Observaciones del envio:<br / ><textarea rows=5 cols=50 name='observaciones' id='observaciones'>".$datos_pedido['detalles_transportadoras'][0]['observaciones']."</textarea>
        <input type='submit' value='Guardar'></input>
        </form>";
        
        return $return;
    }
    
    function seleccionarMetodoPago($mediospago,$id_orden){
        
        require_once("app/common/view/classviewXML.php");
        
        $xml = new classviewXML();
        $xml->generarListado($mediospago);
        return $xml->string;
         
    }
}

?>