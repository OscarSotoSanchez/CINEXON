<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Film.php';


if (!empty($_REQUEST["value"])) {

    $value = $_REQUEST["value"];
    $functions = new FunctionsDB();

    $films = $functions->getAllFilmSearchBarra($value);
    $filmsNames = array();

    for ($x = 0; $x < count($films); $x++) {
        array_push($filmsNames, $films[$x]->getTitle_movie());
    }

    echo json_encode($filmsNames);
}