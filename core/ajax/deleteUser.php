<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idUser'])) {
    $idUser = $_REQUEST['idUser'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();

        if ($user->getId_user() == $idUser || $user->getRole_user() == "admin") {
            $functionDB->deleteUser($idUser);

            if ($user->getRole_user() != "admin") {
                $session->disconnectUser();
            }
        } else {
            echo "NOT VALID USER";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
?>

