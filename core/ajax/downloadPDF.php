<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Film.php';
include_once '../class/Buy.php';
include_once '../class/Offer.php';
include_once '../class/Cinema.php';
include_once '../fpdf/PDF.php';

if (!empty($_REQUEST['idBuy'])) {
    $id = $_REQUEST['idBuy'];

    $functionDB = new FunctionsDB();

    $buy = $functionDB->getBuyTickets($id);

    if (!empty($buy)) {
        $cinema = $functionDB->getCinema($buy->getId_Cinema());
        $movie = $functionDB->getFilmsID($buy->getId_movie());
        $entradas = $buy->getTickets_buy();

        $dateBuy = explode("-", $buy->getDate_buy());
        $date = explode("-", date("d-m-Y"));

        if ($dateBuy[0] == $date[0] && $dateBuy[1] == $date[1] && $dateBuy[2] == $date[2]) {
            $pdf = new PDF();

            $pdf->downloadPDF($movie->getTitle_movie(), $cinema->getName_cinema(), $cinema->getAddress_cinema(), $entradas, $buy->getHora());
        }
    } else {
        echo "NOT PERMISSIONS";
    }
} else {
    echo "NOT PARAMETERS";
}

