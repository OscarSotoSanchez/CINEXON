<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/User.php';

if (!empty($_REQUEST['users'])) {
    $functions = new FunctionsDB();
    $users = json_decode(stripslashes($_REQUEST['users']));

    $usersArray = array();
    for ($x = 0; $x < count($users); $x++) {
        array_push($usersArray, $functions->getUserID($users[$x]));
    }
    $usersHTML = array();

    $body = '<div class="col-sm-6 col-lg-4 col-md-6">
                        <div class="thumbnail">
                        <a href="usuario?idUser=id_user">
                            <div class="layoutImage">
                                <img src="views/resource/img/icon-user.png" alt="">
                            </div>
                        <div class="caption">
                            <p css_style><b>nick_user</b></p>
                        </div>
                    </a>
                </div>
            </div>';

    for ($x = 0; $x < count($usersArray); $x++) {
        $idUser = $usersArray[$x]->getId_user();
        $nickUser = $usersArray[$x]->getNick_user();
        $css = "";

        if ($usersArray[$x]->getRole_user() == "moderator") {
            $css = "style='color: #2c3e50;'";
        }

        $html = str_replace("id_user", $idUser, $body);
        $html = str_replace("nick_user", $nickUser, $html);
        $html = str_replace("css_style", $css, $html);
        array_push($usersHTML, $html);
    }

    echo json_encode($usersHTML);
} else {
    echo "NOT PARAMETERS";
}
   