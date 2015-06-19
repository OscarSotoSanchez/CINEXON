<?php

class ElementList {

    private $id_storage;
    private $id_list;
    private $id_movie;
    private $name_film;

    function __construct($id_storage, $id_list, $id_movie) {
        $this->id_storage = $id_storage;
        $this->id_list = $id_list;
        $this->id_movie = $id_movie;
    }

    function getId_storage() {
        return $this->id_storage;
    }

    function getId_list() {
        return $this->id_list;
    }

    function getId_movie() {
        return $this->id_movie;
    }

    function getName_film() {
        $this->setName_film();
        
        return $this->name_film;
    }

    function setId_storage($id_storage) {
        $this->id_storage = $id_storage;
    }

    function setId_list($id_list) {
        $this->id_list = $id_list;
    }

    function setId_movie($id_movie) {
        $this->id_movie = $id_movie;
    }

    function setName_film() {
        $functionDB = new FunctionsDB();

        $movie = $functionDB->getFilmsID($this->id_movie);
        $this->name_film = $movie->getTitle_movie();
    }

}
