<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Offer.php';

if (!empty($_REQUEST['idOffer']) && !empty($_REQUEST['action'])) {
    $idOffer = $_REQUEST['idOffer'];
    $action = $_REQUEST['action'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();

        if ($user->getRole_user() == "admin") {
            $sala = $functionDB->getOfferByID($idOffer);

            $id = $sala->getId_offer();
            $arrayEntradas = $sala->getTickets();

            for ($x = 0; $x < count($arrayEntradas); $x++) {
                for ($i = 0; $i < count($arrayEntradas[$x]); $i++) {
                    if ($action == "reset") {
                        $arrayEntradas[$x][$i] = array(0, 0);
                    } else {
                        if ($arrayEntradas[$x][$i][0] == 1) {
                            $arrayEntradas[$x][$i] = array(0, 0);
                        }
                    }
                }
            }

            $functionDB->refreshTicketsOffer($id, $arrayEntradas);
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

