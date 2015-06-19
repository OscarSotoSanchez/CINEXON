<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idCinema']) && !empty($_REQUEST['nameCinema']) && !empty($_REQUEST['addressCinema'])) {
    $idCinema = $_REQUEST['idCinema'];
    $nameCinema = $_REQUEST['nameCinema'];
    $addressCinema = $_REQUEST['addressCinema'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin" || $user->getRole_user() == "moderator") {
            $functionDB->refreshCinema($idCinema, $nameCinema, $addressCinema);
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

