        
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
        
        function StringtoXML(text){
            text = trim(text);
            if (window.ActiveXObject){
                var doc=new ActiveXObject('Microsoft.XMLDOM');
                doc.async='false';
                doc.loadXML(text);
            } else {
                var parser=new DOMParser();
                var doc=parser.parseFromString(text,'text/xml');
            }
            return doc;
        }
        
        var trim = function(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
        }
        
        var actualizarUrl = function(pageSequence){
            var direccion = new String(window.location);
            var n = direccion.split('#');
            window.location = n[0] + '#p/' + pageSequence;
            return;
        }
        jQuery(document).endlessScroll({
                pagesToKeep: null,
                inflowPixels: 15,
                fireOnce: true,
                fireDelay: 500,
                insertBefore: "#list div:first",
                insertAfter: "#list div:last",
                loader: 'Loading...',
                intervalFrequency : 0,
                ceaseFireOnEmpty:false,
                resetCounter:function(){
                    return jQuery('#list').length ? false : true;
                },
                ceaseFire:function(fireSequence,pageSequence,scrollDirection){
                   // actualizarUrl(pageSequence + 1);
                    return jQuery('#list').length ? false : true;
                },
                callback:function(fireSequence,pageSequence,scrollDirection){
                    if(pageSequence<1){
                        return false;
                    }
                    
                    jQuery.ajax({type: "GET", url: "index.php?action=list&page="+pageSequence, cache: false, dataType: "text",success: function(data) {
                          var xml = StringtoXML(data);
                           
                            jQuery(xml).find('entry').each(function(){
                                
                                var $id_titulos = jQuery(this).find('id_titulos').text();
                                var $titulo = jQuery(this).find('titulo').text();
                               
                                jQuery('<div id="'+$id_titulos+'" title="'+$titulo+'" class="libro"></div>').appendTo('#list');
                                jQuery('<div class="loading" style="margin: 140px 0 0 140px;"><img src="images/loading_big.gif" ></div>').appendTo('#'+$id_titulos);
                                jQuery('#'+$id_titulos).load( "catalogo.php?action=reg&iframe=999&registro=" + $id_titulos);
                                
                                jQuery('#'+$id_titulos).click(function(){
                                    var $width = 800;
                                    var $height=  800;
                                    
                                    var $titulo = jQuery(this).attr('title');
                                    jQuery.ajax({type: "GET", url: "catalogo.php?action=reg&registro=" + this.id , cache: false, dataType: "text",success: function(data) {

                                            jQuery('#dialog').empty();
                                            jQuery('#dialog').dialog({buttons:{"Cerrar":function(){jQuery("div#dialog").dialog ("close");}},modal: true, title: $titulo , top : "0px",   width: $width, height: $height, show: "scale", hide: "scale", closeOnEscape: true});
                                            jQuery('#dialog').html(data);
                                        }
                                    });
                                }).hover(function(){jQuery(this).css('cursor','pointer');});
                            });
                            
    
                    }});
                    jQuery('.loading').ajaxStart(function(){
                        jQuery(this).show();
                    }).ajaxStop(function() {
                        jQuery(this).hide();
                    });
                    return true;                  
                }
        });
        