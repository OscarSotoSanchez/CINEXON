<div class="barraLateral">

    <h4>Búsqueda</h4>

    <form action="." method="post">
        <div class="list-group">
            <span class="list-group-item" name="listSearchItem">
                <span>Título</span>
                <input name="title" type="text" placeholder="Escribe un Titulo"/>
            </span>
            <span class="list-group-item">
                <span>Género</span>
                <input name="genero" type="text" placeholder="Escribe un Genero"/>
            </span>
            <span class="list-group-item">
                <span>Director</span>
                <input name="director" type="text" placeholder="Escribe un Director"/>
            </span>
        </div>

        <div class="boton">
            <input type="submit" class="btn btn-success btn-sm button" name="searchComplex" value="Buscar"/>
        </div>
    </form>

</div>  

<!-- Portfolio Grid Section -->
<section class="layoutFilm">
    <div>
        <div class="col-lg-12 text-center">
            <h3>Películas</h3>
            <hr class="star-primary">
        </div>
    </div>

    <div class="row" id="layoutFilms">
        <div class="col-md-12" style="margin-bottom: 5%;">
            <ul class="nav nav-tabs nav-justified">
                <li <?php echo $activeAll; ?>><a href="peliculas">Todas</a></li>
                <li <?php echo $activeMostRelared; ?>><a href="peliculas_mejor_valoradas">Mejor Valoradas</a></li>
            </ul>
        </div>
        <?php
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

    <div class="row">
        <div class="moreFilms">                    
            <span class="btn-circle" id="moreFilms">
                <i class="fa fa-fw fa-plus"></i>
            </span>
            <p id="moreFilmsMessage">Cargar mas Películas</p>
        </div>  
</section>

<script>
    idFilms = <?php echo json_encode($idFilms); ?>;
</script>

<!-- loadFilms -->
<script src="views/resource/js/loadFilmsName.js"></script>

