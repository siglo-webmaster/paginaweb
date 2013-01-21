/*Fincin para reparar error de Iexplorer al interpretar XML*/
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
    
    