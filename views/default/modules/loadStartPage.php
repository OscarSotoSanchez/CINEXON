
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Últimas Añadidas</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div id="lastAdd" class="carousel slide" data-interval="3000" data-ride="carousel" style="width: 100%; margin: 0 auto; height: 500px; margin-top:2%; margin-bottom: 5%;">

        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <?php
            for ($x = 0; $x < count($lastAdd); $x++) {
                if ($x == 0) {
                    echo '<li data-target="#cartelera" data-slide-to="0" class="active"></li>';
                } else {
                    echo '<li data-target="#cartelera" data-slide-to="' . $x . '"></li>';
                }
            }
            ?>
        </ol>   

        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php
            for ($x = 0; $x < count($lastAdd); $x++) {
                $active = "active";
                $titleMovie = $lastAdd[$x]->getTitle_Movie_Cut();
                $image = $lastAdd[$x]->getPoster_movie();
                $idMovie = $lastAdd[$x]->getId_movie();

                if ($x != 0) {
                    $active = "";
                }

                echo '  <div class="item ' . $active . '" style="margin-top: 45px !important;">
                            <a style="text-decoration: none;" href="pelicula?id=' . $idMovie . '">
                                <div class="layoutImage">
                                    <img src="' . $image . '"/>
                                </div>
                                <div class="carousel-caption">                                   
                                    <h3>' . $titleMovie . '</h3>
                                </div>
                            </a>    
                        </div>';
            }
            ?>
        </div>

        <!-- Carousel nav -->
        <a class="carousel-control left" href="#lastAdd" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>

        <a class="carousel-control right" href="#lastAdd" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>

<div class="container">        
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Cartelera</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div id="cartelera" class="carousel slide" data-interval="3000" data-ride="carousel" style="width: 100%; margin: 0 auto; height: 500px; margin-top:2%; margin-bottom: 5%;">

        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <?php
            for ($x = 0; $x < count($cartelera); $x++) {
                if ($x == 0) {
                    echo '<li data-target="#cartelera" data-slide-to="0" class="active"></li>';
                } else {
                    echo '<li data-target="#cartelera" data-slide-to="' . $x . '"></li>';
                }
            }
            ?>
        </ol>   

        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php
            for ($x = 0; $x < count($cartelera); $x++) {
                $active = "active";
                $titleMovie = $cartelera[$x]->getTitle_Movie_Cut();
                $image = $cartelera[$x]->getPoster_movie();
                $idMovie = $cartelera[$x]->getId_movie();

                if ($x != 0) {
                    $active = "";
                }

                echo '  <div class="item ' . $active . '" style="margin-top: 45px !important;">
                            <a style="text-decoration: none;" href="pelicula?id=' . $idMovie . '">
                                <div class="layoutImage">
                                    <img src="' . $image . '"/>
                                </div>
                                <div class="carousel-caption" style="margin-top: 5px;">                                   
                                    <h3>' . $titleMovie . '</h3>
                                </div>
                            </a>    
                        </div>';
            }
            ?>
        </div>

        <!-- Carousel nav -->
        <a class="carousel-control left" href="#cartelera" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>

        <a class="carousel-control right" href="#cartelera" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>