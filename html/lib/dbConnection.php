<?php
require_once('MyPDOStatementClass.php');

class dbConnection {
    var $conn;
    var $status;
    var $data;
    
    function __construct() {
        try{
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_STATEMENT_CLASS => array('MyPDOStatementClass', array()),
                  );
                
                $this->conn = new PDO("mysql:host="._DBHOST.";dbname="._DBCATALOG,_DBUSER,_DBPASSWD,$options);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->status=true;
        }catch(PDOException $e){
                $this->status=false;
                echo $e->getMessage();
        }
    }
    
    function audit(){
        $mydb = new MyPDOStatementClass();
        var_dump( $mydb->_debugQuery());
    }
}

?>
