<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadmoddirector_Model.php';

class Loadmoddirector_Controller extends ControllersBase {

    public function view($id) {

        ob_start();

        $loadModDirector = new Loadmoddirector_Model();
        $director = $loadModDirector->getDirector($id);

        include 'views/default/modules/loadModDirector.php';
        $film = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $film, $page);

        $this->view_page($page);
    }

}
