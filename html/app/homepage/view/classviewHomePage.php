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
    function getRecomendados(){
        return "<div class='recomendados' >
            <div class='titulo'><h2>RECOMENDADOS</h2></div>
             <div id='recomendados'></div>
        </div>";
    }
    function getUniversidades(){
        return "<div class='universidades' >
            <div class='titulo'><h2>UNIVERSIDADES</h2></div>
             <div id='universidades'>
             
                 <a href='index.php?id_editoriales=3'>
                 <div class='item'>
                    <img src='images/universidades/ACJ.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=21'>
                <div class='item'>
                    <img src='images/universidades/CEJ.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=22'>
                <div class='item'>
                        <img src='images/universidades/CES.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=25'>
                <div class='item'>
                    <img src='images/universidades/CIN.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=40'>
                <div class='item'>
                    <img src='images/universidades/EUQ.jpg' />
                </div>
                </a>

                <a href='index.php?id_editoriales=48'>
                <div class='item'>
                    <img src='images/universidades/IAH.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=51'>
                <div class='item'>
                    <img src='images/universidades/ICC.jpg' />
                </div>
                </a>

                <a href='index.php?id_editoriales=56'>
                <div class='item'>
                    <img src='images/universidades/ILS.jpg' />
                </div>
                </a>

                <a href='index.php?id_editoriales=87'>
                <div class='item'>
                    <img src='images/universidades/UAN.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=88'>
                <div class='item'>
                    <img src='images/universidades/UBO.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=90'>
                <div class='item'>
                    <img src='images/universidades/UEX.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=95'>
                <div class='item'>
                    <img src='images/universidades/UNC.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=96'>
                <div class='item'>
                    <img src='images/universidades/UND.jpg' />
                </div>
                </a>
                
                <a href='index.php?id_editoriales=98'>
                <div class='item'>
                    <img src='images/universidades/URO.jpg' />
                </div>
                </a>
            </div>
        </div>";
    }
    
    function getRevistas(){
        return "<div class='revistas'>".
                    "<div class='titulo'>".
                    "<h2>REVISTAS</h2>".
                    "</div>".
                    "<div id='revistas'>".
                        "<div class='item'>".
                            "<img src='images/revistas/OCT80502_G.jpg' />".
                            "<div class='detalle'>".
                                "<h3>Aqui va el titulo de la revista</h3>". 
                                "<p>Suscripci&oacuten; $ 22.000 por 1 a&ntilde;o</p>".
                            "</div>".
                        "</div>".
                        "<div class='item'>".
                            "<img src='images/revistas/OCT80503_G.jpg' />".
                            "<h3>Aqui va el titulo de la revista</h3>". 
                            "<p>Suscripci&oacuten; $ 22.000 por 1 a&ntilde;o</p>".
                        "</div>".
                        "<div class='item'>".
                            "<img src='images/revistas/OCT80504_G.jpg' />".
                            "<h3>Aqui va el titulo de la revista</h3>". 
                            "<p>Suscripci&oacuten; $ 22.000 por 1 a&ntilde;o</p>".
                        "</div>".
                        "<div class='item'>".
                            "<img src='images/revistas/OCT80509_G.jpg' />".
                            "<h3>Aqui va el titulo de la revista</h3>". 
                            "<p>Suscripci&oacuten; $ 22.000 por 1 a&ntilde;o</p>".
                        "</div>".
                        "<div class='item'>".
                            "<img src='images/revistas/OCT80510_G.jpg' />".
                            "<h3>Aqui va el titulo de la revista</h3>". 
                            "<p>Suscripci&oacuten; $ 22.000 por 1 a&ntilde;o</p>".
                        "</div>".
                        "<div class='item'>".
                            "<img src='images/revistas/OCT80504_G.jpg' />".
                            "<h3>Aqui va el titulo de la revista</h3>". 
                            "<p>Suscripci&oacuten; $ 22.000 por 1 a&ntilde;o</p>".
                        "</div>".
                        "<div class='pie'><p> </p></div>".
                    "</div>".
                    
                "</div>";
    }
    
}

?>
