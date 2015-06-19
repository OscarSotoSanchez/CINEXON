<?php

include_once '../../db/FunctionsDB.php';

if (!empty($_REQUEST["command"]) && !empty($_REQUEST["value"])) {
    $command = $_REQUEST["command"];
    $value = $_REQUEST["value"];
    $functions = new FunctionsDB();

    switch ($command) {
        case "email":
            if ($functions->exitClientByEmail($value)) {
                echo "true";
            } else {
                echo "false";
            }
            break;
        case "nick":
            if ($functions->exitClientByNickName($value)) {
                echo "true";
            } else {
                echo "false";
            }
            break;
        case "list":
            $values = json_decode($value);
            if($functions->exitListClient($values[0], $values[1])){
                echo "true";
            } else {
                echo "false";
            }
            break;
        case "film":
            if($functions->exitFilmByName($value)){
                echo "true";
            } else {
                echo "false";
            }
            break;
    }
} else {
    echo "NOT PARAMETERS";
}

