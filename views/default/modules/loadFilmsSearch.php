<section class="layoutFilmSearch">
    <div>
        <div class="col-lg-12 text-center">
            <h3>Resultados de Búsqueda</h3>
            <hr class="star-primary">
        </div>
    </div>

    <div class="row" id="layoutFilms">
        <?php
        echo '<div class="col-md-12 text-center" style="margin-bottom: 2%;">
                        <p class="text-center">La búsqueda "<b>' . $word . '</b>" dio <b>' . $numResults . '</b> resultados.</p>
                  </div>';

        for ($x = 0; $x < count($moviesArray); $x++) {

            $idMovie = $moviesArray[$x]->getId_movie();
            $titleMovie = $moviesArray[$x]->getTitle_Movie_Cut();
            $image = $moviesArray[$x]->getPoster_movie();

            echo '
                    <div class="col-sm-6 col-lg-4 col-md-6">
                        <div class="thumbnail">
                            <a href="pelicula?id=' . $idMovie . '">
                                <div class="layoutImage">
                                    <img src="' . $image . '" alt="">
                                </div>
                                <div class="caption">
                                    <p><b>' . $titleMovie . '</b></p>
                                </div>
                            </a>
                        </div>
                    </div>';
        }
        ?>
    </div>
    
    <?php
        if($numResults > 9){
            echo '<div class="row">
                    <div class="moreFilms">                    
                        <span class="btn-circle" id="moreFilms">
                            <i class="fa fa-fw fa-plus"></i>
                        </span>
                        <p id="moreFilmsMessage">Cargar mas Películas</p>
                    </div>
                  </div>'; 
        }
    ?>

</section>

<script>
    idFilms = <?php echo json_encode($idFilms); ?>;
</script>

<!-- loadFilms -->
<script src="views/resource/js/loadFilmsName.js"></script>