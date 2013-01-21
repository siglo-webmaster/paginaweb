$(document).ready(function(){
    
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
    
    
    setInterval(function(){
            $('#eventos').load("sheeventos.php");
            consultarAvisos();
    }, 5000);
    
    
    var consultarAvisos = function(){
        
        $.ajax({type: "GET", url: "sheeventos.php?action=consultarAvisos" , cache: false, dataType: ($.browser.msie) ? "text" : "xml",success: function(data) {
                                
                var xml = repararXML(data);
                
                $(xml).find('entry').each(function(){
                    if($(this).find('id_eventos').text()!='false'){
                         $('#avisos').load("sheeventos.php?consultarEvento&id_evento="+$(this).find('id_eventos').text());
                    }     
                }); //close each
            }
        }); //close ajax
    };
    
});