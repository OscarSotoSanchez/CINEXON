<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/LoadStartPage_Model.php';

class LoadStartPage_Controller extends ControllersBase{
    public function view($numLast, $numCartelera){
        
        ob_start();
        
        $startPage = new LoadStartPage_Model();
        
        $lastAdd = $startPage->getFilmsFinish($numLast);
        $cartelera = $startPage->getFilmsCartelera($numCartelera);
        
        include 'views/default/modules/loadStartPage.php';
        $carousels = ob_get_clean();
        
        $page = $this->load_template_normal("");               
        $page = $this->replace_content('/\#CONTENT\#/ms',$carousels, $page);
        
        $this->view_page($page);
    }   
}
