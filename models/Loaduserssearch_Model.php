<?php

include_once 'db/FunctionsDB.php';

class Loaduserssearch_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getUsers($word) {
        $arrayUsers = $this->functionsDB->getAllUsersSearch($word);
        return $arrayUsers;
    }

    public function getUser($id) {
        $users = $this->functionsDB->getUserID($id);
        return $users;
    }

}
