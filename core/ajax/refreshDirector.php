<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idDirector']) && !empty($_REQUEST['nameDirector'])) {
    $idDirector = $_REQUEST['idDirector'];
    $nameDirector = $_REQUEST['nameDirector'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin" || $user->getRole_user() == "moderator") {
            $functionDB->refreshDirector($idDirector, $nameDirector);
        } else {
            echo "NOT PERMISSION";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
?>

