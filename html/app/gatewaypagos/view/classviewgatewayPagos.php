<?php


class classviewgatewayPagos {
    
    function cargarPlataforma($datos){
        $return = "<html>
        <head>
        <title>Descarga</title>
        <META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=".$datos."\">
        </head>
        <body>
        <table border='0' cellspacing='10' cellpadding='10'>
        <tr>
        <td><img src='images/li_rojo.gif' ></td>
        <td><img src='images/PagosOnline.jpg' ></td>
        </tr>
        </table>
        
        <p>Si no es redireccionado en 10 segundos, haga <a href='".$datos."'>Click Aqu&iacute;</a></p></body>
        </html>";
        return $return;
    }
    
    
    function paginaRespuestaExito($datos){
           
           $print = "<html>
        <head>
        <title>Pgina de Respuesta Pago</title>
        </head>
        <body>
        <table border='0' cellspacing='10' cellpadding='10'>
        <tr>
        <td><img src='images/li_rojo.gif' ></td>
        <td><img src='images/PagosOnline.jpg' ></td>
        </tr>
        </table>
        ".
          $datos['descripcion']."
           <p style='font-color:green;'><b>".$datos['']."</b></p>
           <p><b>codigo autorizaci&oacute;n:</b> ".$datos['codigo_autorizacion']."</p>
           <p><b>Valor:</b> $".(number_format($datos['valor']))." ".$datos['moneda']."</p>
           <p><b>codigo autorizaci&oacute;n:</b> ".$datos['codigo_autorizacion']."</p>
           <p><b>fecha de procesamiento:</b> ".$datos['fecha_procesamiento']."</p>
               <p> </p>
           <p><b>Ya puede cerrar esta ventana</b> </p>
         </body>
        </html>";
           return $print;

    }

    function paginaRespuestaEnValidacion($datos){
           
           $print = "<html>
        <head>
        <title>Pagina de Respuesta Pago en linea</title>
        </head>
        <body>
        <table border='0' cellspacing='10' cellpadding='10'>
        <tr>
        <td><img src='images/li_rojo.gif' ></td>
        <td><img src='images/PagosOnline.jpg' ></td>
        </tr>
        </table>
        ".
          $datos['descripcion']."
           <p><b>".$datos['mensaje']."</b></p>
           <p><b>Valor:</b> $".(number_format($datos['valor']))." ".$datos['moneda']."</p>
           <p><b>Ya puede cerrar esta ventana</b> </p>
         </body>
        </html>";
           return $print;

    }
    
}

?>
