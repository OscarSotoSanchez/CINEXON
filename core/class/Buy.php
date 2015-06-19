<?php

class Buy {

    private $id_buy;
    private $id_movie;
    private $id_user;
    private $date_buy;
    private $tickets_buy;
    private $id_cinema;
    private $hora;
    private $film_buy;

    function __construct($id_buy, $id_movie, $id_user, $date_buy, $tickets_buy, $id_cinema, $hora) {
        $this->id_buy = $id_buy;
        $this->id_movie = $id_movie;
        $this->id_user = $id_user;
        $this->date_buy = $date_buy;
        $this->tickets_buy = json_decode($tickets_buy);
        $this->id_cinema = $id_cinema;
        $this->hora = $hora;
    }

    function getId_buy() {
        return $this->id_buy;
    }

    function getId_movie() {
        return $this->id_movie;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getDate_buy() {
        return $this->date_buy;
    }

    function getTickets_buy() {
        return $this->tickets_buy;
    }

    function getId_Cinema() {
        return $this->id_cinema;
    }

    function getHora() {
        return $this->hora;
    }

    function getFilm_buy() {
        $this->setFilm_buy();

        return $this->film_buy;
    }

    function setId_buy($id_buy) {
        $this->id_buy = $id_buy;
    }

    function setId_movie($id_movie) {
        $this->id_movie = $id_movie;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setDate_buy($date_buy) {
        $this->date_buy = $date_buy;
    }

    function setTickets_buy($tickets_buy) {
        $this->tickets_buy = $tickets_buy;
    }

    function setId_Cinema($id_cinema) {
        $this->id_cinema = $id_cinema;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setFilm_buy() {
        $functionDB = new FunctionsDB();

        $film_buy = $functionDB->getFilmsID($this->id_movie);
        $this->film_buy = $film_buy;
    }

}
