<?php

include_once '../public_html/db/FunctionsDB.php';
include_once '../public_html/core/class/Offer.php';

$functionDB = new FunctionsDB();
$taquillaArray = $functionDB->getAllOffers();

for ($w = 0; $w < count($taquillaArray); $w++) {
    $id = $taquillaArray[$w]->getId_offer();
    $arrayEntradas = $taquillaArray[$w]->getTickets();

    for ($x = 0; $x < count($arrayEntradas); $x++) {
        for ($i = 0; $i < count($arrayEntradas[$x]); $i++) {
            if ($arrayEntradas[$x][$i][0] == 1) {
                $horaReserved = strtotime($arrayEntradas[$x][$i][2]);
                $horaReserved = strtotime('+15 minute', $horaReserved);
                $horaSystem = strtotime(date('H:i'));

                if ($horaSystem > $horaReserved) {
                    $arrayEntradas[$x][$i] = array(0, 0);
                }
            }
        }
    }

    $functionDB->refreshTicketsOffer($id, $arrayEntradas);
}
