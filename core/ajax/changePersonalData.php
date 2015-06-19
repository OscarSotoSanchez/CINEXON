<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Exceptions.php';

if (!empty($_REQUEST['idUser']) && !empty($_REQUEST['role']) && !empty($_REQUEST['name']) && !empty($_REQUEST['pass']) && !empty($_REQUEST['age'])) {
    $id = $_REQUEST['idUser'];
    $role = $_REQUEST['role'];
    $name = $_REQUEST['name'];
    $pass = $_REQUEST['pass'];
    $age = $_REQUEST['age'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $userConnected = $session->getConnectUser();

        if ($userConnected->getId_user() == $id || $userConnected->getRole_user() == "admin") {

            if ($role == "NOT ADMIN") {
                $role = $userConnected->getRole_user();
            }

            if ($userConnected->getPass_user() != $pass) {
                $pass = sha1($pass);
            }

            $functionDB->refreshUser($id, $role, $name, $pass, $age);
        } else {
            echo "NOT USER PERMISSION";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
   