<?php
    require_once("config.php");
    require_once("app/inventarios/classInventarios.php");
    
    
    $she = new classInventarios(getInput());
    
    function getInput() {
        $fr = fopen("php://stdin", "r");
        $input = '';
        while (!feof ($fr)) {
            $input .= fgets($fr);
        }
        fclose($fr);
        $input = trim($input);
        return (sizeof($input)>0)?$input:false;
    }
?>
