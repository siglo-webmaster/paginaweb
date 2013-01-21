jQuery(document).ready(function(){
    jQuery("#recomendados").load("consultarDestacados.php?action=consultarDestacadosTitulos&tipodestacados=1&id_lista_precios=1&id_proveedores=1");
    if(jQuery("#recomendados").html()==''){
       /* jQuery(".recomendados").css({'display':'none'});*/

    }
    
    jQuery("#novedades").load("consultarDestacados.php?action=consultarDestacadosTitulos&tipodestacados=1&id_lista_precios=1&id_proveedores=1");
    if(jQuery("#novedades").html()==''){
        /*jQuery(".novedades").css({'display':'none'});*/
    }
    
    jQuery("#universidades .item").mouseenter(function(){jQuery(this).css({'cursor':'pointer','border-color':'#bbb'});}).mouseleave(function(){jQuery(this).css({'border-color':'#fff'})});
    jQuery("#destacadosEditoriales").load("consultarDestacados.php?action=consultarDestacadosEditoriales&tipodestacados=1&id_lista_precios=1&id_proveedores=1");
    if(jQuery("#destacadosEditoriales").html()==''){
        jQuery(".destacadosEditoriales").css({'display':'none'});
    }
});