<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadmainpage_Model.php';

class Loadmainpage_Controller extends ControllersBase{
    public function view(){      
        ob_start();
        $page = $this->load_template_main_page();
        
        $films = new Loadmainpage_Model();
        $moviesArray = $films->getFilmsFinish(10);  
        
        include 'views/default/modules/mainPage.php';
        $films = ob_get_clean();
        
        $page = $this->replace_content('/\#CONTENT\#/ms',$films, $page);
        
        $this->view_page($page);
    }   
}
