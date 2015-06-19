<?php

include_once 'db/FunctionsDB.php';

class LoadfilmSearchComplex_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getFilmsSearchComplex($title, $genero, $director) {
        $arrayFilms = $this->functionsDB->getAllFilmSearchComplex($title, $genero, $director);
        return $arrayFilms;
    }

    public function getFilm($id) {
        $film = $this->functionsDB->getFilmsID($id);
        return $film;
    }

}
