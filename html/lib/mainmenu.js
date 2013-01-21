jQuery.noConflict();
jQuery(document).ready(function() {
                var $oe_menu		= jQuery('#oe_menu');
                var $oe_menu_items	= $oe_menu.children('li');
                

$oe_menu_items.bind('mouseenter',function(){
                        var $this = jQuery(this);
                        $this.addClass('slided selected');
                        $this.children('div').css('z-index','9999').stop(true,true).slideDown(200,function(){
                                $oe_menu_items.not('.slided').children('div').hide();
                                $this.removeClass('slided');
                        });
                }).bind('mouseleave',function(){
                        var $this = jQuery(this);
                        $this.removeClass('selected').children('div').css('z-index','1');
                });

                $oe_menu.bind('mouseenter',function(){
                        var $this = jQuery(this);
                        
                        $this.addClass('hovered');
                }).bind('mouseleave',function(){
                        var $this = jQuery(this);
                        $this.removeClass('hovered');
                        
                        $oe_menu_items.children('div').hide();
                })
});