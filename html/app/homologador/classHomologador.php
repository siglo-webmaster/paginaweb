<?php
    require_once('app/homologador/model/modelclassHomologador.php');
    require_once('app/homologador/view/viewclassHomologador.php');
    
    class classHomologador {
        private $retHTML;
        private $view;
        private $model;
        
        protected $data;


        /*! \brief costructor inicializa las variables a usar y genera el menu a presentar en la pagina
         * 
         */
        function __construct(){
            $this->model = new modelclassHomologador();
            $this->view = new viewclassHomologador();
            $this->retHTML=$this->view->viewMenu();
            
            if(isset($_REQUEST['action'])){
                switch ($_REQUEST['action']){
                    case 'listar':{
                        $this->model->data['type']=$_REQUEST['opt'];
                        $this->model->getTitulos();
                    }
                }
            }
            
        }
        
        /*| \brief Lista los titulos existentes, se puede especificar si se muestra los homoogados, los no homologados o todos
         * 
         * \param $tipo el tipo de titulo a listar{homologados, nohomologados, ambos}
         * \return no retorna. el codigo HTML de la consulta se coloca en el atributo $returnHTML
         */
        public function listTitulos(){
            
        }
        
        public function detallesTitulo(){
            
        }
        
        public function modificarTitulo(){
            
        }
        
        public function BuscarTitulo(){
            
            
        }
        
        public function renderHTML(){
            return $this->view->viewHeader().$this->retHTML.$this->view->viewFooter();
        }
    }

?>
