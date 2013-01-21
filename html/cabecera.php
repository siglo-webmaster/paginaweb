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
            <html>
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
            <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
            <LINK REL=StyleSheet HREF="css/style_sh.css" TYPE="text/css" MEDIA=all>
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
                       <!-- INICIO CABECERA-->
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" valign="bottom">
                        <tbody><tr valign="bottom">
                        <td><img width="1" src="images/spacer.gif"></td>
                        <td width="75" align="left"><a href="index.php"><img width="75" border="0" align="middle" alt="" src="images/li_rojo.gif" style="z-index:9999;"></a></td>
                        <td align="left">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody><tr>
                        <td nowrap="nowrap" height="12" align="right" colspan="2"><img width="1" height="12" src="images/spacer.gif"></td>
                        </tr>
                        <tr valign="bottom">
                        <td align="right">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                <tbody><tr valign="top">
                            <td><a href="#"><img width="250" vspace="10" hspace="15" border="0" alt="" src="images/logo_nuevo.png" style="z-index:9999;"></a></td><td>&nbsp;</td>
                                </tr>
                                </tbody></table>
                        </td>
                        <td align="right">
                        <div id="userbar" class="userbar"></div>
                        <div class="selectmoneda">
                        <form name="form2" id="form2">
                            Moneda:<select id="moneda">%%%MONEDA%%%</select>
                        </form>
                        </div>
                        </td>
                        </tr>
                        </tbody></table>
                        </td>
                        </tr>
                       
                        
                        </tbody></table>
                       %%%MAINMENU%%% 
                    </td>
                    <!-- FIN CABECERA -->
                    </tr>
                    
                    <tr>

                    <td colspan="3" >
                        <!-- INICIO BARRA STATUS SUPERIOR -->
                        %%%SHOPPINGCAR%%%
                        <!-- FIN BARRA STATUS SUPERIOR -->
                    </td>
                    </tr>
                    <tr style="vertical-align:top;">
            
            <!-- FIN COLUMNA IZQUIERDA -->
            <!-- CUERPO DEL DOCUMENTO -->
            
            <td width="100%" id="bodymain" cospan="2">
           
            %%%SEARCHBAR%%%
            <div class="sigloinfo"> 
            <div class="bannerayuda">
                <a href="helpdesk/livehelp.php?department=1" target="_blank">
                    <img src="images/left-live-help.gif">
                    </img>
                    </a>
            </div>
            <h2>Siglo del Hombre Editores S.A.</h2>
            <div class="pbx">PBX: 57 (1) 337 7700 </div> 
            <p>Cr 31A No. 25B-50 | Cr 4 No. 10-01</p>
             <p>Bogotá, Colombia</p>      
             <p>FAX: 57 (1) 337 7665</p><br /> 
             <a href="http://www.facebook.com/siglodelhombre" target="_blank"><img src="images/facebook.jpg"></img></a>
             <a href="http://www.twitter.com/siglodelhombre" target="_blank"><img src="images/twitter.jpg"></img></a>
            </div>
            %%%BODYMAIN%%%
            </td> 
            
            
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
            $this->print=  str_replace("%%%LEFTMENU%%%", $this->left_menu, $this->print);
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
    }
?>

       