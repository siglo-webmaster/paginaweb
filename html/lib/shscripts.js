
jQuery(document).ready(function($){
   
   //TAMAÑOS DE LAS VENTANAS DIALOG
  // var $width = 800;
   //var $height=  800;
   
   /*FUNCIONES VARIAS */

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

   /*FIN FUNCIONES VARIAS*/
  
  
  /*CAMBIO DE MONEDA*/
   jQuery('#moneda').bind("change", function(){
         jQuery('#dialog').load("consultasGenericas.php?action=cambiarMoneda&id_moneda=" + jQuery('#moneda').val());
         alert("Cambiando tipo de Moneda ");
         window.location.href = window.location.href;
       
   }); 
   /*FIN CAMBIO DE MONEDA*/
  
  

   /*
    $('.libro').click(function(){
        var $titulo = $(this).attr('title');
         $.ajax({type: "GET", url: "catalogo.php?action=reg&registro=" + this.id , cache: false, dataType: "text",success: function(data) {
                
                $('#dialog').empty();
                $('#dialog').dialog({buttons:{"Cerrar":function(){$("div#dialog").dialog ("close");}},modal: true, title: $titulo , top : "0px",   width: $width, height: $height, show: "scale", hide: "scale", closeOnEscape: true});
                $('#dialog').html(data);
            }
         });
    }).hover(function(){$(this).css('cursor','pointer');});
    
    */
      
    /*  
    $('#agregarItem').click(function(){
         
            var iditem = $('#iditem').val();
            var isbn = $('#isbn').val();
            if($('#felectronico').is(':checked')){
                var fecant = $('#fecant').val();
            }else{
                var fecant=0;
            }

            if($('#fimpreso').is(':checked')){
                var imcant = $('#imcant').val();
            }else{
                var imcant=0;
            }
            if((imcant > 0)||(fecant > 0)){
                $('#dialog').empty();
                $('#dialog').load('shoppingCar.php',{'action':'addItem' , 'iditem': iditem , 'isbn' : isbn, 'fecant': fecant, 'imcant':imcant});
                
                
            }else{
                alert ("No ha seleccionado items paraa ingresar al carrito");
            }
            return;
    });
    
    */

/*FORMULARIOS*/

    /****MODULO USUARIOS****/
    jQuery('#usuarioForm').submit(function(){
        
        if(jQuery("#nombre").val().length < 4) {  
            alert("Por favor introdusca su nombre completo");  
            return false;  
        }
        if(jQuery("#identificacion").val().length < 4) {  
            alert("Se requiere una identificacion mayor a 3 caracteres");  
            return false;  
        }
        
        if(jQuery("#username").val()=='') {  
            alert("Por favor ingrese un nombre de usuario valido");  
            return false;  
        }
   
        if(jQuery("#email").val().length < 4) {  
            alert("El correo electronico es requerido");  
            return false;  
        }else{
            if(jQuery("#email").val().indexOf('@', 0) == -1 || jQuery("#email").val().indexOf('.', 0) == -1) {  
                alert("La dirección e-mail parece incorrecta");  
                return false;  
            } 
        }
        
        if(jQuery("#telefono").val().length < 4) {  
            alert("por favor introduzca un numero telefonico valido");  
            return false;  
        }
        
        if(jQuery("#paises").val()=='') {  
            alert("Seleccione el pais en el que se encuentra");  
            return false;  
        }
        
        if(jQuery("#ciudades").val()=='') {  
            alert("Seleccione la ciudad en que se encuentra");  
            return false;  
        }
        return true;
    });
    
    jQuery('#username').bind('change',function(){
        var $usuario = jQuery(this);
        
        jQuery.ajax({type: "GET", url: "consultasGenericas.php?action=moduloUsuarios&opt=dispUser&username=" + jQuery(this).val() , cache: false, dataType: (jQuery.browser.msie) ? "text" : "xml",success: function(data) {
                
                var xml = repararXML(data);
                jQuery('#menssageUser').empty();
                jQuery(xml).find('entry').each(function(){
                    if(jQuery(this).find('existe').text()=='true'){
                        jQuery('#menssageUser').css({'font-color':'red'})
                        
                        jQuery('#menssageUser').append("El usuario <div id='userfail'>" + $usuario.val() +"</div> ya exite!! Por favor seleccione otro nombre de usuario.");
                        jQuery('#userfail').css({'color':'red', 'display':'inline', 'font-size':'16px'});
                        jQueryusuario.val('');
                        
                    }else{
                        jQuery('#menssageUser').css({'font-color':'green','display':'inline'});
                        jQuery('#menssageUser').append("ok");
                        jQuery('#username').val($usuario.val());
                    }
                    
                                   // var name_text = $(this).find('NAME').text();
                }); //close each(
            } , error: function(){alert("Error general por favor contacte a nuestro personal de soporte.")}
        }); //close $.ajax(
        
    });
    
    $('#paises').trigger('change');
    $('#username').trigger('change');
    /******FIN MODULO USUARIOS ***/

/*LOGIN LEFT*/

    
/*FIN LOGIN LEFT*/
    /*Cargar Themes*/
    //$('.zebra1 tbody tr:even').addClass('zebra');
    
    /*
    
    $('.panel').bind('click', function(){
        $('#dialog').empty();
        $('#dialog').load('popupPublicidad.php',{'action':'mostrarPublicidad' , 'url':$(this).attr('alt')});
        $('#dialog').dialog({modal: true, position:"middle",title:$(this).attr('title'), width: 800, height:700, show: "scale", hide: "scale", closeOnEscape: true});
    });
    
    */

    /*
    jQuery('.loading').ajaxStart(function(){
            jQuery(this).show();
        }).ajaxStop(function() {
            jQuery(this).hide();
        });
   */
    
});