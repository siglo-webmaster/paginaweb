<?php
require_once('view/classviewLeftMenu.php');
require_once('model/classmodelLeftMenu.php');
class classLeftMenu {
    public $model;
    public $view;
    function __construct() {
        $this->model = new classmodelLeftMenu();
        $this->view = new classviewLeftMenu();
    }
    function getMenu($id_padre=''){
        $this->model->getCategorias($id_padre);
        $theme = (isset($_REQUEST['theme']))?preg_replace("[^0-9]", "",$_REQUEST['theme']):'';
           
        return $this->view->getMenu($this->model->data,$theme);
    }
}

?>
