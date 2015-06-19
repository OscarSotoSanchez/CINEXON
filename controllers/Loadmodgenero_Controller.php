<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadmodgenero_Model.php';

class Loadmodgenero_Controller extends ControllersBase {

    public function view($id) {

        ob_start();

        $loadModGenero = new Loadmodgenero_Model();
        $genero = $loadModGenero->getGenero($id);

        include 'views/default/modules/loadModGenero.php';
        $film = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $film, $page);

        $this->view_page($page);
    }

}
