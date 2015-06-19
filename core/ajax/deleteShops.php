<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idUser']) && !empty($_REQUEST['typeShop'])) {
    $idUser = $_REQUEST['idUser'];
    $typeShop = $_REQUEST['typeShop'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();

        if ($user->getId_user() == $idUser || $user->getRole_user() == "admin") {
            switch ($typeShop){
                case "deleteTickets":
                    $functionDB->deleteShopsTickets($idUser);
                    break;
                case "deleteDigital":
                    $functionDB->deleteShopsDigital($idUser);
                    break;
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

