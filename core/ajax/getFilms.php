<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Film.php';

if (!empty($_REQUEST['idMovie'])) {
    $functions = new FunctionsDB();
    $numMovies = $functions->getNumTotalFilms();

    $rangStart = $_REQUEST['idMovie'];
    $rangFinish = $_REQUEST['idMovie'] + 8;

    $moviesArray = $functions->getFilmsRange($rangStart, $rangFinish);
    $returnArray = array();
    $moviesHTML = array();

    $body = '<div class="col-sm-6 col-lg-4 col-md-6">
                    <div class="thumbnail">
                        <a href="pelicula?id=id_film">
                            <div class="layoutImage">
                                <img src="image_film" alt="">
                            </div>
                            <div class="caption">
                                <p><b>title_film</b></p>
                            </div>
                        </a>
                    </div>
                </div>';

    for ($x = 0; $x < count($moviesArray); $x++) {
        $id = $moviesArray[$x]->getId_movie(); 
        $titleMovie = $moviesArray[$x]->getTitle_Movie_Cut();
        $image = $moviesArray[$x]->getPoster_movie();

        $html = str_replace("title_film", $titleMovie, $body);
        $html = str_replace("image_film", $image, $html);
        $html = str_replace("id_film", $id, $html);
        array_push($moviesHTML, $html);
    }

    array_push($returnArray, $moviesHTML);
    if ($rangFinish > $numMovies) {
        array_push($returnArray, 0);
    } else {
        array_push($returnArray, $rangFinish + 1);
    }
    echo json_encode($returnArray);
} else {
    echo "NOT PARAMETERS";
}
   