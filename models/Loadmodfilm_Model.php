<?php

include_once 'db/FunctionsDB.php';

class Loadmodfilm_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getFilm($id) {
        $film = $this->functionsDB->getFilmsID($id);
        return $film;
    }

    public function getDirectors($id) {
        $directors = $this->functionsDB->getDirectorNotInFilmID($id);
        return $directors;
    }

    public function getActors($id) {
        $directors = $this->functionsDB->getActorsNotInFilmID($id);
        return $directors;
    }

    public function getOffer($id) {
        $offer = $this->functionsDB->getOfferByFilm($id);
        return $offer;
    }

    public function getGeneros($id) {
        $generos = $this->functionsDB->getGeneroNotInFilmID($id);
        return $generos;
    }

    public function getCinemas($id) {
        $cinemas = $this->functionsDB->getCinemaNotInFilmID($id);
        return $cinemas;
    }

}
