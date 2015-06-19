<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/Film.php';
include_once '../class/User.php';
include_once '../class/ListUser.php';


if (!empty($_REQUEST['idMovie']) && !empty($_REQUEST['idList'])) {
    $idMovie = $_REQUEST['idMovie'];
    $idList = $_REQUEST['idList'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        $list = $functionDB->getListUserByID($idList);

        if ($user->getId_user() == $list->getId_user() || $user->getRole_user() == "admin") {
            $functionDB->addFilmList($idList, $idMovie);
        } else {
            echo "CURRENT USER IS NOT THE OWNER OF THE LIST";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
   