<?php

include_once 'db/FunctionsDB.php';

class Loadfilm_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getFilm($id) {
        $film = $this->functionsDB->getFilmsID($id);
        return $film;
    }

    public function getRelated($id) {
        $films = $this->functionsDB->getRelatedFilms($id);
        return $films;
    }

    public function getValoration($id) {
        $valorations = $this->functionsDB->getAllValorations($id);
        return $valorations;
    }

    public function getListsIfNotFilm($id_user, $id_movie) {
        $lists = $this->functionsDB->getListsIfNotAddFilmUser($id_user, $id_movie);
        return $lists;
    }

    public function getOfferAll($id) {
        $offers = $this->functionsDB->getOfferByFilm($id);
        return $offers;
    }

}
