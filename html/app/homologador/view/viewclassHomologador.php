<?php
    class viewclassHomologador {
       
       public function viewMenu(){
           
           
           $menu = array("titulo"=>"Titulo","autor"=>"Autor","isbn"=>"ISBN"); 
           
           $return="<table border = 0 cellspacing='20' cellpading = '20' style='border-style:solid;border-color:#ccc;border-width:1px; background:#ddd;'>".
                   "<tr style='vertical-align:middle;'>".
                   "<td><img src='images/li_rojo.gif'</td>".
                   "<td><a href = 'homologador.php?action=listar&opt=nohomologados'>No Homologados</a></td>".
                   "<td><a href = 'homologador.php?action=listar&opt=homologados'>Homologados</a></td>".
                   "<td><a href = 'homologador.php?action=listar&opt=todos'>Todos</a></td>".
                   "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>".
                   
                   "<td><form action='homologador.php'>
                       <input type='text' name='search' />
                       <select name='tipo_search'>
                       ";
           
           foreach ($menu as $key=>$value){
               $return.="<option value='".$key."'>".$value."</option>";
           }
           $return.="
                       </select>
                        <input type='submit' value='buscar'></form></td>".
                   "</tr>".
                   "</table>";
           return $return;
       }
       
       public function viewResultSave(){
           
       }
       
       public function  viewTitulos(){
           
       }
       
       public function viewEditTitulos(){
           
       }
       
       public function viewHeader(){
           return "<thml><head></head><body>";
       }
       
       public function viewFooter(){
           return "</body></html>";
       }
    }

?>
