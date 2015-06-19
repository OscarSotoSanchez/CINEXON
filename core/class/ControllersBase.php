<?php

include_once 'core/class/Sessions.php';
include_once 'core/class/User.php';

class ControllersBase {

    public function load_template_normal($classCSS = "normal") {
        $page = $this->load_page('views/default/page.html');

        if ($classCSS == "normal") {
            $page = $this->replace_content('/\#CLASSBODY\#/ms', "", $page);
        } else {
            $page = $this->replace_content('/\#CLASSBODY\#/ms', $classCSS, $page);
        }

        ob_start();       
        $session = new Sessions();
        $nameUser = $session->getConnectUser()->getNick_user();
        $numShops = $session->getTotalShoppings();
        $role = $session->getConnectUser()->getRole_user();
        include 'views/default/sections/navHeaderUser.php';
        $navHeader = ob_get_clean();
        $page = $this->replace_content('/\#NAVHEADER\#/ms', $navHeader, $page);
        
        
        $footer = $this->load_page('views/default/sections/footer.html');
        $page = $this->replace_content('/\#FOOTER\#/ms', $footer, $page);

        return $page;
    }

    public function load_template_main_page() {
        $page = $this->load_page('views/default/page.html');

        $navHeader = $this->load_page('views/default/sections/navHeaderPrincipal.html');
        $page = $this->replace_content('/\#NAVHEADER\#/ms', $navHeader, $page);
        
        $footer = $this->load_page('views/default/sections/footer.html');
        $page = $this->replace_content('/\#FOOTER\#/ms', $footer, $page);

        return $page;
    }

    public function load_template_register_page() {
        $page = $this->load_page('views/default/registerPage.html');

        return $page;
    }

    public function addJS($page, $js) {
        $returnPage = $this->replace_content('/\#MOREJS\#/ms', $js, $page);
        return $returnPage;
    }

    public function replace_content($in, $out, $page) {
        return preg_replace($in, $out, $page);
    }

    public function load_page($page) {
        return file_get_contents($page);
    }

    public function view_page($html) {
        echo $html;
    }

}
