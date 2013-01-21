jQuery('document').ready(function(){
    jQuery('#menu .vinculo1').bind('click',function(){
        jQuery('#menu .vinculo1').css({'background':'#ccc','color':'#CE141D'});
        jQuery('#menu .vinculo1_bold').css({'background':'#ccc','color':'#CE141D'});
        jQuery(this).css({'background':'#fff','color':'#fff'});
        jQuery('#menu .vinculo2').css({'background':'#fff','color':'#fff'});
        jQuery('#menu .vinculo2_bold').css({'background':'#fff','color':'#fff'});
        jQuery('#' + jQuery(this).attr('alt')).css({'background':'#CE141D','color':'#fff'});
    }).hover(function(){jQuery(this).css('cursor','pointer');});
    jQuery('#menu .vinculo1_bold').bind('click',function(){
        jQuery('#menu .vinculo1').css({'background':'#ccc','color':'#CE141D'});
        jQuery(this).css({'background':'#fff','color':'#fff'});
        jQuery('#menu .vinculo2').css({'background':'#fff','color':'#fff'});
        jQuery('#menu .vinculo2_bold').css({'background':'#fff','color':'#fff'});
        jQuery('#' + jQuery(this).attr('alt')).css({'background':'#CE141D','color':'#fff'});
    }).hover(function(){jQuery(this).css('cursor','pointer');});
});


