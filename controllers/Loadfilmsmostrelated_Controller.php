<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadfilmsmostrelated_Model.php';

class Loadfilmsmostrelated_Controller extends ControllersBase {

    public function view() {

        ob_start();

        $loadFilm = new Loadfilmsmostrelated_Model();
        //$moviesArray = $loadFilm->getFilmsRange(1, 9);
        $idFilms = $loadFilm->getAllIDFilms();
        $moviesArray = array();

        $cont = 9;
        if (count($idFilms) < 9) {
            $cont = count($idFilms);
        }

        for ($x = 0; $x < $cont; $x++) {
            array_push($moviesArray, $loadFilm->getFilm($idFilms[$x]));
        }

        $idFilms = array_splice($idFilms, 9, count($idFilms));

        $activeAll = "";
        $activeMostRelared = "class='active'";

        include 'views/default/modules/loadFilms.php';
        $films = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $films, $page);

        $this->view_page($page);
    }

}
