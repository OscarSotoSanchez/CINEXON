<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idActor']) && !empty($_REQUEST['nameActor'])) {
    $idActor = $_REQUEST['idActor'];
    $nameActor = $_REQUEST['nameActor'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin" || $user->getRole_user() == "moderator") {
            $functionDB->refreshActor($idActor, $nameActor);
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

