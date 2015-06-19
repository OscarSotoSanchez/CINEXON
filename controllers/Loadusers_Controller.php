<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadusers_Model.php';

class Loadusers_Controller extends ControllersBase {

    public function view() {

        ob_start();

        $loadUsers = new Loadusers_Model();
        //$usersArray = $loadUsers->getUsers();
        $idUsers = $loadUsers->getUsersID();
        $numUsers = count($idUsers);
        $usersArray = array();

        $cont = 9;
        if (count($idUsers) < 9) {
            $cont = count($idUsers);
        }

        for ($x = 0; $x < $cont; $x++) {
            array_push($usersArray, $loadUsers->getUser($idUsers[$x]));
        }

        $idUsers = array_splice($idUsers, 9, count($idUsers));

        include 'views/default/modules/loadUsers.php';
        $films = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $films, $page);

        $this->view_page($page);
    }

}
