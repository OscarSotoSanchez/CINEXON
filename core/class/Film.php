<?php

class Film {

    private $id_movie;
    private $title_movie;
    private $poster_movie;
    private $sipnosis_movie;
    private $year_movie;
    private $format_movie;
    private $price_movie;
    private $duration_movie;
    private $awards_movie;
    private $age_calification;
    private $trailer_movie;
    private $archive_url;
    private $director = array();
    private $actors = array();
    private $genero = array();
    private $cines = array();
    private $horas = array();
    private $note;

    function __construct($id_movie, $title_movie, $poster_movie, $sipnosis_movie, $year_movie, $format_movie, $price_movie, $duration_movie, $awards_movie, $age_calification, $trailer_movie, $archive_url) {
        $this->id_movie = $id_movie;
        $this->title_movie = $title_movie;
        $this->poster_movie = $poster_movie;
        $this->sipnosis_movie = $sipnosis_movie;
        $this->year_movie = $year_movie;
        $this->format_movie = $format_movie;
        $this->price_movie = $price_movie;
        $this->duration_movie = $duration_movie;
        $this->awards_movie = $awards_movie;
        $this->age_calification = $age_calification;
        $this->trailer_movie = $trailer_movie;
        $this->archive_url = $archive_url;
    }

    function getId_movie() {
        return $this->id_movie;
    }

    function getTitle_movie() {
        return $this->title_movie;
    }

    function getTitle_Movie_Cut() {
        $titleMovie = $this->title_movie;
        $countLetters = strlen($titleMovie);

        if ($countLetters > 30) {
            $titleMovie = substr($titleMovie, 0, 28);
            $titleMovie .= "...";
        }

        return $titleMovie;
    }

    function getPoster_movie() {
        if (empty($this->poster_movie)) {
            return "http://placehold.it/200x300";
        }

        return "views/resource/img/carteles/" . $this->poster_movie;
    }

    function getPoster_movie_Name() {
        return $this->poster_movie;
    }

    function getSipnosis_movie() {
        return $this->sipnosis_movie;
    }

    function getYear_movie() {
        return $this->year_movie;
    }

    function getFormat_movie() {
        return $this->format_movie;
    }

    function getPrice_movie() {
        return $this->price_movie;
    }

    function getDuration_movie() {
        return $this->duration_movie;
    }

    function getAwards_movie() {
        return $this->awards_movie;
    }

    function getAge_calification() {
        return $this->age_calification;
    }

    function getTrailer_movie() {
        return $this->trailer_movie;
    }

    function getTrailer_movie_Youtube() {
        return explode("?v=", $this->trailer_movie)[1];
    }

    function getArchive_url() {
        return $this->archive_url;
    }

    function getDirector() {
        $this->setDirector();

        return $this->director;
    }

    function getActors() {
        $this->setActors();

        return $this->actors;
    }

    function getGenero() {
        $this->setGenero();

        return $this->genero;
    }

    function getCines() {
        $this->setCines();

        return $this->cines;
    }

    function getHoras() {
        $this->setHoras();

        return $this->horas;
    }

    function getNote() {
        $this->setNote();

        return $this->note;
    }

    function setId_movie($id_movie) {
        $this->id_movie = $id_movie;
    }

    function setTitle_movie($title_movie) {
        $this->title_movie = $title_movie;
    }

    function setPoster_movie($poster_movie) {
        $this->poster_movie = $poster_movie;
    }

    function setSipnosis_movie($sipnosis_movie) {
        $this->sipnosis_movie = $sipnosis_movie;
    }

    function setYear_movie($year_movie) {
        $this->year_movie = $year_movie;
    }

    function setFormat_movie($format_movie) {
        $this->format_movie = $format_movie;
    }

    function setPrice_movie($price_movie) {
        $this->price_movie = $price_movie;
    }

    function setDuration_movie($duration_movie) {
        $this->duration_movie = $duration_movie;
    }

    function setAwards_movie($awards_movie) {
        $this->awards_movie = $awards_movie;
    }

    function setAge_calification($age_calification) {
        $this->age_calification = $age_calification;
    }

    function setTrailer_movie($trailer_movie) {
        $this->trailer_movie = $trailer_movie;
    }

    function setArchive_url($archive_url) {
        $this->archive_url = $archive_url;
    }

    private function setDirector() {
        $functionDB = new FunctionsDB();

        $this->director = $functionDB->getDirectorID($this->id_movie);
    }

    private function setActors() {
        $functionDB = new FunctionsDB();

        $this->actors = $functionDB->getActorsID($this->id_movie);
    }

    function setGenero() {
        $functionDB = new FunctionsDB();

        $this->genero = $functionDB->getGeneroID($this->id_movie);
    }

    function setCines() {
        $functionDB = new FunctionsDB();

        $this->cines = $functionDB->getCinemasOffer($this->id_movie);
    }

    function setHoras() {
        $functionDB = new FunctionsDB();

        $this->horas = $functionDB->getHorasOffer($this->id_movie);
    }

    function setNote() {
        $functionDB = new FunctionsDB();

        $this->note = $functionDB->getGeneralNoteID($this->id_movie);
    }

}
