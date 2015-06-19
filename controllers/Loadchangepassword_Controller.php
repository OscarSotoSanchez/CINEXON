<?php

include_once 'core/class/ControllersBase.php';

class Loadchangepassword_Controller extends ControllersBase{
    public function view(){       
        $page = $this->load_template_register_page(); 
        
        $password = $this->load_page("views/default/modules/loadChangePassword.html");
        
        $page = $this->replace_content('/\#CONTENT\#/ms',$password, $page);
        
        $this->view_page($page);
    }   
}
