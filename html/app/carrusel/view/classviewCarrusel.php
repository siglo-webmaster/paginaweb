<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classviewCarrusel
 *
 * @author oborja
 */
class classviewCarrusel {
    function getPublicidad($url){
        $return = "<html>
            <head>
            </head>
            <body>
            <center><img src='".$url."' /></center>
            </body>
            </html>";
        return $return;
    }
    
    function getCarrusel(){
        
                $facebook = '<table width="140" border="0" cellspacing="0" cellpadding="0" background="images/menu_bg.gif" >
                            <tr> 
                            <td valign="middle" align="center" height="20"><img src="images/spacer.gif" width="10" height="1"></td>
                            <td width="125" class="bold10_rojo" align="left">S&iacute;ganos en:</td>
                            </tr>
                            </table>
                            <img src="images/2011/redes_sociales.png" alt="redes sociales" hspace="20" border="0" usemap="#mapa_redes_sociales" style="margin-top:8px; margin-bottom:8px; margin-left:30px;" />
                            <map name="mapa_redes_sociales" id="mapa_redes_sociales">
                            <area shape="rect" coords="3,1,32,31" href="http://www.facebook.com/siglodelhombre" target="_blank" />
                            <area shape="rect" coords="38,3,65,29" href="http://www.twitter.com/siglodelhombre" target="_blank" />
                            <area shape="rect" coords="70,0,100,29" href="http://www.youtube.com/siglodelhombre" target="_blank" />
                            </map>';
                $print = $facebook.'<table width="140" cellspacing="0" cellpadding="0" border="0" background="images/menu_bg.gif" name="eventos">
                        <tbody><tr> 
                                <td valign="middle" height="20" align="center"><img width="10" height="1" src="images/spacer.gif"></td>
                                <td class="bold10_rojo">Eventos</td>
                        </tr>
                </tbody></table>
                <table width="140" cellspacing="0" cellpadding="0" border="0" background="images/bg_tab_01.gif" name="eventos">
                <tbody><tr> 
		<td valign="top" align="center">
                <div id="mygallery" class="stepcarousel">
                <div class="belt">

                <div class="panel" alt="images/2012/libreria_centro.jpg" title="Siglo del Hombre. Librería La Candelaria - Outlet">
                <img src="images/2012/libreria_centro_pequeno.jpg" />
                </div>

                <div class="panel" alt="images/2012/Libro_Totto_10_abril_2012.jpg" title="Lanzamiento del libro: Totto - Caso académico. 10 de abril de 2012">
                <img src="images/2012/Libro_Totto_10_abril_2012_small.jpg" />
                </div>

                <div class="panel" alt ="images/2012/nascencia_debate_12_abril_2012.jpg" title="Invitación al debate: La responsabilidad de los técnicos y científicos en el futuro de Bogotá - 12 de abril de 2012 - Universidad Jorge Tadeo Lozano" >
                <img src="images/2012/nascencia_debate_12_abril_2012_small.jpg" />
                </div>

                <div class="panel" alt="images/2012/cadiz_2012.jpg" title="Siglo del Hombre en CÁDIZ 2012: II Foro Editorial de Estudios Hispánicos y Americanistas">
                <img src="images/2012/cadiz_2012_small.jpg" />
                </div>

                <div class="panel" alt="images/2012/libreria_centro.jpg" title="Siglo del Hombre. Librería La Candelaria - Outlet">
                <img src="images/2012/libreria_centro_pequeno.jpg" />
                </div>

                </div>
                </div></td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td>
                <table width="140" cellspacing="0" cellpadding="0" border="0" background="images/menu_bg.gif" name="recomendados">
                        <tbody><tr> 
                            <td valign="middle" height="20" align="center"><img width="10" height="1" src="images/spacer.gif"> 
                            </td>
                            <td class="bold10_rojo">Recomendados</td>
                        </tr>
                        </tbody></table>
                        <table width="140" cellspacing="0" cellpadding="0" border="0" background="images/bg_tab_01.gif" name="recomendados">
                        <tbody><tr> 
                            <td valign="top" align="center"> <br>
                            <table width="140" cellspacing="0" cellpadding="0" border="0">

                        <!-- comienzo producto -->
                        <form method="POST" action="validar_stock.asp"></form>
                        <tbody><tr><td>
                        <div style="width:120px; margin:0 auto">
                        <a href="details.asp?prodid=EUQ10217&amp;cat=134&amp;path=">
                        <img width="49" height="73" border="0" style="display:block; margin:auto" alt="Pluma derrotada" src="http://www.siglodelhombre.com/prodspics/EUQ10217_P.JPG">
                        </a>
                        </div>
                        </td>
                        </tr>
                        <tr><td>
                        <div style="width:120px; margin:0 auto;">
                        <a style="font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:left" href="details.asp?prodid=EUQ10217&amp;cat=134&amp;path=">
                        Pluma derrotada
                        <br>
                        </a>
                        </div>

                        <div style="width:120px; margin:0 auto;"><span style="display:block; margin:auto;font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:center; color:#990000; margin-top:5px;">$22,000 pesos<br></span></div>

                        </td></tr>
                        <tr>
                        <td align="center">
                        <input type="hidden" value="1" name="addlist" id="addlist">
                        <input width="130" type="Image" height="18" border="0" style="margin-top:8px;" src="images/b_agregar.gif">
                        </td>
                        </tr>
                        <tr><td><br><img border="0" src="images/2011/separador.png">&nbsp;</td></tr>


                        <input type="Hidden" value="" name="cat">
                        <input type="Hidden" value="" name="path">
                        <input type="Hidden" value="1" name="listitems">
                        <input type="Hidden" value="EUQ10217" name="Prod1">
                        <input type="Hidden" value="1" name="Units1">
                        <input type="Hidden" value="134" name="CatID1">
                        <input type="Hidden" value="" name="Weight1">
                        <input type="Hidden" value="1" name="Qtty1">

                        <!-- fin producto -->

                        <!-- comienzo producto -->
                        <form method="POST" action="validar_stock.asp"></form>
                        <tr><td>
                        <div style="width:120px; margin:0 auto">
                        <a href="details.asp?prodid=CEJ10340&amp;cat=122&amp;path=">
                        <img width="49" height="73" border="0" style="display:block; margin:auto" alt="Más allá del espejo retrovisor. La noción de medio en Marshall McLuhan" src="http://www.siglodelhombre.com/prodspics/EUQ10217_P.JPG">
                        </a>
                        </div>
                        </td>
                        </tr>
                        <tr><td>
                        <div style="width:120px; margin:0 auto;">
                        <a style="font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:left" href="details.asp?prodid=CEJ10340&amp;cat=122&amp;path=">
                        Más allá del espejo retrovisor. La noción de medio en Marshall McLuhan
                        <br>
                        </a>
                        </div>

                        <div style="width:120px; margin:0 auto;"><span style="display:block; margin:auto;font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:center; color:#990000; margin-top:5px;">$43,000 pesos<br></span></div>

                        </td></tr>
                        <tr>
                        <td align="center">
                        <input type="hidden" value="1" name="addlist" id="addlist">
                        <input width="130" type="Image" height="18" border="0" style="margin-top:8px;" src="images/b_agregar.gif">
                        </td>
                        </tr>
                        <tr><td><br><img border="0" src="images/2011/separador.png">&nbsp;</td></tr>


                        <input type="Hidden" value="" name="cat">
                        <input type="Hidden" value="" name="path">
                        <input type="Hidden" value="1" name="listitems">
                        <input type="Hidden" value="CEJ10340" name="Prod1">
                        <input type="Hidden" value="1" name="Units1">
                        <input type="Hidden" value="122" name="CatID1">
                        <input type="Hidden" value="" name="Weight1">
                        <input type="Hidden" value="1" name="Qtty1">

                        <!-- fin producto -->

                        <!-- comienzo producto -->
                        <form method="POST" action="validar_stock.asp"></form>
                        <tr><td>
                        <div style="width:120px; margin:0 auto">
                        <a href="details.asp?prodid=URO10295&amp;cat=123&amp;path=">
                        <img width="49" hspace="5" height="73" border="0" align="left" alt="No hay imagen disponible" src="images/nohay.gif">
                        </a>
                        </div>
                        </td>
                        </tr>
                        <tr><td>
                        <div style="width:120px; margin:0 auto;">
                        <a style="font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:left" href="details.asp?prodid=URO10295&amp;cat=123&amp;path=">
                        Libro de los buses de Bogotá, El
                        <br>
                        </a>
                        </div>

                        <div style="width:120px; margin:0 auto;"><span style="display:block; margin:auto;font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:center; color:#990000; margin-top:5px;">$65,000 pesos<br></span></div>

                        </td></tr>
                        <tr>
                        <td align="center">
                        <input type="hidden" value="1" name="addlist" id="addlist">
                        <input width="130" type="Image" height="18" border="0" style="margin-top:8px;" src="images/b_agregar.gif">
                        </td>
                        </tr>
                        <tr><td><br><img border="0" src="images/2011/separador.png">&nbsp;</td></tr>


                        <input type="Hidden" value="" name="cat">
                        <input type="Hidden" value="" name="path">
                        <input type="Hidden" value="1" name="listitems">
                        <input type="Hidden" value="URO10295" name="Prod1">
                        <input type="Hidden" value="1" name="Units1">
                        <input type="Hidden" value="123" name="CatID1">
                        <input type="Hidden" value="" name="Weight1">
                        <input type="Hidden" value="1" name="Qtty1">

                        <!-- fin producto -->

                            </tbody></table>

                            </td>
                        </tr>
                        <tr> 
                            <td valign="top" bgcolor="#CCCCCC" align="center"><img width="1" height="1" src="images/spacer.gif"></td>
                        </tr>
                        </tbody></table>
                </td>
                </tr>
                </tbody></table>';
                return "<div style='float:right !important; width:140px;'>".$print."</div>";


    }
    
}

?>
