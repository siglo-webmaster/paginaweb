<?php

/**
 * Description of classviewCommon
 *
 * @author oborja
 */
class classviewCommon {
    function showDetailsItem($data){
        
         /*
          * detalles de item:
          * titulo
          * autores
          * editorial
          * fecha_pub
          * paginas
          * isbn13
          * precio
          * link_imagen
          * link_detalle
          */
            $return ="
                    <table border='0' width='90%' cellspacing='10' cellpadding='10'>
                      <tr style='vertical-align:top;'>
                        <td >
                            <div id=\"imagen_detalle\" ><img src='".$data['link_imagen']."' ></img></div>
                        </td>
                        <td>
                            <div id=\"datos_detalle\" >
                            <span class=\"titulo_detalle\"><strong><big>".$data['titulo']."</big></strong></span>
                             <br><br>
                            <span class=\"datos_detalle\"><br>".$data['autores']."</span>
                            <br><br>
                            <span class=\"datos_detalle\">Editorial:". $data['editorial']."</span>
                            <br>
                            <span class=\"datos_detalle\">A&ntilde;o de edici&oacute;n: ".$data['fecha_pub']."</span>
                            <br>
                            <span class=\"datos_detalle\">N&uacute;mero de p&aacute;ginas: ".$data['paginas']."</span>
                            <br>
                            <span class=\"datos_detalle\">ISBN: ".$data['isbn13']."</span>
                            <br>
                            <span class=\"precio_detalle\">$ ".  number_format($data['precio'])." pesos</span>
                            <br>
                        </td>
                    </tr>
                    </table>";
            return $return;
    }
    
    function listarCiudadesporPais($data){
        $return = "<option value=''></option>";
        foreach($data as $row){
            $return.="<option value = '".$row['id_ciudades']."'>".$row['nombre']."</option>";
        }
    }
}

?>
