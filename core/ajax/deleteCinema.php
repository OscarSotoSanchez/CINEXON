<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idCinema'])) {
    $idCinema = $_REQUEST['idCinema'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin") {
            $functionDB->deleteCinema($idCinema);
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

