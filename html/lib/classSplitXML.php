<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classSplitXML
 *
 * @author oborja
 */
class classSplitXML {

	public $fileXML;
        public $file;
        public $header;
        public $footer;
        public $separador;
        public $maxsize;
        public $chips;
        
        function __construct($filexml){
            $this->fileXML = $filexml;
            $this->chips=0;
        }
        

}

?>
