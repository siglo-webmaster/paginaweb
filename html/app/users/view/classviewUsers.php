<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classviewUsers
 *
 * @author oborja
 */
class classviewUsers {
    function formLogin(){
        
        $return='<div class="path" style="float:left;width:440px;">Por favor escriba su e-mail y su clave para ingresar a su cuenta:

            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr> 
               
                <tr> <td colspan="2">&nbsp;</td> </tr>
                <tr>
                <td width="10" height="20"><img width="10" height="8" src="images/spacer.gif"></td> 
                <td align="left" valign="top">
                <form method="POST" action="index.php" id="loginformLeft" name="loginformLeft">
                <table width="130" cellspacing="0" cellpadding="0" border="0">
                    <tbody><tr><td class="bold10_negro">E-mail:</td></tr>
                    <tr><td><input type="text" class="fondo" size="30" value="" name="username"  id="username"></td></tr>
                    <tr><td class="bold10_negro">Clave:</td></tr>
                    <tr><td><input type="password" class="fondo" size="30" name="passwd" id="password"></td></tr>
                    <input type="hidden" name="action" value="doLogin">
                    <tr><td>&nbsp;</td></tr>
                    <tr><td ><div id="loginleftbutton"><input width="107" type="image" height="16" border="0" alt="Login" src="images/b_ingresar.gif" name="Login"  ></div></td></tr>
                    <tr>
                    <td valign="bottom" height="20"><a class="enlacesub" href="index.php?action=getFormKeyRecovery">¿Olvid&oacute; su clave?</a></td>
                    </tr>
                        <tr>
                        <td>

                        </td>
                        </tr>
                </tbody></table>
                </form>
                </td></tr>
                </tbody></table>Si a&uacute;n no tiene una cuenta, puede <a href="index.php?action=registrarseForm" >registrarse ac&aacute;</a>. </div>';

       return $return;
    }
    function getLoginFormSmall($url){

           $return='
                <form method="POST" action="index.php" id="loginformLeft" name="loginformLeft">
                    <div class="etiqueta1">Usuario / Email:</div> 
                    <div class="input1"><input type="text" class="fondo" size="17" value="" name="username"  id="username"></input></div>
                    <div class="etiqueta1">Clave:</div>
                    <div class="input1"><input type="password" class="fondo" size="17" name="passwd" id="password"></input></div>
                    <input type="hidden" name="action" value="doLogin">
                    <div class="input2"><input type="submit" value="Ingresar" ></input> </div>
                    </form>
                    <div class="link"><a  href="index.php?action=registrarseForm">Regístrarse >></a></div>
                    ';

       return $return;
    }
    
    function getHomeSmall($data){
        
        $return='<a class="bold10_negro" href="index.php?action=doLogout" ><div class="menuitem">- Salir -</div></a>
                 <a class="bold10_negro" href="index.php?action=listarPedidos" ><div class="menuitem">- Revisar pedidos -</div></a>
                <a class="bold10_negro" href="index.php?action=listCar" ><div class="menuitem">- Ver carrito -</div></a>
                <a class="bold10_negro" href="index.php?action=editUser" ><div class="menuitem">- Mis datos -</div></a> 
                <a class="bold10_negro" href="index.php?action=myAccount" ><div class="menuitem">- Mi cuenta -</div></a>
                <div class="usuariomenuitem">'.  utf8_decode($data['cliente']->nombre).'</div>';
           
        return $return;
    }
    
    function getFormData($data){
       
       $return = "
           <p>"._USERDATA."</p>
               <form action='".$data['url']."' >
                   <input type='hidden' name='action' value='saveDataUser' />
                   <input type='hidden' name='opt' value='saveDataUser' />
           <table  border=0 class='path'>
           <tr>
           <td>"._NOMBRE."</td>
               <td><input type='text' name='nombre' value='".$data['cliente']->nombre."' /></td>
            </tr>
           <tr>
           <td>"._IDENTIFICACION."</td>
               <td><input type='text' name='nit' value='".$data['cliente']->nit."' /></td>
            </tr>
            <tr>
           <td>"._EMAIL."</td>
               <td><input type='text' name='email' value='".$data['cliente']->email."' /></td>
            </tr>
            <tr>
           <td>"._DIRECCION."</td>
               <td><input type='text' name='direccion' value='".$data['cliente']->direccion."' /></td>
            </tr>
            <tr>
           <td>"._TELEFONO."</td>
               <td><input type='text' name='telefono' value='".$data['cliente']->telefono."' /></td>
            </tr>
            <tr>
             <td>"._CONTACTO."</td>
               <td><input type='text' name='contacto' value='".$data['cliente']->contacto."' /></td>
            </tr>
            <tr>
             <td>"._TELEFONOCONTACTO."</td>
               <td><input type='text' name='telefonocontacto' value='".$data['cliente']->telefonocontacto."' /></td>
            </tr>
            <tr>
           <td>"._CIUDAD."</td>
               <td><select name=idciudad>";
             foreach($data['cities'] as $row){
                 if($row['id_ciudades']==$data['cliente']->idciudad){
                     $selected='SELECTED';
                 }else{
                     $selected='';
                 }
                 $return.="<option value='".$row['id_ciudades']."' ".$selected.">".$row['nombre']."</option>";
             }
            $return.="</select></td>
            </tr>
            
            <tr>
            <td><input type='submit' value='Guardar Cambios' ></td>
            <td><a href='index.php?action=myAccount' >["._CANCELAR."]</a></td>
            </tr>
           </table>
           </form>"; 
       return $this->getHome(array('titulo'=>'Modificar datos','data'=>$return));
    }
    function getError($error){
        return "<p>".$error."</p>";
    }
    
    function redirect($url){
        $print = "<html>
            <head><meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=".$url."\">
            </head>
               </html>";
        return $print;
    }
    
    
    function getHome($data){
        if(isset($data['titulo'])){
        $print = '<table cellspacing="0" cellpadding="0" border="0">
              <tbody><tr> 
                <td height="20" bgcolor="#990000">&nbsp;</td>
              </tr>
              <tr> 
                <td align="center" valign="top"> 

                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody><tr> 
                        <td>&nbsp;</td>
                    </tr>
                <tr> 
                    <td>
                        <font color="#990000"><span class="titulo_cat">'.$data['titulo'].'</span></font>
                        </td>
                </tr>
                <tr>
                    <td>
                        
                        '.$data['data'].'
                    </td>
                </tr>
                    </tbody></table>
                    </form>


                        </td>
                        </tr>
                        </tbody></table>';
        }else{
            $print='';
            foreach($data['data']as $row){
                $print.="<div class='itemmyacount' style='widht:400px !important; float:left !important;'>".$row."</div>";
            }
        }
       return $print;
    }
    
    function getFormKeyRecovery(){
        $return = "Por favor ingrese la direccion de correo electronico que tiene registrada con nosotros
                    <form>
                    email:
                    <input type='text' name='email' value='' ></input>
                    <input type='submit' value='Enviar correo de recuperacion' > </input>
                    </form>";
        return $return;
    }
    
    function registrarseForm($data){
         require_once("lib/recaptchalib.php");
         if(!isset($data['request']['nombre'])){
             $data['request']['nombre']='';
             $data['request']['identificacion']='';
             $data['request']['username']='';
             $data['request']['email']='';
             $data['request']['telefono']='';
             $data['request']['direccion']='';
             $data['request']['paises']='';
             $data['request']['ciudades']='';
             $data['request']['boletin']='';
         }
        $paises = "<select name='paises' id='paises'><option value=''></option>";
        
        foreach($data['paises'] as $row){
            if($data['request']['paises']==$row['id_paises']){
                $selected='SELECTED';
            }else{
                $selected='';
            }
            $paises.="<option value='".$row['id_paises']."' $selected >".$row['nombre']."</option>";
        }
        $paises.="</select>";
        $documentos = "<select name='documentos' id='documentos'>";
        
        foreach($data['documentos'] as $row){
            
            $documentos.="<option value='".$row['id_tipo_documento']."'>".$row['nombre']."</option>";
        }
        $documentos.="</select>";
        $return = " 
                    <form action='index.php' name='usuarioForm' id='usuarioForm' >
                    <div class='path' style='float:left; '>
    
                    <table class='path' cellpadding=2 cellspacing=2 style='width:600px;margin: 0 0 0 40px;'>
                    <tr>
                        <td colspan='4'><h3>Registro de nuevo usuario</h3></td>
                    </tr>
                    <tr>
                        <td>Nombre Completo</td>
                        <td colspan='3'><input type='text' name='nombre' id='nombre' size='50' value='".$data['request']['nombre']."' /></td>
                    </tr>
                    <tr>
                    <td>Identificaci&oacute;n:</td>
                    <td colspan='3'>
                        ".$documentos."  <input type='text' name='identificacion' id='identificacion' value='".$data['request']['identificacion']."' /></td>
                    </tr>
                    <tr>
                    <td>Username:</td>
                    <td colspan='4' >
                         <input type='text' name='username' id='username' value='".$data['request']['username']."'></input><div id='menssageUser'></div></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td colspan='3'><input type='text' name='email' id='email' size='50' value='".$data['request']['email']."' /></td>
                    </tr>
                    <tr>
                        <td>Tel&eacute;fono: </td>
                        <td colspan='3'><input type='text' name='telefono' id='telefono' size='50' value='".$data['request']['telefono']."'/></td>
                    </tr>
                    <tr>
                        <td>Direcci&oacute;n de correspondencia: </td>
                        <td colspan='3'><input type='text' name='direccion' id='direccion' size='50' value='".$data['request']['direccion']."' /></td>
                    </tr>
                    <tr>
                        <td>Pais: </td>
                        <td>".$paises."</td>
                    
                        <td>Ciudad: </td>
                        <td><select id='ciudades' name='ciudades'></select></td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td colspan='3'><p> </p><p><input type='checkbox' CHECKED id='boletin' name='boletin' /> Deseo recibir bolet&iacute;n de novedades</p></td>
                    </tr>
                    <tr>
                        <td colpsan='4'><p> </p></td>
                    </tr>
                    <tr>
                    <td colspan=2>
                    ". recaptcha_get_html(_RECAPTCHAPUBLICKEY)."
                    </td>
                    </tr>
                    <tr>
                    <td colspan='2'><input type='submit' id='formusuarioButton' name='formusuarioButton' value='Crear Usuario'/></td>
                    <input type='hidden' name='action' value='crearUsuario' />
                    <td colspan='2'><a href='index.php'>[ Cancelar ]</a></td>
                    </tr>
                    </table>
                    </div>
                    </form>";
        return $return;
    }
    

    
    function mensageCreacionUsuario($data){
        $return = ($data)?"<div >Su usuario ha sido creado. Recibir&aacute; un correo con instrucciones para acceder a su cuenta. Gracias por preferirnos</div>":
            "<div>Ocurrio un error mientras se procesaba su solicitud. por favor intenete nuevamente o comuniquese con nuestra area de soporte.</div>";
        return $return;
    }

}

?>

