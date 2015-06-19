<?php

include_once 'core/class/ControllersBase.php';
include_once 'core/class/Sessions.php';
include_once 'core/class/Film.php';

class Loadshoppingcart_Controller extends ControllersBase{
    public function view(){
        
        ob_start();
        
        $session = new Sessions();
        $resetTickets = $session->checkTickets();
        $shoppingCart = $session->getShoppingCart();
        $totalPriceShoppingCart = $session->getTotalPriceShoppings();
        $role = $session->getConnectUser()->getRole_user();
                
        include 'views/default/modules/loadShoppingCart.php';
        $films = ob_get_clean();
        
        $page = $this->load_template_normal("layoutFilmFondo");               
        $page = $this->replace_content('/\#CONTENT\#/ms',$films, $page);
        
        $this->view_page($page);
    }   
}
