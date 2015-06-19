<?php

include_once 'core/class/ControllersBase.php';
include_once 'core/class/OtherFunctions.php';
include_once 'core/class/Sessions.php';

class Loadsettingsadminnormal_Controller extends ControllersBase {

    public function view() {

        ob_start();

        $session = new Sessions();

        $user = $session->getConnectUser();
        $messages = $session->getMessages();


        include 'views/default/modules/loadSettingsAdminNormal.php';
        $films = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $films, $page);

        $this->view_page($page);
    }

}
