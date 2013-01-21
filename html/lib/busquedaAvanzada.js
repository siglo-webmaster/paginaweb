/*Funciones de control para la maquina de busqueda avanzada*/
jQuery.noConflict();
jQuery(document).ready(function(){
     jQuery('#searchString').focus();
     //jQuery('#opcionesAvanzadas').hide(0);
     //jQuery('#formulariobusqueda').submit(function(){return false;});
     jQuery('.listadoSearch').hover(function(){jQuery(this).css('cursor','pointer');})
     
     jQuery('#searchString').bind('keyup',function(){
         if(jQuery('#autocomplete').attr('alt')=='false'){
             return;
         }
         if(jQuery('#searchString').val()==''){
            jQuery('#autocomplete').hide(500);
            jQuery('#autocomplete').empty();
            
            return;
        }
        
        //COMPROBAR OPCIONES DE FILTRADO
        //
        //SUSCRIPCIONES
        var f_suscripcion;
        if(jQuery("#f_suscripcion").is(':checked')){
            f_suscripcion='true';
        }else{
            f_suscripcion='false';
        }
        
        //REVISTAS
        var f_revista;
        if(jQuery("#f_revista").is(':checked')){
            f_revista='true';
        }else{
            f_revista='false';
        }
        
        //EBOOK
        var f_ebook;
        if(jQuery("#f_ebook").is(':checked')){
            f_ebook='true';
        }else{
            f_ebook='false';
        }
        
        
        //IMPRESO
        var f_impreso;
        if(jQuery("#f_impreso").is(':checked')){
            f_impreso='true';
        }else{
            f_impreso='false';
        }
        ///FIN COMPROBACION OPCIONESDEFILTRADO
         
         /////OPCIONES AVANZADAS DE FILTRADO
         var id_editoriales = jQuery('#id_editoriales').val();
         if(id_editoriales==null){
             id_editoriales='';
         }
         var id_autores = jQuery('#id_autores').val();
         if(id_autores==null){
             id_autores='';
         }
         var id_categorias = jQuery('#id_categorias').val();
         if(id_categorias==null){
             id_categorias='';
         }
         ////FIN OPCIONES AVANZADAS DE FILTRADO
         
         jQuery.post('busqueda.php',{'action' : 'preview', 
                                    'searchString': jQuery('#searchString').val() ,
                                    'tipoBusqueda':'clasic',
                                    'f_impreso':f_impreso, 
                                    'f_ebook':f_ebook,
                                    'f_revista':f_revista,
                                    'f_suscripcion':f_suscripcion,
                                    'id_editoriales':id_editoriales,
                                    'id_autores':id_autores,
                                    'id_categorias':id_categorias
                                },function($return){
             
             if($return!=''){
                 jQuery('#autocomplete').html($return).show(500);
             }else{
                // jQuery('#autocomplete').hide(500);
             }
             
             return;
         });
     });
     
     jQuery('.checkBoxFormatos').bind('change',function(){
         jQuery("#searchString").trigger('keyup');
     });
     
    jQuery('#verOpcionesAvanzadas').bind('click',function(){
        jQuery('#opcionesBusqueda').empty();
        jQuery('.opcionActiva').removeClass('opcionActiva').addClass('opcionInactiva');
        /*jQuery('#tipoBusqueda').val('clasic');
        switch(jQuery('#verOpcionesAvanzadas').attr('alt')){
            case 'hide':{
                   // jQuery('#autocomplete').attr('alt','true');
                    jQuery('#opcionesAvanzadas').hide(500);
                    jQuery('#verOpcionesAvanzadas').attr('alt','show');
                    jQuery('#verOpcionesAvanzadas').html('Ver Busqueda Avanzada');
                    jQuery('#searchString').trigger('keyup');
                    break;
            }case 'show':{
                    jQuery('#autocomplete').hide(500);
                    //jQuery('#autocomplete').attr('alt','false');
                    jQuery('#opcionesAvanzadas').show(500);
                    jQuery('#verOpcionesAvanzadas').attr('alt','hide');
                    jQuery('#verOpcionesAvanzadas').html('Cerrar Busqueda Avanzada');
                    break;
            }
        }*/
        
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    
    
    /*CARGAR CONTENIDO DE OPCIONES DE BUSQUEDA*/
    jQuery('.opcionInactiva').bind('click',function(){
        jQuery('.opcionActiva').removeClass('opcionActiva').addClass('opcionInactiva');
        jQuery(this).removeClass('opicionInactiva').addClass('opcionActiva');
        jQuery('#tipoBusqueda').val(jQuery(this).attr('alt'));
        switch(jQuery(this).attr('alt')){
            case 'editoriales':{
                    jQuery('#opcionesBusqueda').empty();
                    jQuery('#opcionesBusqueda').load('testBusqueda.php?action=getEditoriales');
                    break;
            }
            case 'autores':{
                    jQuery('#opcionesBusqueda').empty();
                    jQuery('#opcionesBusqueda').load('testBusqueda.php?action=getAutores');
                    break;
            }
            case 'categorias':{
                    jQuery('#opcionesBusqueda').empty();
                    jQuery('#opcionesBusqueda').load('testBusqueda.php?action=getCategorias');
                    break;
            }
            case 'fecha':{
                    
                    jQuery('#opcionesBusqueda').empty();
                    var currentTime = new Date();
                    jQuery('<div class=\'titulo\' id="titulo_fecha"></div>').appendTo(jQuery('#opcionesBusqueda'));
                    jQuery('#titulo_fecha').addClass('titulo');
                    jQuery('#titulo_fecha').html("Fecha edici&oacute;n desde: ");
                    jQuery('<input type="text" name="f_desde" id="f_desde" />').appendTo(jQuery('#opcionesBusqueda'));
                    jQuery('#f_desde').addClass('fechas');
                    jQuery('#f_desde').val(currentTime.getDate());
                    
                    jQuery('<div class=\'titulo\' id="titulo_fecha_hasta"></div>').appendTo(jQuery('#opcionesBusqueda'));
                    jQuery('#titulo_fecha_hasta').addClass('titulo');
                    jQuery('#titulo_fecha_hasta').html(" hasta: ");
                    jQuery('<input type="text" name="f_hasta" id="f_hasta" />').appendTo(jQuery('#opcionesBusqueda'));
                    jQuery('#f_hasta').addClass('fechas');
                    jQuery('.fechas').val(currentTime.getFullYear());
                    
                    break;
            }
        }
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    
   jQuery('.tituloQuickSearch').click(function(){
        alert('hello');
    }).hover(function(){jQuery(this).css('cursor','pointer');});
   
   
   
   jQuery('#loadingBusqueda').ajaxStart(function(){
            jQuery(this).show();
        }).ajaxStop(function() {
            jQuery(this).hide();
        });
   
   
   
});


var getItem = function($codigo){
        jQuery('.overlay').fadeIn(1000).bind('click',function(){
            cerrarpopUp();
        });
        
         jQuery.ajax({type: "GET", url: "testBusqueda.php?action=getItem&registro=" + $codigo , cache: false, dataType: "text",success: function(data) {
            jQuery('#popUp').empty();
            jQuery('<div id="closeButton" class="closeButton"></div>').appendTo('#popUp');
            jQuery('#closeButton').bind('click',function(){cerrarpopUp();}).hover(function(){jQuery(this).css('cursor','pointer');});
            jQuery('<div id="contenedor"></div>').appendTo('#popUp');
            jQuery('#popUp').fadeIn(0);
            jQuery('#contenedor').html(data);
            
         }
         });
        
  };
  
  
  
var addCommas = function(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
    }  
  
var cambioCantidades = function($elemento,$id){
        var $precio;
        var $decimales = document.getElementById('numero_decimales').value;
        $precio = $elemento.value * document.getElementById('precio_'+ $id).value;
        
        jQuery('#subtotal_'+ $id).val(addCommas($precio.toFixed($decimales)));
        calcularTotal();
        
    };

var calcularTotal = function(){
        var total=0;
        var i=0;
        var id_tipos_productos;
        var $decimales = jQuery('#numero_decimales').val();
        jQuery('#total').empty();
        for(i;i<jQuery('#numero_tipos_productos').val();i++){
            id_tipos_productos = jQuery('#id_tipos_productos_' + i).val();
            total =  (jQuery('#precio_'+ id_tipos_productos).val() * document.getElementById('cantidades_'+ id_tipos_productos).value) + total ;
        }
        jQuery('#total').html("$ " + addCommas(total.toFixed($decimales)));
   }

var agregarItem = function(){
        var i = 0 ;
        var id_tipos_productos;
        var productos = ''; //titulo, formato, cantidad, proveedor
        for(i;i<jQuery('#numero_tipos_productos').val();i++){
            id_tipos_productos = jQuery('#id_tipos_productos_' + i).val();
            productos = productos + jQuery('#id_titulos').val() +','+jQuery('#id_tipos_productos_' + i).val() + ',' +(document.getElementById('cantidades_'+ id_tipos_productos).value )+','+(document.getElementById('id_proveedores_'+ id_tipos_productos).value ) +','+(document.getElementById('id_lista_precios').value ) + ';' ;
        }
        
         jQuery.ajax({type: "GET", url: "shoppingCar.php?action=addItem&productos=" + productos , cache: false, dataType: "text",success: function(data) {
                 jQuery('#contenedor').empty();
                 jQuery('#contenedor').html(data);
                 window.setTimeout(cerrarpopUp, 2500);
            }
         })
        
        
    };

var cerrarpopUp = function(){
    jQuery('#popUp').fadeOut(0);
    jQuery('.overlay').fadeOut(1000);
    jQuery('#popUp').empty();
}
