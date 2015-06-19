<?php

include_once 'db/FunctionsDB.php';

class Loaduserspag_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getValoration($id) {
        $valorations = $this->functionsDB->getAllValorationsByUser($id);
        return $valorations;
    }

    public function getLists($id) {
        $lists = $this->functionsDB->getListUser($id);
        return $lists;
    }

    public function getMessages($id) {
        $lists = $this->functionsDB->getMessages($id);
        return $lists;
    }

    public function getShops($id) {
        $lists = $this->functionsDB->getAllBuyFilms($id);
        return $lists;
    }

    public function getUser($id) {
        $user = $this->functionsDB->getUserID($id);
        return $user;
    }

}
