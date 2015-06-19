<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['nameGenero'])) {
    $nameGenero = $_REQUEST['nameGenero'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin") {
            $check = $functionDB->getGeneroByName($nameGenero);
            if($check){
                echo "false";
            } else {
               $functionDB->addGenero($nameGenero);
               echo "true";
            }           
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

