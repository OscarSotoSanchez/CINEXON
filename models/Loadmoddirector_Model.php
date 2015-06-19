<?php

include_once 'db/FunctionsDB.php';

class Loadmoddirector_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getDirector($id) {
        $director = $this->functionsDB->getOneDirectorID($id);
        return $director;
    }

}
