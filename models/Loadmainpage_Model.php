<?php

include_once 'db/FunctionsDB.php';

class Loadmainpage_Model {
    private $functionsDB;
    
    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }
    
    public function getFilmsFinish($num){
        $arrayFilms = $this->functionsDB->getFinish($num);
        return $arrayFilms;
    }
}
