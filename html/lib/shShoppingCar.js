jQuery(document).ready(function(){
    
    jQuery('#windowButton').bind('click',function(){
        var ccInterval;
        switch(jQuery('#barCar').attr('alt')){
            case 'closed':{
                    jQuery('#barCardetalle').load('shoppingCar.php?action=getContenidoCarritoPreview');
                    jQuery('#barCardetalle').show();
                    jQuery('#barCar').attr('alt','opened');
                    jQuery('#windowButton').empty().html('-');
                    jQuery('#verMas').show();
                    ccInterval = setInterval(function(){
                            jQuery('#barCardetalle').load('shoppingCar.php?action=getContenidoCarritoPreview');
                    }, 1000);
                    
                    break;
            }
            case 'opened':{
                    jQuery('#barCardetalle').hide().empty();
                    clearInterval(ccInterval);
                    jQuery('#barCar').attr('alt','closed');
                    jQuery('#windowButton').empty().html('+');
                    jQuery('#verMas').hide();
                    break;
            }
        }
        
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    jQuery('.barCaritem').hover(function(){jQuery(this).css('cursor','pointer');});
    
    
        
    ///EDITAR ITEM EN CARRITO DE COMPRA
    jQuery('.botonEditar').bind('click', function(){
        var $titulo = jQuery(this).attr('title');
         jQuery.ajax({type: "GET", url: "catalogo.php?action=reg&registro=" + this.id , cache: false, dataType: "text",success: function(data) {
                
                jQuery('#dialog').empty();
                jQuery('#dialog').dialog({buttons:{"Cerrar":function(){jQuery("div#dialog").dialog ("close");}},modal: true, title: $titulo , top : "0px",   width: 800 , height:600, show: "scale", hide: "scale", closeOnEscape: true, close: function(){window.location = 'index.php?action=listCar';}});
                jQuery('#dialog').html(data);
            }
         });
        
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    
    /// FIN EDITAR ITEM EN CARRITO DE COMPRA
    
    ///Borrar ITEM EN CARRITO DE COMPRA
    jQuery('.botonBorrar').bind('click', function(){
        var $id = jQuery(this).attr('alt') ;
        var $contenido = jQuery(this).attr('title') ;
                jQuery('#dialog').empty();
                jQuery('#dialog').dialog({buttons:{"Borrar":function(){window.location = 'index.php?action=delfromCar&item='+$id ;},"Cancelar":function(){jQuery("div#dialog").dialog ("close");}},modal: true, title: "Confirmar borrado de registro" , width: 500 , height:300, show: "scale", hide: "scale", closeOnEscape: true});
                jQuery('#dialog').html("Se va a eliminar el titulo:<p> "+$contenido+"</p><br /> Esta seguro de continuar?");
       
        
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    
    /// FIN BORRAR ITEM EN CARRITO DE COMPRA

    
});

