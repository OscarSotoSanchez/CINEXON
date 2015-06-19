<?php

include_once 'db/FunctionsDB.php';

class Loadmodactor_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getActor($id) {
        $actor = $this->functionsDB->getOneActorID($id);
        return $actor;
    }

}
