
jQuery(document).ready(function($){
     //TAMAÑOS DE LAS VENTANAS DIALOG
     
   jQuery.getScript("ventanaEmergente.js", function(){});
   jQuery.getScript("funcionesBasicas.js", function(){});
   
   /*FUNCIONES VARIAS */
   var recalcularFletes = function(){
        jQuery('#fletes').val('');
        var $peso = jQuery('#pesoengr').attr('alt');
        var $transportadora = jQuery('#transportadoras').val();
        var $ciudad = jQuery('#ciudades').val();
        
        if(($transportadora=='')||($ciudad == '')){jQuery('#fletes').empty();return;}

        jQuery.ajax({type: "GET", url: "consultasGenericas.php?action=moduloPedidos&opt=consultaFleteTransportadora&transportadora=" +$transportadora+ "&ciudad=" + $ciudad, cache: false, dataType: (jQuery.browser.msie) ? "text" : "xml",success: function(data) {
           var xml = repararXML(data);
            jQuery(xml).find('entry').each(function(){
                var $costo_flete = jQuery(this).find('fletes').text();
                $costo_flete *= ($peso /1000);
                jQuery('#fletes').val($costo_flete);
            });
          }  
        });
        
   }
   
    var verificarCampos = function(){
        return true;
    };
    
    

   /*FIN FUNCIONES VARIAS*/
   
    /*Modulo dedidos*/
        /*Modulo dedidos -> FLETES*/
    
    jQuery('#calcularFletes').bind('click',function(){
        var $id_orden = jQuery(this).attr('alt');
        var $url = "procesarPedido.php?action=Step0&id_orden="+$id_orden+"&fisicos="+jQuery('#fisicos').attr("alt");
        abrirventanaEmergente($url);
        //var $url = 'index.php?action=procesarPedido&id_pedido=' + $id_orden;
        /*
        jQuery('#dialog').empty();
        jQuery('#dialog').load('procesarPedido.php',{'action':'Step0' , 'id_orden':$id_orden,'fisicos':jQuery('#fisicos').attr("alt")});
        jQuery('#dialog').dialog({buttons:{"Guardar":function(){actualizarDireccionDespachoUnica();jQuery("div#dialog").dialog ("close");},"Cancelar":function(){jQuery("div#dialog").dialog ("close");}},modal: true, title: "Direcci&oacute;n de despacho", top : "0px",   width: 650, height: 550, show: "scale", hide: "scale", closeOnEscape: true});
   
        */
       
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    
    
    var actualizarDireccionDespachoUnica = function(){
        jQuery("#direcciondespacho").empty();
        /*CONTACTO*/
        jQuery("<div id='d_contacto'>").appendTo("#direcciondespacho");
        jQuery("#d_contacto").attr('alt',jQuery('#contacto').val()).html("<b>Contacto: </b>" + jQuery('#contacto').val());
        /*TELEFONO*/
        jQuery("<div id='d_telefono'>").appendTo("#direcciondespacho");
        jQuery("#d_telefono").attr('alt',jQuery('#telefono').val()).html("<b>Telefono: </b>" + jQuery('#telefono').val());
        /*EMAIL*/
        jQuery("<div id='d_email'>").appendTo("#direcciondespacho");
        jQuery("#d_email").attr('alt',jQuery('#email').val()).html("<b>Email: </b>" + jQuery('#email').val());
       
       if(jQuery('#fisicos').attr("alt")=='true'){
            /*PAIS*/
            jQuery("<div id='d_pais'>").appendTo("#direcciondespacho");
            jQuery("#d_pais").attr('alt',jQuery('#paises').val()).html("<b>Pais: </b>" + jQuery('#paises').val());
            /*CIUDAD*/
            jQuery("<div id='d_ciudad'>").appendTo("#direcciondespacho");
            jQuery("#d_ciudad").attr('alt',jQuery('#ciudades').val()).html("<b>Ciudad: </b>" + jQuery('#ciudades').val());
            /*TRANSPORTADORA*/
            jQuery("<div id='d_transportadora'>").appendTo("#direcciondespacho");
            jQuery("#d_transportadora").attr('alt',jQuery('#transportadoras').val()).html("<b>Transportadora: </b>" + jQuery('#transportadoras').val());
            /*DIRECCION*/
            jQuery("<div id='d_direccion'>").appendTo("#direcciondespacho");
            jQuery("#d_direccion").attr('alt',jQuery('#direccion').val()).html("<b>Direccion: </b>" + jQuery('#direccion').val());
            /*FLETES*/
            jQuery("<div id='d_fletes'>").appendTo("#direcciondespacho");
            jQuery("#d_fletes").attr('alt',jQuery('#fletes').val()).html("<b>Fletes: </b>" + jQuery('#fletes').val());
            /*OBSERVACIONES*/
            jQuery("<div id='d_observaciones'>").appendTo("#direcciondespacho");
            jQuery("#d_observaciones").attr('alt',jQuery('#observaciones').val()).html("<b>Observaciones: </b>" + jQuery('#observaciones').val());
            
        }
    }
    
    ////////////////// DIRECCIONES DE DESPACHO
    jQuery('.tipodireccion').bind('change',function(){
        var $tipo = jQuery(this).val();
        if($tipo=='unica'){
            jQuery('#calcularFletes').show();
            jQuery('#direcciondespacho').show();
            jQuery('.multi').hide();
        }else{
            jQuery('#calcularFletes').hide();
            jQuery('#direcciondespacho').hide();
            jQuery('.multi').show();
        }
        jQuery('#TipoDir').val($tipo);
    });
    
    jQuery('#arrowMulti').bind('click',function(){
        var $seleccionados = false;
        var $adicionar = new Array();
        var $i=0;
        
        jQuery('.prodSel').each(function($item){
            if(jQuery(this).val()>0){
                $adicionar[$i]= new Array(jQuery(this).attr('title'),jQuery(this).val(),jQuery(this).attr('alt'),jQuery(this).attr('type'));
                $seleccionados = true;
                $i++;
            }
        });
       jQuery('#dialog').empty();
       // $('#dialog').html("Direcci&oacute;n: <input type=text name='direccionenvio' id='direccionenvio' value='' />");
       jQuery('#dialog').load('procesarPedido.php',{'action':'Step0' ,'multi':'true','fisicos': "'"+jQuery('#fisicos').attr("alt")+"'" ,'id_orden': jQuery('#orden').attr('alt')});
       jQuery('#dialog').dialog({modal: true, title: "Agregar direccion de despacho", top : "0px",   width: 650, height: 550, show: "scale", hide: "scale", closeOnEscape: true,close: function(){
            var $itemsSeleccionados = $i;
            var $itemactual ;
            var $pend;
            for($i=0;$i<$itemsSeleccionados;$i++){
                
                $itemactual = new Array($adicionar[$i][0],$adicionar[$i][1],$adicionar[$i][2],$adicionar[$i][3]);
                $pend = '#pend_'+$itemactual[0];
  
                $pend = jQuery($pend).attr('alt');
                $pend = $pend - $itemactual[1] ;

                jQuery('#pend_'+$itemactual[0]).attr('alt',$pend).empty().html($pend);
                jQuery('#enviar_'+$itemactual[0]).empty();
                if($pend>0){
                    var $j =0;
                    jQuery('<option value=' + $j + ' selected >'+ $j +'</option>').appendTo(jQuery('#enviar_'+$itemactual[0]));
                    for ($j=1;$j<=$pend;$j++){
                        jQuery('<option value=' + $j + '>'+ $j +'</option>').appendTo(jQuery('#enviar_'+$itemactual[0]));
                    }
                }
                
                var $fila = jQuery('#numerofilas').val();
                jQuery("<tr id='fila_"+$fila+"' alt='"+$itemactual[0]+"' class='celda1'>"+
                 "<td>"+$itemactual[2]+"</td>"+ //Titulo del libro
             "<td>"+$itemactual[3]+"</td>"+ //Formato
                 "<td><input type=hidden name='tituloh_"+$itemactual[0]+
                "'id='tituloh_"+$itemactual[0]+"' value='"+$itemactual[1]+
                "' /><div id='titulo_"+$itemactual[0]+
                "'></div>"+$itemactual[1]+"</td>"+ //Cantidad
                " <td>"+jQuery('#direccionenvio').val()+"</td>"+ //Direccion de envio
                "<td id='opcion_"+ $fila+"'></td></tr>").appendTo('#itemsProgramados');
                jQuery("<div class='botonborrar' alt='"+$fila+"' id='boton_"+$fila+"'></div>").appendTo('#opcion_'+$fila);
                jQuery("<img  src='images/borrar_small.png' / >").appendTo("#boton_"+$fila);
                
                
                
                
                jQuery("#fila_"+$fila).bind('click',function(){  
                    var $origen = jQuery(this).attr('alt');
                    var $cantidad = jQuery('#tituloh_'+$origen).val();
                    var $cantidadorigen = jQuery('#pend_'+$origen).attr('alt');
                    $cantidadorigen = ($cantidadorigen * 1) + ($cantidad *1);
                    jQuery('#pend_'+$origen).attr('alt',$cantidadorigen).empty().html($cantidadorigen);
                    jQuery(this).empty();
                    
                 }).hover(function(){jQuery(this).css('cursor','pointer');});
                
                
                
                $fila++;
                jQuery('#numerofilas').val($fila);


                
                //alert("titulo:" +$adicionar[$i][0]+ " Valor:" +$adicionar[$i][1]);
            }
        }});
        
    }).hover(function(){jQuery(this).css({'cursor':'pointer','background-color':'yellow'});});
    
    
    
    
    jQuery('.multi').hide();
    /////////////////
    
    
    jQuery('#paises').bind('change', function(){
        
       jQuery('#ciudades').empty();
       jQuery("<option value=''></option>").appendTo('#ciudades');
       
        jQuery.ajax({type: "GET", url: "consultasGenericas.php?action=moduloPedidos&opt=consultaCiudades&pais=" + jQuery('#paises').val(), cache: false, dataType: (jQuery.browser.msie) ? "text" : "xml",success: function(data) {
                
                var xml = repararXML(data);
                
                jQuery(xml).find('entry').each(function(){
                    jQuery('<option value="' + jQuery(this).find('id_ciudades').text() + '">' + jQuery(this).find('nombre').text() + '</option>').appendTo("#ciudades");
                                   // var name_text = $(this).find('NAME').text();
                }); //close each(
            }
        }); //close $.ajax(
        
        recalcularFletes();
    });
    
    
    jQuery('#userbar').load('userLeft.php');
    
    
    jQuery('#ciudades').bind('change',function(){
        recalcularFletes();
    });
    
    
    
    
    jQuery('#transportadoras').bind('change',function(){
        recalcularFletes();
    });
    
 ////////////////////////////////////////////////////////////////
 
 ////Proceso metodo de pago
 /////////////////////////
    jQuery('#botonMetodoPago').bind('click',function(){
       switch(jQuery('#TipoDir').val()){
            case 'unica':{
                    pedidosPaso2();
                    break;
            }
            case 'varias':{
                    alert('varias');
                    break;
            }
       }
                
    });
    
    //////////////////////
    
    jQuery('#botonMetodoPago').bind('clickn',function(){
        
        switch(jQuery('#TipoDir').val()){
            case 'unica':{
                    /*/*
                     *Corroborar los campos de email, contacto y telefono
                     **/
                    if((jQuery('#d_email').attr('alt')==undefined)||(jQuery('#d_email').attr('alt')=='')){
                        alert("Debe ingresar una direccion de correo");
                        return(0);
                    }
                    if((jQuery('#d_contacto').attr('alt')==undefined)||(jQuery('#d_contacto').attr('alt')=='')){
                        alert("Debe ingresar un nombre de contacto");
                        return(0);
                    }
                    if((jQuery('#d_telefono').attr('alt')==undefined)||(jQuery('#d_telefono').attr('alt')=='')){
                        alert("Debe ingresar un numero telefonico");
                        return(0);
                    }
                    
                    /**FIN CORROBORAR CAMPOS CONTACTO EMAIL Y TELEFONO**/
                    
                    /*COMPOROBAR SI SON FISICOS O VIRTUALES*/
                    if(jQuery('#fisicos').attr('alt')=='false'){ ///SOLO LIBROS VIRUTALES
                       var $url =  "procesarPedido.php?action=guardarDireccionDespacho&id_orden=" + jQuery('#orden').attr('alt') + "&tipo_envio=unico_virtual&email="+jQuery('#d_email').attr('alt')+"&contacto="+jQuery('#d_contacto').attr('alt')+"&telefono="+jQuery('#d_telefono').attr('alt'); 
                       jQuery.ajax({type: "GET", url: $url , cache: false, dataType: (jQuery.browser.msie) ? "text" : "xml",success: function(data) {
                                var xml = repararXML(data);
                                jQuery(xml).find('entry').each(function(){
                                    var $estado = jQuery(this).find('estado').text();
                                    if($estado=='true'){
                                        pedidosPaso2();
                                    }else{
                                       alert("problemas al guardar");
                                       return 0;
                                       //  pedidosPaso2();
                                    }
                                       
                                }); //close each(
                            }
                        });
                        return 0;

                    }else{
                       
                        /*CAMPOS ADICIONALES PARA VENTA EN FISICO*/
                        if((jQuery('#d_pais').attr('alt')==undefined)||(jQuery('#d_pais').attr('alt')=='')){
                            alert("No selecciono un pais valido");
                            return(0);
                        }
                        
                        if((jQuery('#d_ciudad').attr('alt')==undefined)||(jQuery('#d_ciudad').attr('alt')=='')){
                            alert("Debe ingresar una ciudad valida");
                            return(0);
                        }

                        if((jQuery('#d_transportadora').attr('alt')==undefined)||(jQuery('#d_transportadora').attr('alt')=='')){
                            alert("Debe seleccionar una transportadora");
                            return(0);
                        }
                        
                        if((jQuery('#d_direccion').attr('alt')==undefined)||(jQuery('#d_direccion').attr('alt')=='')){
                            alert("Debe ingresar una direccion para despacho fisico");
                            return(0);
                        }
                        
                        if((jQuery('#d_fletes').attr('alt')==undefined)||(jQuery('#d_fletes').attr('alt')=='')){
                            alert("Error en fletes calculados");
                            return(0);
                        }
                        
                        if(jQuery('#d_observaciones').attr('alt')==undefined){
                            jQuery('#d_observaciones').attr('alt','');
                        }
                        
                        var $url =  "procesarPedido.php?action=guardarDireccionDespacho&id_orden="+ jQuery('#orden').attr('alt') 
                                + "&tipo_envio=unico_fisico&email="+ jQuery('#d_email').attr('alt')
                                + "&contacto="+jQuery('#d_contacto').attr('alt')
                                + "&telefono="+jQuery('#d_telefono').attr('alt')
                                + "&pais="+jQuery('#d_pais').attr('alt')
                                + "&ciudad="+jQuery('#d_ciudad').attr('alt')
                                + "&transportadora="+jQuery('#d_transportadora').attr('alt')
                                + "&direccion="+jQuery('#d_direccion').attr('alt')
                                + "&fletes="+jQuery('#d_fletes').attr('alt')
                                + "&observaciones="+jQuery('#d_observaciones').attr('alt')
                                ; 
                       jQuery.ajax({type: "GET", url: $url , cache: false, dataType: (jQuery.browser.msie) ? "text" : "xml",success: function(data) {
                                var xml = repararXML(data);
                                jQuery(xml).find('entry').each(function(){
                                    var $estado = jQuery(this).find('estado').text();
                                    if($estado=='true'){
                                        pedidosPaso2();
                                    }else{
                                        alert("problemas al guardar direccion despacho");
                                        return 0;
                                      //   pedidosPaso2();
                                    }
                                       
                                }); //close each(
                            }
                        });
                        
                        return 0;
                        
                        
                    }
                    break;
            }
            case 'varias':{
                    if(jQuery('#fisicos').attr('alt')=='false'){
                        alert("solo virtuales");

                    }else{
                        alert("fisicos");
                    }
                    break;
            }
        }
        
        if(jQuery('#d_email').attr('alt')=='undefined'){
            alert("email indefinido");
        }else{
            alert(jQuery('#d_email').attr('alt'));
        }
        return;
        jQuery('#CuerpoPedido').empty();
        jQuery('#CuerpoPedido').load('procesarPedido.php',{'action':'Step2' , 'id_orden':jQuery(this).attr('alt')});
        return;
        jQuery.ajax({type: "GET", url: "procesarPedido.php?action=guardarDireccionDespacho&id_orden=" + jQuery('#id_orden').val() + "&fisicos=" + jQuery('#fisicos').attr('alt') , cache: false, dataType: (jQuery.browser.msie) ? "text" : "xml",success: function(data) {
                var xml = repararXML(data);
                jQuery(xml).find('entry').each(function(){
                    jQuery('<option value="' + jQuery(this).find('id_ciudades').text() + '">' + jQuery(this).find('nombre').text() + '</option>').appendTo("#ciudades");
                                   // var name_text = $(this).find('NAME').text();
                }); //close each(
            }
        }); //close $.ajax(
        
        
       // $('#dialog').load('procesarPedido.php',{'action':'Step2' , 'id_orden':$(this).attr('alt')});
       //$('#dialog').dialog({modal: true, position:"top",title:"Medios de Pago", width: 590, height:600, show: "scale", hide: "scale", closeOnEscape: true});
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    
    
        /*FIN Modulo dedidos -> FLETES*/
    /*PLATAFORMAS DE PAGO*/   
        var pedidosPaso2 = function (){
            var $orden = jQuery('#orden').attr('alt');
            
            //$("#CuerpoPedido").load('procesarPedido.php',{'action':'Step2' , 'id_orden':$orden});
            
            jQuery.ajax({type: "GET", url: "procesarPedido.php?action=Step2&id_orden=" + $orden , cache: false, dataType: (jQuery.browser.msie) ? "text" : "xml",success: function(data) {
                    
                    var xml = repararXML(data);
                   jQuery("#CuerpoPedido").empty();
                   jQuery("<div id='cabecera'></div>").appendTo("#CuerpoPedido");
                   jQuery('#cabecera').html("<h3>Seleccion de medio de pago</h3>");
                    jQuery("<div id='mediospago'></div>").appendTo("#CuerpoPedido");
                    jQuery(xml).find('entry').each(function(){
                        var $id_proveedor = jQuery(this).find('id_plataforma_pago').text();
                        var $nombre = jQuery(this).find('nombre').text();
                        var $imagen = jQuery(this).find('imagen').text();
                        jQuery("<div class='medioPago' id='m_"+$id_proveedor+"' alt='"+$orden+"' title='"+$id_proveedor+"'></div>").appendTo("#mediospago"); 
                        jQuery("#m_"+$id_proveedor).css('float', 'left');
                        //jQuery("#m_"+$id_proveedor).html("<a href='gateway.php?action=cargarPlataforma&orden="+$orden+"&id="+$id_proveedor+"' target='_blank' onClick=\"window.open(this.href, this.target, 'width=1000,height=600'); return false;\"><img src='" + $imagen+"' /><p>"+$nombre+"</p></a>");
                        jQuery("#m_"+$id_proveedor).html("<a href='gateway.php?action=cargarPlataforma&orden="+$orden+"&id="+$id_proveedor+"' target='_blank' onClick=\"abrirventanaEmergente(this.href); return false;\"><img src='" + $imagen+"' /><p>"+$nombre+"</p></a>");
                        /*
                        $("#m_"+$id_proveedor).bind('click',function(){
                            var $orden = $(this).attr('alt');
                            var $plataforma = $(this).attr('title');
                            $('#dialog').empty();
                            $('#dialog').load('gateway.php',{'action':'cargarPlataforma' , 'orden': $orden,'id':$plataforma });
                            $('#dialog').dialog({modal: true, title: "Plataformas de pago disponibles", top : "0px",   width: 800, height: 600, show: "scale", hide: "scale", closeOnEscape: true});
                            return;
                        });
                        */
                    }); //close each(
                }
            }); //close $.ajax(
            
            return;
        }
        
    /*FIN PLATAFORMAS DE PAGO*/
/*FIN Modulo dedidos*/
/*FIN FORMULARIOS*/
    
   
});