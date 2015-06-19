<?php

include_once 'core/class/ControllersBase.php';

class Loadloginmesajepage_Controller extends ControllersBase{
    public function view($message, $type){       
        $page = $this->load_template_register_page(); 
        
        ob_start();
        
        include "views/default/modules/loadMessageLogin.php";
        $login = ob_get_clean();
        
        $page = $this->replace_content('/\#CONTENT\#/ms',$login, $page);
        
        $this->view_page($page);
    }   
}
