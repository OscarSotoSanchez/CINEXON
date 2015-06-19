<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';
include_once '../class/Cinema.php';

if (!empty($_REQUEST['nameCinema']) && !empty($_REQUEST['addressCinema'])) {
    $nameCinema = $_REQUEST['nameCinema'];
    $addressCinema = $_REQUEST['addressCinema'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin") {
            $check = $functionDB->getCinemaByName($nameCinema);
            if($check){
                echo "false";
            } else {
               $functionDB->addCinema($nameCinema, $addressCinema);
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

