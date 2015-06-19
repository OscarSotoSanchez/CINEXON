<?php

class Cinema {
    private $id_cinema;
    private $address_cinema;
    private $name_cinema;
    
    function __construct($id_cinema, $address_cinema, $name_cinema) {
        $this->id_cinema = $id_cinema;
        $this->address_cinema = $address_cinema;
        $this->name_cinema = $name_cinema;
    }

    function getId_cinema() {
        return $this->id_cinema;
    }

    function getAddress_cinema() {
        return $this->address_cinema;
    }

    function getName_cinema() {
        return $this->name_cinema;
    }

    function setId_cinema($id_cinema) {
        $this->id_cinema = $id_cinema;
    }

    function setAddress_cinema($address_cinema) {
        $this->address_cinema = $address_cinema;
    }

    function setName_cinema($name_cinema) {
        $this->name_cinema = $name_cinema;
    }
}
