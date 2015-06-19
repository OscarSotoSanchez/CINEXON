<?php

include_once 'core/class/ControllersBase.php';
include_once 'core/class/OtherFunctions.php';
include_once 'models/Loadsettings_Model.php';
include_once 'core/class/Sessions.php';

class Loadsettings_Controller extends ControllersBase {

    public function view() {

        ob_start();

        $loadSettings = new Loadsettings_Model();
        $otherFunc = new OtherFunctions();
        $session = new Sessions();
        
        $session->reloadUser();

        $valorationArray = $loadSettings->getValoration($session->getConnectUser()->getId_user());
        $lists = $session->getLists();
        $user = $session->getConnectUser();
        $userSession = $session->getConnectUser();
        $buys = $session->getBuys();
        $messages = $session->getMessages();

        $arrayDigital = array();
        $arrayCartelera = array();

        for ($x = 0; $x < count($buys); $x++) {            
            if ($buys[$x]->getFilm_buy()->getFormat_movie() == "Digital") {
                array_push($arrayDigital, array($buys[$x]->getFilm_buy(), $buys[$x]));
            } else {
                array_push($arrayCartelera, array($buys[$x]->getFilm_buy(), $buys[$x]));
            }
        }

        include 'views/default/modules/loadSettings.php';
        $films = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $films, $page);

        $this->view_page($page);
    }

}
