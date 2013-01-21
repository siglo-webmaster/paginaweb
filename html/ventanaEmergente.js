    /*VENTANA EMERGENTE*/
    var abrirventanaEmergente = function($url){
        jQuery('.overlay').fadeIn(1000).bind('click',function(){
            cerrarpopUp();
        });
        
         jQuery.ajax({type: "GET", url: $url , cache: false, dataType: "text",success: function(data) {
            jQuery('#popUp').empty();
            jQuery('<div id="closeButton" class="closeButton"></div>').appendTo('#popUp');
            jQuery('#closeButton').bind('click',function(){cerrarpopUp();}).hover(function(){jQuery(this).css('cursor','pointer');});
            jQuery('<div id="contenedor"></div>').appendTo('#popUp');
            jQuery('#popUp').fadeIn(0);
            jQuery('#contenedor').html(data);
            
         }
         });
        
  };
  
  var cerrarventanaEmergente = function(){
    jQuery('#popUp').fadeOut(0);
    jQuery('.overlay').fadeOut(1000);
    jQuery('#popUp').empty();
}

    /*FIN VENTANA EMERGENTE*/