<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['idGenero']) && !empty($_REQUEST['nameGenero'])) {
    $idGenero = $_REQUEST['idGenero'];
    $nameGenero = $_REQUEST['nameGenero'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin" || $user->getRole_user() == "moderator") {
            $functionDB->refreshGenero($idGenero, $nameGenero);
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

