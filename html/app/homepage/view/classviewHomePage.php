<?php


class classviewHomePage {
    function getdestacadosHomePage(){
        return "<div id='destacados1' class='destacados1' >
            <div class='belt' >
            </div>
        </div>";
    }
    function getNovedades(){
        return "<div class='novedades' >
            <div class='titulo'><h2>NOVEDADES</h2></div>
             <div id='novedades'></div>
        </div>";
    }   
    
    function getContenedornovedadeshome(){
        $return = '<div class="contenedornovedadeshome" >
                    <img border="0" style="display:block;" src="images/libros_impresos.png" class="titulos_img">
                    <div class="detallecontenedornovedades"></div>
                </div>
                <div class="contenedornovedadeshome" >
                    <img border="0" style="display:block;" src="images/libros_electronicos.png" class="titulos_img">
                    <div class="detallecontenedornovedades"></div>
                </div>';
        return $return;
        
    }
    
}

?>
