<?php

include_once 'core/class/ControllersBase.php';

class Loadregisterwithmail_Controller extends ControllersBase{
    public function view($email){       
        $page = $this->load_template_register_page(); 
        
        ob_start();
        
        include "views/default/modules/loadRegisterUserEmail.php";
        $login = ob_get_clean();
        
        $page = $this->replace_content('/\#CONTENT\#/ms',$login, $page);
        
        $this->view_page($page);
    }   
}
