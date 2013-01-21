$(document).ready(function(){
   
   /*INICIAR DATEPICKERS*/
   $("input#inicio").datepicker({dateFormat:"yy-mm-dd"});
   $("input#fin").datepicker({dateFormat:"yy-mm-dd"});
   /*CARGAR CONTENIDO PANEL DERECHO*/
   
   
   
   /*CARGA CONTENIDO DE PANELES*/
   var cargarPaneles = function(){
        $('#paneles').empty();
        var $id_module = $('#id_module').attr('alt');
        $('#paneles').load('loadDataModule.php?id_module='+$id_module+'&opt=loadDataPaneles&id_tipos_destacados='+$('#id_tipos_destacados').val());
        $('#panelCategorias').bind('change',function(){loadRight();});
   };
   /*confirmar tipo de destacado por defecto*/
   switch($('#id_tipos_destacados').val()){
       case '1':{
               $('#seleccionDestacados').empty();
               $('#seleccionDestacados').html("<strong>Destacado en HomePage</strong>");
               break;
       }
   }
 /*  cargarPaneles();*/
   
   
   /*En caso de cambiar el tipo de destacado*/
   $('#id_tipos_destacados').bind('change',function() {
       var $id_module = $('#id_module').attr('alt');
       $('#seleccionDestacados').empty();
       if($('#id_tipos_destacados').val()!='1'){
           $('#seleccionDestacados').load('loadDataModule.php?id_module='+$id_module+'&opt=loadDataTipoDestacado&id_tipos_destacados='+$('#id_tipos_destacados').val()+'&selected='+$('#sel').val());
       }else{
           $('#seleccionDestacados').html("<strong>Destacado en HomePage</strong>");
       }
       cargarPaneles();
   });
   
   $('.botonBorrar').bind("click",function(){$('#'+$(this).attr('alt')).css({'display':'none'});$('#'+$(this).attr('alt')).remove();});
   
   $('#id_tipos_destacados').trigger("change");
   
});


   function loadRight(){
      var $id_module = $('#id_module').attr('alt');
       $("#panelDerecho").load('loadDataModule.php?id_module='+$id_module+'&opt=loadDataTipoDestacadopanelDerecho&id_tipos_destacados='+$('#id_tipos_destacados').val()+'&Selected='+$('#panelCategorias').val());
       $('#selector').bind('click',function(){
           var $seleccionados =String($('#titulos').val()).split(",");
           var $numeroSeleccionados = $('#numeroSeleccionados').val();
           for ($i in $seleccionados){
               var $codigo = String($('#titulos option[value='+$seleccionados[$i]+']').text()).split(" ");
               
               $('<div id="'+$seleccionados[$i]+'" class="tituloSeleccionado"></div>').appendTo('#panelSeleccionados');
               $('#'+$seleccionados[$i]).html("<input type='hidden' name='seleccionado_"+$numeroSeleccionados+"' value='"+$seleccionados[$i]+"' />"
                                                        +"<div id='botonBorrar_"+$seleccionados[$i]+"' class='botonBorrar' alt='"+$seleccionados[$i]+"'><img src='../images/borrar_small.png' /></div>"
                                                        +"<div class='caratula'><img src='../images/caratulasSHE/"+$codigo[0]+"_g.jpg' /></div>"
                                                        +$('#titulos option[value='+$seleccionados[$i]+']').text());
                                                    
               $('#botonBorrar_'+$seleccionados[$i]).bind("click",function(){$('#'+$(this).attr('alt')).css({'display':'none'});$('#'+$(this).attr('alt')).remove();});
               
               $numeroSeleccionados++;
               $('#numeroSeleccionados').val($numeroSeleccionados);
               
           }
           $(".tituloSeleccionado").each(function() {
                if($(this).html()==''){
                    $(this).remove();
                }
            });

        });
       
       return;
   }
