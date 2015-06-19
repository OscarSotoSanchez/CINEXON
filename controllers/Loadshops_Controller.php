<?php

include_once 'core/class/ControllersBase.php';
include_once 'core/class/Sessions.php';
include_once 'core/class/Film.php';

class Loadshops_Controller extends ControllersBase{
    public function view(){
        
        ob_start();
        
        $session = new Sessions();
        $shoppingCart = $session->cartPay();
        
        $arrayDigital = array();
        $arrayCartelera = array();
            
        for ($x=0; $x < count($shoppingCart); $x++){
            if ($shoppingCart[$x][0][0]->getFormat_movie() == "Digital"){
                array_push($arrayDigital, $shoppingCart[$x]);
            } else {
                array_push($arrayCartelera, $shoppingCart[$x]);
            }
        }
                
        include 'views/default/modules/loadShops.php';
        $films = ob_get_clean();
        
        $page = $this->load_template_normal("layoutFilmFondo");               
        $page = $this->replace_content('/\#CONTENT\#/ms',$films, $page);
        
        $this->view_page($page);
    }   
}
