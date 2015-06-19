<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';


if (!empty($_REQUEST['idUser']) && !empty($_REQUEST['nameList'])) {
    $idUser = $_REQUEST['idUser'];
    $nameList = $_REQUEST['nameList'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {

        $user = $session->getConnectUser();
        
        if ($user->getId_user() == $idUser || $user->getRole_user() == "admin") {
            echo $functionDB->addList($idUser, $nameList);
        } else {
            echo "USER CONNECT LIKE NOT ID USER LIST";
        }
        
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
    