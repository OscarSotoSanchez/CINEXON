<?php

include_once 'db/FunctionsDB.php';

class Loadmodgenero_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getGenero($id) {
        $genero = $this->functionsDB->getOneGeneroID($id);
        return $genero;
    }

}
