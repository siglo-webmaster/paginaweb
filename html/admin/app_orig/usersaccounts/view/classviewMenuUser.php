<?php


class classviewMenuUser {
    var $items;
    
    function getMenuUser($data){
        $return = "<div class='menuUser'>
                <ul>";
        if(is_array($data)){
            foreach ($data as $row){
                $return.="<li>"."<a href='index.php?action=loadModule&id_module=".$row['id_modulos']."'>".$row['nombre_modulo']."</a>"."</li>";
            }
        }
        $return.="<li><a href='index.php?action=logout'>Salir</a></li>".
                "</ul></div>";
        return $return;
    }
}

?>
