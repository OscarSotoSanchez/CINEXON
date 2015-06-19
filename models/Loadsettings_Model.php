<?php

include_once 'db/FunctionsDB.php';

class Loadsettings_Model {
    private $functionsDB;
    
    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }
    
    public function getValoration($id) {
        $valorations = $this->functionsDB->getAllValorationsByUser($id);
        return $valorations;
    }
}
