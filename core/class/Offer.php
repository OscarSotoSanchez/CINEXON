<?php

class Offer {

    private $id_offer;
    private $id_cinema;
    private $id_movie;
    private $tickets;
    private $hora;
    private $cinema;
    private $movie;

    function __construct($id_offer, $id_cinema, $id_movie, $tickets, $hora) {
        $this->id_offer = $id_offer;
        $this->id_cinema = $id_cinema;
        $this->id_movie = $id_movie;
        $this->tickets = json_decode($tickets);
        $this->hora = $hora;
    }

    function getId_offer() {
        return $this->id_offer;
    }

    function getId_cinema() {
        return $this->id_cinema;
    }

    function getId_movie() {
        return $this->id_movie;
    }

    function getTickets() {
        return $this->tickets;
    }

    function getHora() {
        return substr($this->hora, 0, 5);
    }

    function getCinema() {
        $this->setCinema();

        return $this->cinema;
    }

    function getMovie() {
        $this->setMovie();

        return $this->movie;
    }

    function setId_offer($id_offer) {
        $this->id_offer = $id_offer;
    }

    function setId_cinema($id_cinema) {
        $this->id_cinema = $id_cinema;
    }

    function setId_movie($id_movie) {
        $this->id_movie = $id_movie;
    }

    function setTickets($tickets) {
        $this->tickets = $tickets;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setCinema() {
        $functionDB = new FunctionsDB();

        $cinema = $functionDB->getCinema($this->id_cinema);
        $this->cinema = $cinema;
    }

    function setMovie() {
        $functionDB = new FunctionsDB();

        $movie = $functionDB->getFilmsID($this->id_movie)->getTitle_movie();
        $this->movie = $movie;
    }

}
