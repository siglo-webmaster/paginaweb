jQuery.ajax({type: "GET", url: "consultarEventos.php?action=getEventos&id_tipo_evento=1" , cache: false, dataType: "text",success: function(data) {
       if(data==""){
            /*document.getElementById('destacados1').classList.remove('destacados1');
            document.getElementById('destacados1').classList.add('oculto');*/
            return;
       }
}});

stepcarousel.setup({
    galleryid: 'destacados1', //id of carousel DIV
    beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
    panelclass: 'panel', //class of panel DIVs each holding content
    autostep: {enable:true, moveby:1, pause:5000},
    panelbehavior: {speed:2000, wraparound:true, wrapbehavior:'slide', persist:false},
    defaultbuttons: {enable: false,moveby: 1, leftnav: ['images/left_arrow.gif', 3, 140], rightnav: ['images/right_arrow.gif', -4, 140]},
    contenttype: ['ajax',"consultarEventos.php?action=getEventos&id_tipo_evento=1"] 
});