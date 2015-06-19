<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Message.php';

if (!empty($_REQUEST['idMessage'])) {
    $idMessage = $_REQUEST['idMessage'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $message = $functionDB->getMessage($idMessage);
        $user = $session->getConnectUser();

        if ($user->getId_user() == $message->getId_receiver() || $user->getRole_user() == "admin") {
            $functionDB->deleteMessage($idMessage);
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

