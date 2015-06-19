<?php

include_once '../../db/FunctionsDB.php';
include_once '../class/Film.php';

if (!empty($_REQUEST['movies'])) {
    $functions = new FunctionsDB();
    $movies = json_decode(stripslashes($_REQUEST['movies']));

    $moviesArray = array();
    for($x=0; $x < count($movies); $x++){
        array_push($moviesArray, $functions->getFilmsID($movies[$x]));
    }
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

    echo json_encode($moviesHTML);
} else {
    echo "NOT PARAMETERS";
}
   