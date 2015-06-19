<?php

include_once 'core/class/ControllersBase.php';
include_once 'core/class/OtherFunctions.php';
include_once 'models/Loadsettingsadmin_Model.php';
include_once 'core/class/Sessions.php';

class Loadsettingsadmin_Controller extends ControllersBase {

    public function view() {

        ob_start();

        $loadSettings = new Loadsettingsadmin_Model();
        $session = new Sessions();
        
        $films = $loadSettings->getFilms();
        $generos = $loadSettings->getGeneros();
        $directors = $loadSettings->getDirectors();
        $actors = $loadSettings->getActors();
        $cinemas = $loadSettings->getCinemas();
        $taquillaArray = $loadSettings->getOffers();
                
        include 'views/default/modules/loadSettingsAdmin.php';
        $films = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $films, $page);

        $this->view_page($page);
    }

}
