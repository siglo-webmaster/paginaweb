jQuery.noConflict();
jQuery(document).ready(function($){
    var repararXML = function(data){
        var xml;
        if (typeof data == 'string') {
            xml = new ActiveXObject("Microsoft.XMLDOM");
            xml.async = false;
            xml.loadXML(data);
        } else {
            xml = data;
        }
        return xml;
    }
    var consultarDestacadosTitulos = function($tipoDestacado){
        var $contador = $('#contador').attr('alt');
        $contador++;
        $('#contador').attr('alt',$contador).html($contador);
        
         $.ajax({type: "GET", url: "destacadostest.php?action=consultarDestacadosTitulos&tipodestacados="+ $tipoDestacado  , cache: false, dataType: ($.browser.msie) ? "text" : "xml",success: function(data) {            
               
               var xml = repararXML(data); 
               
                var $id_destacados;
                $(xml).find('entry').each(function(){
                   $id_destacados = $(this).find('id_destacados').text();
                   $('<div id="destacado_'+$id_destacados+'" ></div>').appendTo("#destacados");
                   $("#destacado_"+$id_destacados).attr("class",'panel');
                   $("#destacado_"+$id_destacados).html('hola<img src="../images/2012/libreria_centro_pequeno.jpg" />');
                  //$("#pdestacado_"+$id_destacados).load("destacadostest.php?action=consultarDetallesDestacado&id_proveedores=1&id_lista_precios=1&id_destacados="+$id_destacados);
                }); //close each
            }
        }); //close ajax
        
    };
 //   var intervalo = 1000;
  //  setInterval(function(){consultarDestacados ('1')}, intervalo);
   
consultarDestacados ('1');

});