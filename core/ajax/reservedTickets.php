<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/Offer.php';
include_once '../class/Film.php';
include_once '../class/User.php';
include_once '../class/Cinema.php';

if (!empty($_REQUEST['idOffer']) && !empty($_REQUEST['idMovie']) && !empty($_REQUEST['tickets'])) {
    $idOffer = $_REQUEST['idOffer'];
    $codFilm = $_REQUEST['idMovie'];
    $tickets = json_decode(stripslashes($_REQUEST['tickets']));

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $offer = $functionDB->getOfferByID($idOffer);

        $newTickets = $offer->getTickets();
        $cinema = $offer->getId_cinema();
        $hora = $offer->getHora();

        $arraySave = array();
        for ($i = 0; $i < count($tickets); $i++) {
            $cut = explode("f", $tickets[$i]);

            array_push($arraySave, array(intval($cut[0]), intval($cut[1])));
            $newTickets[$cut[0]][$cut[1]] = array(1, intval($session->getConnectUser()->getId_user()), date("H:i"));
        }

        $functionDB->refreshTicketsOffer($idOffer, $newTickets);
        $session->addShoppingCart($codFilm, count($tickets), array($cinema, $arraySave, $hora));
        echo $session->getTotalShoppings();
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
   