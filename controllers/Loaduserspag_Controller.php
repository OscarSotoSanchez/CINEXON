<?php

include_once 'core/class/ControllersBase.php';
include_once 'core/class/OtherFunctions.php';
include_once 'models/Loaduserspag_Model.php';
include_once 'core/class/Sessions.php';

class Loaduserspag_Controller extends ControllersBase {

    public function view($id) {

        ob_start();

        $loadViewUser = new Loaduserspag_Model();
        $otherFunc = new OtherFunctions();

        $session = new Sessions();

        $user = $loadViewUser->getUser($id);
        if (!$user) {
            header('Location: usuarios');
        }
        
        $valorationArray = $loadViewUser->getValoration($id);
        $lists = $loadViewUser->getLists($id);
        $userSession = $session->getConnectUser();
        $buys = $loadViewUser->getShops($id);
        $messages = $loadViewUser->getMessages($id);

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
