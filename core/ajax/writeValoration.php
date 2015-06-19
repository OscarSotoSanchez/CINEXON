<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Sessions.php';
include_once '../class/OtherFunctions.php';
include_once '../class/User.php';

if (!empty($_REQUEST['review']) && !empty($_REQUEST['numStarts']) && !empty($_REQUEST['codMovie'])) {
    $review = $_REQUEST['review'];
    $numStarts = $_REQUEST['numStarts'];
    $codMovie = $_REQUEST['codMovie'];

    $session = new Sessions();
    $functionDB = new FunctionsDB();

    if ($session->isUserConnected()) {
        $otherFunc = new OtherFunctions();
        $codUser = $session->getConnectUser()->getId_user();
        $nameUser = $session->getConnectUser()->getNick_user();

        $id = $functionDB->addValorations($codUser, $codMovie, $numStarts, $review);
        $html = '<div class="col-md-12 critica">
            <p><span class="text-left">' . $nameUser . '</span><span style="float: right;">' . date("d-m-Y") . '</span></p>
            <p class="text-center">' . $otherFunc->writeStart($numStarts) . '</p>
            <br/>
            <p>' . $review . '</p>
            <a name="btnDeleteValoration" data-toggle="modal" data-target="#deleteValoration" style="float: right; margin-top: 1%;" id="' . $id . '">Eliminar mi critica</a>
          </div>';

        $startsMovie = $functionDB->getGeneralNoteID($codMovie);

        $arrayReturn = array($html, $startsMovie);
        echo json_encode($arrayReturn);
    } else {
        echo "NOT USER CONNECT";
    }
} else {
    echo "NOT PARAMETERS";
}
?>

