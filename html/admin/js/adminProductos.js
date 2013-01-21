$(document).ready(function(){
    
    jQuery('.preview img').hover(function(){jQuery(this).css('cursor','pointer');});
    jQuery('.check').bind('change',function(){
        var $id = jQuery(this).attr("alt");
        if(jQuery(this).is(':checked')){
            var $estado='activo';
            jQuery('#estado_'+$id).removeClass('inactivo');
            
        }else{
            var $estado='inactivo';
            jQuery('#estado_'+$id).removeClass('activo');
        }
        
        jQuery('#estado_'+$id).html($estado);
        jQuery.get('changeStatusItem.php?opt=changeStatusItem&codigo='+$id+'&estado='+$estado);
        jQuery('#estado_'+$id).addClass($estado);
    });
    
    jQuery('.editorialcheck').bind('change',function(){
        var $id = jQuery(this).attr("alt");
        if(jQuery(this).is(':checked')){
            var $estado='activo';
            jQuery('.ed'+$id).attr('checked',true);
            jQuery('.ed'+$id).removeClass('inactivo');
            
        }else{
            var $estado='inactivo';
            jQuery('.ed'+$id).attr('checked',false);
            jQuery('.ed'+$id).removeClass('activo');
        }
        
        
        jQuery('.ed'+$id).addClass($estado);
        //jQuery('#estado_'+$id).html($estado);
        jQuery.get('changeEditorialStatusItem.php?opt=changeEditorialStatusItem&codigo='+$id+'&estado='+$estado);
        //jQuery('#estado_'+$id).addClass($estado);
        jQuery('.check').trigger('change');
    });
    
});

var getItem = function($codigo){
        if(!jQuery('#check_'+$codigo).is(':checked')){
          
            alert("El producto no esta activo. Para ver el detalle de este, debe activarlo primero");
            return;
        }
        
        jQuery('.overlay').fadeIn(300).bind('click',function(){
            cerrarpopUp();
        });
        jQuery('#popUp').fadeIn(0);
         jQuery.ajax({type: "GET", url: "../testBusqueda.php?action=getItem&registro=" + $codigo , cache: false, dataType: "text",success: function(data) {
            jQuery('#popUp').empty();
            jQuery('<div id="closeButton" class="closeButton"></div>').appendTo('#popUp');
            jQuery('#closeButton').bind('click',function(){cerrarpopUp();}).hover(function(){jQuery(this).css('cursor','pointer');});
            jQuery('<div id="contenedor"></div>').appendTo('#popUp');
            jQuery('#popUp').fadeIn(0);
            jQuery('#contenedor').html(data);
            
         }
         });
        
  };
  
  
var cerrarpopUp = function(){
    jQuery('#popUp').fadeOut(0);
    jQuery('.overlay').fadeOut(300);
    jQuery('#popUp').empty();
}

 