<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['nameDirector'])) {
    $nameDirector = $_REQUEST['nameDirector'];

    $functionDB = new FunctionsDB();
    $session = new Sessions();

    if ($session->isUserConnected()) {
        $user = $session->getConnectUser();
        
        if ($user->getRole_user() == "admin") {  
            $check = $functionDB->getDirectorByName($nameDirector);
            
            if($check){
                echo "false";
            } else {
                $functionDB->addDirector($nameDirector);
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

