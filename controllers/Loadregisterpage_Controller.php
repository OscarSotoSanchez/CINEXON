<?php

include_once 'core/class/ControllersBase.php';

class Loadregisterpage_Controller extends ControllersBase{
    public function view(){       
        $page = $this->load_template_register_page(); 
        
        $register = $this->load_page("views/default/modules/loadRegister.html");
        $page = $this->replace_content('/\#CONTENT\#/ms',$register, $page);
        
        $this->view_page($page);
    }   
}
