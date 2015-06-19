<?php

include_once 'db/FunctionsDB.php';

class Loadmodcinema_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getCinema($id) {
        $cinema = $this->functionsDB->getCinema($id);
        return $cinema;
    }

}
