<?php
    class classCabecera{
        public $print;
        public $head;
        public $left_menu;
        public $mainmenu;
        public $user_bar;
        public $search_bar;
        public $shoppingcar;
        public $script;
        public $body;
        public $foot;
        
        function __construct (){
                     
            
            $this->print ='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
            <html lang="es">
            <head>
            <title>Editorial Colombiana, Distribuidora de libros y eBooks. Librería Virtual SiglodelHombre.com</title>
            <meta name="Description" content="Siglo del Hombre Editores: Editorial Colombiana Distribuidora de Libros y eBooks de universidades y instituciones académicas colombianas, españolas, mexicanas y argentinas. librería virtual, suscripción de revistas academicas y culturales" />
            <meta name="Keywords" content="katz, editorial katz, katz editores, alejandro katz, libreria virtual,editorial colombiana,comprar,venta de ebooks,libros colombianos,Libros Digitales,Libros electronicos,catalogo,Novedades bibliograficas,distribuidora de libros colombianos,revistas culturales,editoriales universitarias,libros de universidades en Colombia,editoriales españolas,mexicanas,argentinas,tienda virtual de libros,suscripcion revistas academicas,culturales,Siglo del Hombre" />
            <meta name="owner" content="Siglo del Hombre Editores S.A" />
            <meta name="robots" content="index, follow" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
            <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /><link rel="icon" href="favicon.ico" type="image/x-icon" />
            <LINK REL=StyleSheet HREF="css/style_sh.css" TYPE="text/css" MEDIA=all>
            <link rel="stylesheet" type="text/css" media="screen" href="css/skin.css"  />
            <link rel="stylesheet" type="text/css" media="screen" href="css/nyroModal.css"  />
            <link rel="stylesheet" type="text/css" media="screen" href="css/userbar.css"  />
            <link rel="stylesheet" type="text/css" media="screen" href="lib/ias/css/jquery.ias.css"  />
            <link rel="stylesheet" type="text/css" media="screen" href="css/mainmenu.css"  />
            <link href="lib/jquery/jquery-ui.css" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" type="text/css" media="screen" href="css/destacados.css"  />
            <LINK REL=StyleSheet HREF="css/busquedaAvanzada.css" TYPE="text/css" MEDIA=all>
            <LINK REL=StyleSheet HREF="css/searchList.css" TYPE="text/css" MEDIA=all>
            <LINK REL=StyleSheet HREF="css/barCar.css" TYPE="text/css" MEDIA=all>
            <script src="lib/jquery/jquery.min.js"></script>
            <script src="lib/jquery/jquery-ui.min.js"></script>
            <script src="lib/ventanaEmergente.js"></script>
            <script src="lib/funcionesBasicas.js"></script>
            <script src="lib/userbar.js"></script>
            <script src="lib/busquedaAvanzada.js"></script>
            <script src="lib/shShoppingCar.js"></script>
            <script src="lib/shDespachos.js"></script>
            
            <script src="lib/shscripts.js"></script>
            
            <!--
            <script src="lib/shDespachos.js"></script>
            -->

          <!--%%%CARRUSEL%%%-->
        
          <script type="text/javascript" src="lib/recomendados.js" ></script>
          
                <script src="lib/cufon-yui.js" type="text/javascript"></script>
		<script src="lib/Aller.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace(\'ul.oe_menu div a\',{hover: true});
			Cufon.replace(\'h1,h2,.oe_heading\');
		</script>
                
                <script src="lib/mainmenu.js"></script>
            </head>
            <body>
            
            <div id="dialog"  ></div>
            <div class=\'overlay\'>
            </div>
            <div id=\'popUp\' class=\'popUp\'>
            </div>

            <table class="cuerpo">
                <tr>
                    <td colspan="3">
                       <!-- INICIO CABEZOTE-->
                       %%%CABEZOTE%%%
                      <!-- FIN CABEZOTE -->
                    </td>
                    
                    </tr>
                    <tr>
   <!-- COLUMNA IZQUIERDA -->
                    <td style="vertical-align:top;"> 
                        %%%LEFTMENU%%%
                    </td>          
<!-- FIN COLUMNA IZQUIERDA -->

<!-- CUERPO -->
                    <td style="vertical-align:top;" >%%%BODYMAIN%%%</td>
<!-- FIN CUERPO -->                    

<!-- COLUMNA DERECHA -->
                    <td style="vertical-align:top;">
                    %%%RIGHTMENU%%%
                    </td>              
<!-- FIN COLUMNA DERECHA -->

                    </tr>
        
                    <tr>
                        <!-- NAVEGACION INFERIOR -->
                        <td colspan="3">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" valign="bottom">
                                    <tbody><tr> 
                                            <td width="10" height="25" bgcolor="#CCCCCC">&nbsp;

                                            </td>
                                            <td width="470" bgcolor="#CCCCCC">
                                                    <a class="texto" href="/legal.asp?plano=1">
                                                            Aviso Legal
                                                    </a> 
                                                    | <a class="texto" href="/privacidad.asp?plano=2">
                                                            Pol&iacute;tica de privacidad
                                                    </a> | <span class="texto">&copy;
                                                    2002 - 2012 Siglo del Hombre Editores S.A</span>
                                            </td>
                            <form action="/search.asp" method="post"></form>
                                            <td width="65" bgcolor="#CCCCCC" class="bold10_negro">
                                                    B&uacute;squeda:&nbsp;
                                            </td>
                                            <td width="75" bgcolor="#CCCCCC">
                                                    <select class="pulldown" name="tipo">
                                                            <option selected="" value="Titulo">
                                                                    T&iacute;tulo
                                                            </option>
                                                            <option value="Autor">
                                                                    Autor
                                                            </option>
                                                            <option value="Editorial">
                                                                    Editorial
                                                            </option>
                                                    </select>
                                            </td>
                                            <td width="80" bgcolor="#CCCCCC" align="right">
                                                    <input type="text" class="fondo" size="10" name="srkeys">
                                            </td>
                                            <td width="36" bgcolor="#CCCCCC" align="right" class="bold10_negro"> 
                                                    <input width="30" type="image" height="16" border="0" align="bottom" src="images/b_ir.gif" name="imageField2">
                                                    <input type="hidden" value="AND" name="Criteria">
                                            </td>
                                            <td width="10" valign="bottom" bgcolor="#CCCCCC" align="right" class="bold10_negro">&nbsp;

                                            </td>

                                    </tr>
                            </tbody>
                            </table>

                        </td>
                        <!-- FIN NAVEGACION INFERIOR -->
                    </tr>
                    <tr>
                        <!--PIE DE PAGINA -->
                        <td colspan="3">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody><tr>
                                        <td align="center" style="padding-top:8px;padding-bottom:8px;" class="bold10_negro">
                                                Carrera 31A No. 25B-50. Bogot&aacute;, Colombia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PBX: 57 (1) 337 7700 FAX: 57 (1) 337 7665
                                        </td>
                                </tr>
                                    </tbody>
                            </table> 

                        </td>
                        <!--FIN PIE DE PAGINA -->
                    </tr>

                </body>
                </html>
                ';
        }
        
        
        function render(){
            $this->print=  str_replace("%%%CABEZOTE%%%", $this->setCabezote(), $this->print);
            $this->print=  str_replace("%%%LEFTMENU%%%", $this->setLeftbar(), $this->print);
            $this->print=  str_replace("%%%RIGHTMENU%%%", $this->setRightbar(), $this->print);
            $this->print=  str_replace("%%%USERBAR%%%", $this->user_bar, $this->print);
            $this->print=  str_replace("%%%SEARCHBAR%%%", $this->search_bar, $this->print);
            $this->print=  str_replace("%%%SHOPPINGCAR%%%", $this->shoppingcar, $this->print);
            $this->print = str_replace("%%%BODYMAIN%%%", $this->body,  $this->print);
            $this->print = str_replace("<!--%%%CARRUSEL%%%-->", $this->script,  $this->print);
            $this->print = str_replace("%%%MAINMENU%%%", $this->mainmenu,  $this->print);
            
            $moneda ="<option value='1' >PESOS COLOMBIANOS</option>".
                    "<option value='2' >EUROS</option>".
                    "<option value='3' >DOLARES</option>";
            if(isset($_SESSION['moneda'])){
                $moneda = str_replace(($_SESSION['moneda'])."'",($_SESSION['moneda'])."' SELECTED " , $moneda);
            }
            
            $this->print = str_replace("%%%MONEDA%%%", $moneda,  $this->print);
            return $this->print;
            
        }
        
        function setCabezote(){
            $return ='<table valign="bottom" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr valign="bottom">
                                    <td><img src="images/spacer.gif" width="1"></td>
                                    <td align="left" width="75"><a href="index.php"><img src="images/li_rojo.gif" width=75 alt="" border="0" align="middle"></a></td>
                                    <td align="left">
                                            <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
                                                    <tr>
                                                            <td colspan="2" align="right" nowrap="nowrap" height="12"><img src="images/spacer.gif" width="1" height="12"></td>
                                                    </tr>
                                                    <tr valign="bottom">
                                                            <td align="right">
                                                                    <table width="100%" cellpadding="0" cellspacing="0">
                                                                    <tr valign="top">
                                                                            <td><a href="/default.asp"><img src="images/logo_nuevo.png" width="250"  alt="" border="0" hspace="15" vspace="10"></a></td>
                                                                            <td>&nbsp;</td>
                                                                    </tr>
                                                                    </table>
                                                      </td>
                                                            <td width="285" align="right" nowrap="nowrap">
                                                                    <table align="right" cellpadding="0" cellspacing="0" border=0>
                                                                    <tr>
                                                                            <td width="285" height="20" nowrap="nowrap" bgcolor="#FFFFFF" align="right">

                                                                    </td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td align="center" width="285" bgcolor="#CE141D" nowrap="nowrap" >
                                                                                    <a href="/default.asp" class="bold11_blanco">Inicio</a> | 
                                                                                    <a href="/users.asp?plano=5&" class="bold10_blanco">Mi cuenta</a> | 
                                                                                    <a href="/cart.asp?plano=6" class="bold11_blanco">Carrito</a> |  
                                                                                    <!-- <a href="#" class="bold10_blanco">Mapa del sitio</a> |  -->
                                                                                    <a href="/fmail.asp?nosecp=Seccion_de_contacto&plano=8" class="bold11_blanco" title="Pulse aquí en caso de requerir información o atención personalizada">Cont&aacute;ctenos</a>
                                                                                    <!--  | <a href="help.asp" class="bold10_blanco">Ayuda</a> -->						</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                    </tr>
                                      </table>
                                    </td>
                            </tr>
                            <tr>
                            <td><img src="images/spacer.gif" width="1"></td>
                            <td colspan="3" align="right" >
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="right" bgcolor="#CBDB2A" >
                                    <tr><td bgcolor="#CE141D" width="600" nowrap="nowrap" height="3" colspan="2"></td></tr>
                                    <tr> 
                                     <td align="center" bgcolor="#CBDB2A" class="bold10_negro" height="20">
                                     <a href="/editoriales.asp?qcpl=Catalogo-Editoriales-Colombianas-Españolas-Mexicanas-Argentinas&abmg=_" class="bold10_negro">Cat&aacute;logo</a>
                                     | <a href="/showcat.asp?qcpl=Catalogo-Revistas-Culturales&bloop=2&cat=14&path=14" class="bold10_negro">Revistas</a>
                                     | <a href="/showcat_sdh.asp?qcpl=Libros-y-eBooks-Editados-por-SiglodelHombre&plano=3" class="bold10_negro">Nuestras Ediciones</a>
                                 | <a href="/showcat_nov_home.asp?qcpl=Catalogo-de-Novedades-Bibliográficas&plano=4" class="bold10_negro">Novedades</a>
                                     | <a href="/suscripciones.asp?qcpl=Suscripciones-Revistas-Culturales&plano=10&como_susc=1" class="bold10_rojo">Suscripciones</a>
                                     </td>
                                     <td nowrap="nowrap" bgcolor="#CBDB2A" class="bold10_negro" align="center" width="350">
                                     <table border="0" bgcolor="#CBDB2A" cellspacing="0" cellpadding="0">
                                     <form method="post" action="/search.asp">
                                     <tr bgcolor="#CBDB2A" >
                                     <td nowrap="nowrap" bgcolor="#CBDB2A" class="bold10_negro">
                                 <label for="tipo">B&uacute;squeda:</label>
                                 </td>
                                 <td>
                                 <select name="tipo" class="pulldown">
                                      <option value="Titulo" selected>T&iacute;tulo</option>
                                      <option value="Autor">Autor</option>
                                      <option value="Editorial">Editorial</option>
                                     </select>
                                 </td>
                                    <td bgcolor="#CBDB2A"><input type="text" name="srkeys" size="25" class="fondo" ></td>
                                    <td bgcolor="#CBDB2A">
                                      <input type="image" border="0" name="imageField2" src="images/b_ir.gif" width="30" align="bottom">
                                      <input type="hidden" name="Criteria" value="AND">
                                    </td>
                                    </tr>
                                    </form>
                              </table></td>
                              </tr>
                            </table>
                            </td>
                            </tr>
                            </table>

                     ';
            
            return $return;
        }
        
        function setLeftbar(){
            
            $return = '<a title="Pulse aquí para descargar el catálogo de las ediciones de Siglo del Hombre" alt="Pulse aquí para descargar el catálogo de las ediciones de Siglo del Hombre" style="font:Verdana, Geneva, sans-serif; font-size:11px; font-weight:bold; color:#990000; text-decoration:none; cursor:pointer;" target="_blank" href="docs/catalogo_she_2012.pdf"><img border="0" style="margin-left:10px; margin-top:10px; padding-right:8px" title="Catálogo Siglo del Hombre Editores" src="images/acrobat_.jpg">Catálogo SHE</a>
                         <br><br>

                        <table width="140" cellspacing="0" cellpadding="0" border="0">
                          <tbody><tr> 
                            <td colspan="2"> 
                              <table width="140" cellspacing="0" cellpadding="0" background="images/menu_bg.gif">
                                <tbody><tr> 
                                                <td width="10" height="20"><img width="10" height="8" src="images/spacer.gif"></td>
                                        <td height="20" class="bold10_rojo">Temas</td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                          <tr> <td colspan="2">&nbsp;</td> </tr>
                          <tr>
                                  <td width="10" height="20"><img width="10" height="8" src="images/spacer.gif"></td> 
                            <td align="left" valign="top"> 
                              <table width="130" cellspacing="0" cellpadding="0" border="0">
                                <tbody><tr> 
                                  <td>

                                          <table width="130" cellspacing="0" cellpadding="0" border="0">

                                            <tbody><tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=10&amp;path=10">Arte</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=12&amp;path=12">Ciencias Básicas</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=13&amp;path=13">Ciencias Humanas y Sociales</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=1&amp;path=1">Derecho</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=16&amp;path=16">Derechos Humanos</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=6&amp;path=6">Ecología</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=4&amp;path=4">Educación</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=3&amp;path=3">Ética</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=2&amp;path=2">Filosofía</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=7&amp;path=7">Género</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=15&amp;path=15">Ingeniería</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=9&amp;path=9">Literatura</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=8&amp;path=8">Medicina</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=5&amp;path=5">Política</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=11&amp;path=11">Religiones y Teología</a></td>
                                                                </tr>

                                            <tr> 
                                              <td><a class="bold10_gris" href="/showcat.asp?bloop=2&amp;cat=14&amp;path=14">Revistas</a></td>
                                                                </tr>

                                          </tbody></table>

                        <img width="5" height="10" border="0" src="images/spacer.gif"><br>
                        <a class="bold10_rojo" href="/suscripciones.asp?plano=10&amp;como_susc=1">Suscripciones</a>

                                  </td>
                                </tr>
                              </tbody></table>        
                            </td>        
                          </tr>
                        </tbody></table>          

                        <!-- fin temas-->
                    <table>
                    


                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td valign="top"> 

          <!-- contenido login, sale si el usuario no está logeado-->
          <table border="0" cellpadding="0" cellspacing="0" width="140">
           <tbody><tr> 
             <td colspan="2" height="20" valign="middle"> 
               <table background="images/menu_bg.gif" border="0" cellpadding="0" cellspacing="0" width="140">
                 <tbody><tr> 
                   <td height="20" width="10"><img src="images/spacer.gif" height="8" width="10"></td>
                         <td class="bold10_rojo" height="20">Mi Cuenta</td>
                 </tr>
               </tbody></table>
             </td>
           </tr>
           <tr> <td colspan="2">&nbsp;</td> </tr>
           <tr>
                  <td height="20" width="10"><img src="images/spacer.gif" height="8" width="10"></td> 
             <td valign="top" align="left">
               <form action="/users.asp" method="POST">
                 <table border="0" cellpadding="0" cellspacing="0" width="130">
                   <tbody><tr> 
                     <td class="bold10_negro">E-mail:</td>
                   </tr>
                   <tr> 
                     <td> 
                       <input name="UserID" value="" size="17" class="fondo" type="text">
                     </td>
                   </tr>
                   <tr> 
                     <td class="bold10_negro">Clave:</td>
                   </tr>
                   <tr> 
                     <td> 
                       <input name="Pwd" size="17" class="fondo" type="password">
                     </td>
                   </tr>
                   <tr> <td>&nbsp; </td> </tr>
                   <tr> 
                     <td> 
                       <input name="Login" src="images/b_ingresar.gif" alt="Login" border="0" height="16" type="image" width="107">
                     </td>
                   </tr>
                   <tr>
                     <td height="20" valign="bottom"><a href="/getpwd.asp" class="enlacesub">¿Olvidó 
                       su clave?</a></td>
                   </tr>
                   <tr>
                     <td height="20" valign="bottom"><a href="/newuser.asp" class="enlacesub">Regístrese</a></td>
                   </tr>
                           <tr>
                                   <td>

                                   </td>
                           </tr>
                 </tbody></table>
               </form>
             </td>
           </tr>
         </tbody></table>
         <!-- fin login-->

                      </td>
                    </tr>
                    

	  <tr>
             <td>&nbsp;</td>
           </tr>
           <tr>
             <td>
               <!--inicio informaciÃ³n -->
<table background="..images/menu_bg.gif" border="0" cellpadding="0" cellspacing="0" width="140">
  <tbody><tr> 
    <td height="20" width="10"><img src="images/spacer.gif" height="8" width="10"></td>
    <td class="bold10_rojo">Información</td>
  </tr>
 </tbody></table>
 <table background="images/bg_tab_01.gif" border="0" cellpadding="0" cellspacing="0" width="140">
  <tbody><tr> 
    <td height="20" width="10"><img src="images/spacer.gif" height="8" width="10"></td>
    <td class="bold10_blanco" width="130" align="left">
      <table border="0" cellpadding="5" cellspacing="0">
        <tbody><tr> 
          <td class="texto" valign="top"> 
           <strong>Siglo del Hombre Editores</strong><br>
			<br>
			Cra 31A No. 25B-50<br>
			Bogotá, Colombia<br>
			PBX: 57 (1) 337 7700<br>
			FAX: 57 (1) 337 7665<br>
			<br>
            <a href="fmail.asp?plano=8">Contáctenos</a>
          </td>
        </tr>
      </tbody></table>
	</td>
  </tr>
  <tr> 
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#CCCCCC"> 
    <td colspan="2"><img src="images/spacer.gif" height="1" width="1"></td>
  </tr>
</tbody></table>
<!--fin informaciÃ³n -->
             </td>
           </tr>
           <tr>
             <td>&nbsp;</td>
           </tr>
         
         </table>';
            return $return;
        }
        
        function setRightbar(){
            $return = '<!-- contenido columna derecha -->

                        <table background="images/menu_bg.gif" border="0" cellpadding="0" cellspacing="0" width="140">
                            <tbody><tr> 
                             <td height="20" valign="middle" align="center"><img src="images/spacer.gif" height="1" width="10"></td>
                             <td class="bold10_rojo" width="125" align="left">Síganos en:</td>
                            </tr>
                            </tbody>
                        </table>
                        
                        <img src="images/2011/redes_sociales.png" alt="redes sociales" usemap="#mapa_redes_sociales" style="margin-top:8px; margin-bottom:8px; margin-left:30px;" border="0" hspace="20">

<!-- 1 -->              <table border="0" cellpadding="0" cellspacing="0" width="140">
                            <tbody>
                                <tr>
                                    <td>
                                        <table name="eventos" background="images/menu_bg.gif" border="0" cellpadding="0" cellspacing="0" width="140">
                                            <tbody>
                                                <tr> 
                                                    <td height="20" valign="middle" align="center"><img src="images/spacer.gif" height="1" width="10"></td>
                                                    <td class="bold10_rojo">Eventos</td>
                                               </tr>
                                           </tbody>
                                       </table>
                                      <table name="eventos" background="images/bg_tab_01.gif" border="0" cellpadding="0" cellspacing="0" width="140">
                                        <tbody>
                                            <tr> 
                                                <td valign="top" align="center">
                                                    <br>
                                                    <ul id="scroller_disabled" style="list-style-type:none; float:left; margin: 0 0 0 -25px;">

                                                            <li>
                                                                    <a href="images/2012/libreria_centro.jpg" class="nyroModal" title="Siglo del Hombre. Librer&iacute;a La Candelaria - Outlet">
                                                                            <img src="images/2012/libreria_centro_pequeno.jpg" alt="Siglo del Hombre. Librer&iacute;a La Candelaria - Outlet" border="0" title="Siglo del Hombre. Librer&iacute;a La Candelaria - Outlet" />
                                                                    </a>
                                                            </li>
                                                    </ul>
                                               </td>
                                            </tr>
                                            <tr height="10">
                                                <td>
                                                </td>
                                            </tr>
                                      </tbody>
                                   </table>

                                 </td>
                              </tr>
                           </tbody>
 <!-- fin 1 -->     </table>
                    <map name="mapa_redes_sociales" id="mapa_redes_sociales">
                      <area shape="rect" coords="3,1,32,31" href="http://www.facebook.com/siglodelhombre" target="_blank">
                      <area shape="rect" coords="38,3,65,29" href="http://www.twitter.com/siglodelhombre" target="_blank">
                      <area shape="rect" coords="70,0,100,29" href="http://www.youtube.com/siglodelhombre" target="_blank">
                    </map>


                        
                        <table name="recomendados" background="images/menu_bg.gif" border="0" cellpadding="0" cellspacing="0" width="140">
                          <tbody><tr> 
                            <td height="20" valign="middle" align="center"><img src="images/spacer.gif" height="1" width="10"> 
                            </td>
                            <td class="bold10_rojo">Recomendados</td>
                          </tr>
                          </tbody>
                        </table>
                        <table name="recomendados" background="images/bg_tab_01.gif" border="0" cellpadding="0" cellspacing="0" width="140">
                          <tbody><tr> 
                            <td valign="top" align="center"> <br>
                              <table border="0" cellpadding="0" cellspacing="0" width="140">

                                <!-- comienzo producto -->
                                <form action="validar_stock.asp" method="POST"></form>
                                <tbody><tr><td>
                                 <div style="width:120px; margin:0 auto">
                                 <a href="details.asp?prodid=UDV10091&amp;cat=20&amp;path=">
                                  <img src="images/nohay.gif" alt="No hay imagen disponible" border="0" height="73" hspace="5" width="49" align="left">
                                </a>
                                </div>
                               </td>
                               </tr>
                                <tr><td>
                                 <div style="width:120px; margin:0 auto;">
                                 <a href="details.asp?prodid=UDV10091&amp;cat=20&amp;path=" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:left">
                                   Una alegría secreta. Ensayos de filosofía moderna
                                  <br>
                                 </a>
                                 </div>

                                 <div style="width:120px; margin:0 auto;"><span style="display:block; margin:auto;font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:center; color:#990000; margin-top:5px;">$30,000 pesos<br></span></div>

                                </td></tr>
                                <tr>
                                 <td align="center">
                                  <input id="addlist" name="addlist" value="1" type="hidden">
                                  <input src="images/b_agregar.gif" style="margin-top:8px;" border="0" height="18" type="Image" width="130">
                                 </td>
                                </tr>
                                <tr><td><br><img src="images/2011/separador.png" border="0">&nbsp;</td></tr>


                                <input name="cat" value="" type="Hidden">
                                <input name="path" value="" type="Hidden">
                                <input name="listitems" value="1" type="Hidden">
                                <input name="Prod1" value="UDV10091" type="Hidden">
                                <input name="Units1" value="1" type="Hidden">
                                <input name="CatID1" value="20" type="Hidden">
                                <input name="Weight1" value="" type="Hidden">
                                <input name="Qtty1" value="1" type="Hidden">

                                <!-- fin producto -->

                                <!-- comienzo producto -->
                                <form action="validar_stock.asp" method="POST"></form>
                                <tr><td>
                                 <div style="width:120px; margin:0 auto">
                                 <a href="details.asp?prodid=SVA10138&amp;cat=17&amp;path=">
                                  <img src="images/nohay.gif" alt="Enseñanza del derecho La" style="display:block; margin:auto" border="0" height="73" width="49">
                                 </a>
                                 </div>
                                </td>
                                </tr>
                                <tr><td>
                                 <div style="width:120px; margin:0 auto;">
                                 <a href="details.asp?prodid=SVA10138&amp;cat=17&amp;path=" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:left">
                                   Enseñanza del derecho La
                                  <br>
                                 </a>
                                 </div>

                                <div style="width:120px; margin:0 auto;"><span style="display:block; margin:auto;font-family:Arial, Helvetica, sans-serif; font-size:11px;text-align:center; color:#990000; margin-top:5px;">$36,000 pesos<br></span></div>

                               </td></tr>
                               <tr>
                                <td align="center">
                                 <input id="addlist" name="addlist" value="1" type="hidden">
                                 <input src="images/b_agregar.gif" style="margin-top:8px;" border="0" height="18" type="Image" width="130">
                                </td>
                               </tr>
                               <tr><td><br><img src="images/2011/separador.png" border="0">&nbsp;</td></tr>


                                <input name="cat" value="" type="Hidden">
                                <input name="path" value="" type="Hidden">
                                <input name="listitems" value="1" type="Hidden">
                                <input name="Prod1" value="SVA10138" type="Hidden">
                                <input name="Units1" value="1" type="Hidden">
                                <input name="CatID1" value="17" type="Hidden">
                                <input name="Weight1" value="" type="Hidden">
                                <input name="Qtty1" value="1" type="Hidden">

                                <!-- fin producto -->

                                      </tbody></table>

                                    </td>
                                  </tr>
                                  <tr> 
                                    <td bgcolor="#CCCCCC" valign="top" align="center"><img src="images/spacer.gif" height="1" width="1"></td>
                                  </tr>
                                </tbody>
                               </table>
<!-- fin contenido columna derecha -->';
            return $return;
        }
        
    }
?>

       