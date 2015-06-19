<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Offer.php';

$functionDB = new FunctionsDB();
$session = new Sessions();

if ($session->isUserConnected()) {
    $user = $session->getConnectUser();

    if ($user->getRole_user() == "admin") {
        $taquillaArray = $functionDB->getAllOffers();

        for ($w = 0; $w < count($taquillaArray); $w++) {
            $id = $taquillaArray[$w]->getId_offer();
            $arrayEntradas = $taquillaArray[$w]->getTickets();

            for ($x = 0; $x < count($arrayEntradas); $x++) {
                for ($i = 0; $i < count($arrayEntradas[$x]); $i++) {
                    $arrayEntradas[$x][$i] = array(0, 0);
                }
            }

            $functionDB->refreshTicketsOffer($id, $arrayEntradas);
        }
    } else {
        echo "NOT PERMISSION";
    }
} else {
    echo "NOT USER CONNECT";
}