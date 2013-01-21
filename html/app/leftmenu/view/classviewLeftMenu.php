<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classviewLeftMenu
 *
 * @author oborja
 */
class classviewLeftMenu {
   public $print;
   function getMenu($data,$selected=''){
       $this->print='';
       foreach($data as $row){
           if($selected == $row['id_categorias']){
               $resaltar = " class='resaltado' ";
           }else{
               $resaltar = "";
           }
           $this->print.="<tr $resaltar ><td ><a class='bold10_gris' href='index.php?action=listCatalogo&theme=".$row['id_categorias']."'>".$row['nombre']."</a></td></tr>";
       }
       return $this->print;
    }
  
}

?>
