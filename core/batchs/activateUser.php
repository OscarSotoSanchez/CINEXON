<?php

include_once '../../db/FunctionsDB.php';

if (!empty($_REQUEST['code'])) {
    $functionsDB = new FunctionsDB();   
    $idUser = $_REQUEST['code'];
    
    if($functionsDB->activateUser($idUser)){
        header('Location: sesionActivada');
    } else {
        echo "ID NOT EXITS IN DATABASE";
    }
} else {
    echo "NOT PARAMETERS";
}
?>

