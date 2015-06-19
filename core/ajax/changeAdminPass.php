<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Exceptions.php';

if (!empty($_REQUEST['idUser']) && !empty($_REQUEST['pass'])) {
    $id = $_REQUEST['idUser'];
    $pass = $_REQUEST['pass'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $userConnected = $session->getConnectUser();

        if ($userConnected->getRole_user() == "admin") {

            if ($userConnected->getPass_user() != $pass) {
                $pass = sha1($pass);
            }

            $functionDB->refreshUserPassword($id, $pass);
        } else {
            echo "NOT USER PERMISSION";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
   