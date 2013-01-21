/*Funciones de control para la maquina de busqueda avanzada*/

jQuery(document).ready(function(){
     $('#opcionesAvanzadas').hide(0);
     
        /*AUTOCOMPLETADO BUSQUEDA STRING*/
        $('input#searchString').autocomplete ({
            source : function (request, callback)
            {
                var data = {action: 'preview', 
                            searchString : $('#searchString').val(), 
                            tipoBusqueda : $('#tipoBusqueda').val()};
                        
                $.ajax ({
                    url : "busqueda.php",
                    data : data,
                    complete : function (xhr, result)
                    {
                        
                        if (result != "success") return;
                        
                        var response = xhr.responseXML;
                        var books = [];
                        // recovery of titles
                        $(response).find ("li title").each (function ()
                        {
                            books.push ($(this).text ());
                        });
                        // insertion of titles
                        callback (books);
                        // insertion of images
                        var $ul = $("input#searchString").autocomplete ("widget");
                        $(response).find ("li picture").each (function (index)
                        {
                            var src = $(this).text ();
                            if(src){
                                src ="<img src='" + src+ "' height=30 />" ;
                                $ul.find ("li:eq(" + index +") a")
                                .wrapInner ("<span style=position:relative;" +
                                "top:-7px;left:10px></span>")
                                .prepend (src);
                            }
                        });
                    }
                });
            },
            open : function (event)
            {
                var $ul = $(this).autocomplete ("widget");
                $ul.css ("width", "400px");
            }
        
        });
   /* FIN AUTOCOMPLETADO */
     
     
    $('#verOpcionesAvanzadas').bind('click',function(){
        $('#opcionesBusqueda').empty();
        $('#tipoBusqueda').val('clasic');
        switch($('#verOpcionesAvanzadas').attr('alt')){
            case 'hide':{
                    $('#opcionesAvanzadas').hide(500);
                    $('#verOpcionesAvanzadas').attr('alt','show');
                    $('#verOpcionesAvanzadas').html('Ver Busqueda Avanzada');
                    break;
            }case 'show':{
                    $('#opcionesAvanzadas').show(500);
                    $('#verOpcionesAvanzadas').attr('alt','hide');
                    $('#verOpcionesAvanzadas').html('Cerrar Busqueda Avanzada');
                    break;
            }
        }
        
    }).hover(function(){$(this).css('cursor','pointer');});
    
    
    /*CARGAR CONTENIDO DE OPCIONES DE BUSQUEDA*/
    $('.opcionInactiva').bind('click',function(){
        $('.opcionActiva').removeClass('opcionActiva').addClass('opcionInactiva');
        $(this).removeClass('opicionInactiva').addClass('opcionActiva');
        $('#tipoBusqueda').val($(this).attr('alt'));
        switch($(this).attr('alt')){
            case 'editoriales':{
                    $('#opcionesBusqueda').empty();
                    $('#opcionesBusqueda').load('testBusqueda.php?action=getEditoriales');
                    break;
            }
            case 'autores':{
                    $('#opcionesBusqueda').empty();
                    $('#opcionesBusqueda').load('testBusqueda.php?action=getAutores');
                    break;
            }
            case 'categorias':{
                    $('#opcionesBusqueda').empty();
                    $('#opcionesBusqueda').load('testBusqueda.php?action=getCategorias');
                    break;
            }
            case 'fecha':{
                    
                    $('#opcionesBusqueda').empty();
                    var currentTime = new Date();
                    $('<div class=\'titulo\' id="titulo_fecha"></div>').appendTo($('#opcionesBusqueda'));
                    $('#titulo_fecha').addClass('titulo');
                    $('#titulo_fecha').html("Fecha edici&oacute;n desde: ");
                    $('<input type="text" name="f_desde" id="f_desde" />').appendTo($('#opcionesBusqueda'));
                    $('#f_desde').addClass('fechas');
                    $('#f_desde').val(currentTime.getDate());
                    
                    $('<div class=\'titulo\' id="titulo_fecha_hasta"></div>').appendTo($('#opcionesBusqueda'));
                    $('#titulo_fecha_hasta').addClass('titulo');
                    $('#titulo_fecha_hasta').html(" hasta: ");
                    $('<input type="text" name="f_hasta" id="f_hasta" />').appendTo($('#opcionesBusqueda'));
                    $('#f_hasta').addClass('fechas');
                    $('.fechas').val(currentTime.getFullYear());
                    
                    break;
            }
        }
    }).hover(function(){$(this).css('cursor','pointer');});
    
    
   $('.loadingBusqueda').ajaxStart(function(){
            $(this).show();
        }).ajaxStop(function() {
            $(this).hide();
        });
    
});
