<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/OtherFunctions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idTransmitter']) && !empty($_REQUEST['idReceiver']) && !empty($_REQUEST['message'])) {
    $idTransmitter = $_REQUEST['idTransmitter'];
    $idReceiver = $_REQUEST['idReceiver'];
    $message = $_REQUEST['message'];

    $session = new Sessions();
    $functionDB = new FunctionsDB();

    if ($session->isUserConnected()) {
        $userConnected = $session->getConnectUser();

        if ($userConnected->getId_user() == $idTransmitter) {
            $functionDB->addMessage($idTransmitter, $idReceiver, $message);
        } else {
            echo "NOT USER VALID";
        }
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
?>

