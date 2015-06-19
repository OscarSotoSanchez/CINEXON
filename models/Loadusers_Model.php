<?php

include_once 'db/FunctionsDB.php';

class Loadusers_Model {

    private $functionsDB;

    public function __construct() {
        $this->functionsDB = new FunctionsDB();
    }

    public function getUsers() {
        $arrayUsers = $this->functionsDB->getAllUsers();
        return $arrayUsers;
    }

    public function getUser($id) {
        $users = $this->functionsDB->getUserID($id);
        return $users;
    }

    public function getUsersID() {
        $arrayUsers = $this->functionsDB->getAllUsersID();
        return $arrayUsers;
    }

}
