<?php

include_once 'db/FunctionsDB.php';

class Loadfilms_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getFilmsRange($start, $finish) {
        $arrayFilms = $this->functionsDB->getFilmsRange($start, $finish);
        return $arrayFilms;
    }

    public function getAllIDFilms() {
        $arrayIDFilms = $this->functionsDB->getAllIDFilms();
        return $arrayIDFilms;
    }

    public function getFilm($id) {
        $film = $this->functionsDB->getFilmsID($id);
        return $film;
    }

}
