<?php

include_once '../html/db/FunctionsDB.php';

$functionDB = new FunctionsDB();
$user = $functionDB->getAllUsersAccountNotActivate();

for ($x = 0; $x < count($user); $x++) {
    $id = $user[$x][0];
    $hora = $user[$x][1];

    $horaActivated = strtotime($hora);
    $horaActivated = strtotime('+12 hour', $horaActivated);
    $horaSystem = strtotime(date('H:i'));

    if ($horaSystem > $horaActivated) {
        $functionDB->deleteUser($id);
    }
}
