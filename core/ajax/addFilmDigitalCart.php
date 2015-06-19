<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/Film.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idMovie'])) {
    $id = $_REQUEST['idMovie'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        if ($session->getConnectUser()->getRole_user() == "admin") {
            echo "USER ADMIN NOT PERMISSION SHOP";
        } else {
            $session->addShoppingCart($id, 1);
            echo $session->getTotalShoppings();
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
   