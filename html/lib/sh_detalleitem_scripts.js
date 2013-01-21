jQuery.noConflict();
jQuery(document).ready(function($){
       
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
   
   var calcularTotal = function(){
        var total=0;
        var i=0;
        var id_tipos_productos;
        var $decimales = $('#numero_decimales').attr('alt');
        $('#total').empty();
        for(i;i<$('#numero_tipos_productos').val();i++){
            id_tipos_productos = $('#id_tipos_productos_' + i).val();
            total =  ($('#precio_'+ id_tipos_productos).val() * document.getElementById('cantidades_'+ id_tipos_productos).value) + total ;
        }
        $('#total').html("$ " + addCommas(total.toFixed($decimales)));
   }
   
    $('.cantidades').bind('change',function(){
        var precio;
        var $decimales = $('#numero_decimales').attr('alt');
        precio = $(this).val() * $('#precio_'+$(this).attr('alt')).val();
        $('#subtotal_'+$(this).attr('alt')).val(addCommas(precio.toFixed($decimales)));
        calcularTotal();
        
    });
   
    $('#agregarItem').click(function(){
        var i = 0 ;
        var id_tipos_productos;
        var productos = ''; //titulo, formato, cantidad, proveedor
        for(i;i<$('#numero_tipos_productos').val();i++){
            id_tipos_productos = $('#id_tipos_productos_' + i).val();
            productos = productos + $('#id_titulos').val() +','+$('#id_tipos_productos_' + i).val() + ',' +(document.getElementById('cantidades_'+ id_tipos_productos).value )+','+(document.getElementById('id_proveedores_'+ id_tipos_productos).value ) +','+(document.getElementById('id_lista_precios').value ) + ';' ;
        }
        
         $.ajax({type: "GET", url: "shoppingCar.php?action=addItem&productos=" + productos , cache: false, dataType: "text",success: function(data) {
                 $('#container').empty();
                 $('#container').html(data);
            }
         })
        
        
    });
    
    
    ///TRIGGERS
    
    $('.cantidades').trigger('change');
    
    //// FIN  TRIGGERS
    
    calcularTotal();
    
});