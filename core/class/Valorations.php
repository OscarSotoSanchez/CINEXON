<?php

class Valorations {

    private $id_valoration;
    private $id_user;
    private $name_user;
    private $id_movie;
    private $name_movie;
    private $valoration;
    private $review;
    private $date_valoration;

    function __construct($id_valoration, $id_user, $id_movie, $valoration, $review, $date_valoration) {
        $this->id_valoration = $id_valoration;
        $this->id_user = $id_user;
        $this->id_movie = $id_movie;    
        $this->valoration = $valoration;
        $this->review = $review;
        $this->date_valoration = $date_valoration;
    }

    function getId_valoration() {
        return $this->id_valoration;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getName_user() {
        $this->setName_user();
        
        return $this->name_user;
    }

    function getId_movie() {
        return $this->id_movie;
    }

    function getName_movie() {
        $this->setName_movie();
        
        return $this->name_movie;
    }

    function getValoration() {
        return $this->valoration;
    }

    function getReview() {
        return $this->review;
    }

    function getDate_valoration() {
        return $this->date_valoration;
    }

    function setId_valoration($id_valoration) {
        $this->id_valoration = $id_valoration;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setName_user() {
        $functionDB = new FunctionsDB();

        $user = $functionDB->getUserID($this->id_user);
        $this->name_user = $user->getNick_user();
    }

    function setId_movie($id_movie) {
        $this->id_movie = $id_movie;
    }

    function setName_movie() {
        $functionDB = new FunctionsDB();

        $movie = $functionDB->getFilmsID($this->id_movie);
        $this->name_movie = $movie->getTitle_movie();
    }

    function setValoration($valoration) {
        $this->valoration = $valoration;
    }

    function setReview($review) {
        $this->review = $review;
    }

    function setDate_valoration($date_valoration) {
        $this->date_valoration = $date_valoration;
    }

}
