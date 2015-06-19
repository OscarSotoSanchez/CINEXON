<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadmodcinema_Model.php';

class Loadmodcinema_Controller extends ControllersBase {

    public function view($id) {

        ob_start();

        $loadModCinema = new Loadmodcinema_Model();
        $cinema = $loadModCinema->getCinema($id);


        include 'views/default/modules/loadModCinema.php';
        $film = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $film, $page);

        $this->view_page($page);
    }

}
