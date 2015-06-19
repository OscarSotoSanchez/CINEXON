<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/Film.php';
include_once '../class/Offer.php';

if (!empty($_REQUEST['idMovie'])) {
    $id = $_REQUEST['idMovie'];

    $session = new Sessions();

    if ($session->isUserConnected()) {
        $cut = explode(";", $id);

        if (count($cut) > 1) {
            $session->deleteElementShoppingCart($cut[0], $cut[1]);
        } else {
            $session->deleteElementShoppingCart($id);
        }

        $returnArray = array($session->getTotalShoppings(), $session->getTotalPriceShoppings());

        echo json_encode($returnArray);
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
   