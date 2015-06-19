<?php

include_once 'db/FunctionsDB.php';

class Loadfilmsearch_model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getFilmsSearch($word) {
        $arrayFilms = $this->functionsDB->getAllFilmSearch($word);
        return $arrayFilms;
    }

    public function getFilm($id) {
        $film = $this->functionsDB->getFilmsID($id);
        return $film;
    }

}
