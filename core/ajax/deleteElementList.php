<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/ElementList.php';
include_once '../class/ListUser.php';

if (!empty($_REQUEST['idElementList'])) {
    $idElementList = $_REQUEST['idElementList'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $elemetList = $functionDB->getElementList($idElementList);
        $list = $functionDB->getListUserByID($elemetList->getId_list());
        $user = $session->getConnectUser();

        if ($user->getId_user() == $list->getId_user() || $user->getRole_user() == "admin") {
             $functionDB->deleteElementList($idElementList);
        } else {
            echo "CURRENT USER IS NOT THE OWNER OF THE LIST";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
?>

