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
                $arrayEntradas[$x][$i] = array(0, 0);
        }
    }
    
    $functionDB->refreshTicketsOffer($id, $arrayEntradas);
}