<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classviewInventarios
 *
 * @author oborja
 */
class classviewDestacados {
    
	public function consultaDestacadosTitulos($data){

            $return="";
            foreach($data as $row){
                list($year,$hour)=explode(' ',$row['fin']);
                $return.="<div class='panel' onClick='getItem(\"".$row['id_titulos']."\");'>";
                //".$row['detalle']['link_imagen']."
                $return.= "
                    <img src='images/nohay.gif' /><div class='titulo' > ".$row['detalle']['titulo']."</div>
                  
                    <div class='precio'>Precio $".(number_format($row['precio']))."</div>";
                if(sizeof($row['observaciones'])>0){
                 //   $return.="<div class='observaciones'>".($row['observaciones'])."</div>";
                }
                if($row['descuento'] >0){
                    $return.="<div class='descuento'>Descuento: ".($row['descuento'] * 100)."%</div>
                    <div class='preciooferta'>Precio de Oferta $".(number_format($row['precio']*(1-$row['descuento'])))."</div>
                    <div class='validesoferta'>Oferta valida hasta: ".$year."</div>";
                }
                
                $return.="</div>";
            }
            return $return;
        }
        
}

?>
