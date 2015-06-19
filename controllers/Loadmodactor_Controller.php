<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadmodactor_Model.php';

class Loadmodactor_Controller extends ControllersBase {

    public function view($id) {

        ob_start();

        $loadModActor = new Loadmodactor_Model();
        $actor = $loadModActor->getActor($id);

        include 'views/default/modules/loadModActor.php';
        $film = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $film, $page);

        $this->view_page($page);
    }

}
