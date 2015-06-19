<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Valorations.php';

if (!empty($_REQUEST['idValoration'])) {
    $idValoration = $_REQUEST['idValoration'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $valoration = $functionDB->getValorationID($idValoration);
        $user = $session->getConnectUser();

        if ($user->getId_user() == $valoration->getId_user() || $user->getRole_user() == "admin" || $user->getRole_user() == "moderator") {
            $functionDB->deleteValoration($idValoration);

            echo $functionDB->getGeneralNoteID($valoration->getId_movie());
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

