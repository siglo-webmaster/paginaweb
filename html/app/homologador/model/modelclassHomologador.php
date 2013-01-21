<?php
require_once ("class/connPDO.php");
    
    
    class modelclassHomologador {
        public $data;
        private $conn;
        public $status;
        public function __construct() {
            try{
                        $this->conn = new PDO(_CONECCION,_DBUSER,_DBPASSWD);
                        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $this->status=true;
                }catch(PDOException $e){
                        $this->status=false;
                        echo $e->getMessage();
            }
        }
        
        public function getTitulos(){
          $query = 'SELECT * FROM TITULOS ';
          switch($this->data['type']){
              case 'homologados':{
                  $query.=" WHERE id_titulos NOT EXISTS (SELECT id_titulos from homologacion)";
                  break;
              }
              case 'nohomologados':{
                  break;
              }
              case 'todos':{
                  break;
              }
          }
            
          $conn_prepare = $this->conn->prepare($query);
          echo $query;
        }
        
        public function updateHomologacion(){
            
        }
        
        public function saveHomologacion(){
            
        }
    }

?>
