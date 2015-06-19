<?php

include_once 'db/FunctionsDB.php';

class Loadsettingsadmin_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getFilms() {
        $films = $this->functionsDB->getAllFilms();
        return $films;
    }

    public function getDirectors() {
        $directors = $this->functionsDB->getAllDirectors();
        return $directors;
    }

    public function getActors() {
        $actors = $this->functionsDB->getAllActors();
        return $actors;
    }

    public function getCinemas() {
        $cinemas = $this->functionsDB->getAllCinemas();
        return $cinemas;
    }

    public function getOffers() {
        $offers = $this->functionsDB->getAllOffers();
        return $offers;
    }

    public function getGeneros() {
        $generos = $this->functionsDB->getAllGeneros();
        return $generos;
    }

}
