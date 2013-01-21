<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classSHE
 *
 * @author oborja
 */
class classSHE {
    public $file;
    
    function __construct(){
        $this->cargarCatalogo();
    }
    
    function cargarCatalogo(){
       $fp = fopen ( "catalogo/CATAL1.TXT" , "r" );
        while (( $data = fgetcsv ( $fp , 2048, ",")) !== false ) {
            $i = 0;
            foreach($data as $row) {
                echo "<table border=0><td><input type=text ></input></td><td>Campo $i: $row</td></table><br>"; // Muestra todos los campos de la fila actual
                $i++ ;
            }
            echo "<br /><br />\n\n";
        }
        fclose ( $fp );  
    }
}

?>
