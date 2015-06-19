<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/LoadfilmSearchComplex_Model.php';

class LoadfilmsSearchComplex_Controller extends ControllersBase {

    public function view($title, $genero, $director) {

        ob_start();

        $loadFilmSearch = new LoadfilmSearchComplex_Model();
        //$moviesArray = $loadFilmSearch->getFilmsSearchComplex($title, $genero, $director);
        $idFilms = $loadFilmSearch->getFilmsSearchComplex($title, $genero, $director);
        $numResults = count($idFilms);
        $moviesArray = array();

        $cont = 9;
        if (count($idFilms) < 9) {
            $cont = count($idFilms);
        }

        for ($x = 0; $x < $cont; $x++) {
            array_push($moviesArray, $loadFilmSearch->getFilm($idFilms[$x]));
        }

        $idFilms = array_splice($idFilms, 9, count($idFilms));

        include 'views/default/modules/loadFilmsSearchComplex.php';
        $films = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $films, $page);

        $this->view_page($page);
    }

}
