<!-- Header -->
<header>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
            <li data-target="#myCarousel" data-slide-to="5"></li>
            <li data-target="#myCarousel" data-slide-to="6"></li>
            <li data-target="#myCarousel" data-slide-to="7"></li>
            <li data-target="#myCarousel" data-slide-to="8"></li>
            <li data-target="#myCarousel" data-slide-to="9"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
                for ($x = 0; $x < count($moviesArray); $x++) {
                    $active = "active";
                    $titleMovie = $moviesArray[$x]->getTitle_Movie_Cut();
                    $image = $moviesArray[$x]->getPoster_movie();
                    $sipnosis = $moviesArray[$x]->getSipnosis_movie();
                    
                    if($x != 0){
                        $active = "";
                    }

                    echo '  <div class="item '.$active.'">
                                <div class="pelicula">
                                    <div class="layoutImage">
                                        <img src="'.$image.'" alt="First slide" />
                                    </div>    
                                    <h1>'.$titleMovie.'</h1>
                                    <p>'.$sipnosis.'</p>
                                </div>
                            </div>';               
                }
            ?>
        </div>
        <span class="page-scroll">
            <a href="#descubre" class="btn btn-circle">
                <i class="fa fa-angle-double-down animated"></i>
            </a>
        </span>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- /.carousel -->
</header>


<section id="descubre">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Descubre</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 portfolio-item descubre">
                <span id="more" class="glyphicon glyphicon-pencil"></span>
                <p>¿Qué te pareció lo último de Nolan? ¿O eres más de Haneke? Dinos lo que te apasiona, o lo que te provoca ataques de ira</p>
            </div>
            <div class="col-md-12 portfolio-item descubre">
                <span id="more" class="glyphicon glyphicon-search"></span>
                <p>Infinidad de películas que te quedan por ver te esperan en Cinexón. ¡Nunca sabes qué obra maestra está a la vuelta de la esquina!</p>
            </div>
            <div class="col-md-12 portfolio-item descubre">
                <span id="more" class="glyphicon glyphicon-list-alt"></span>
                <p>Para que a mitad de película no digas "¡Ésta ya le he visto!". Apunta tus favoritas, tus recomendadas, las que odias...</p>
            </div>
            <div class="col-md-12 portfolio-item descubre">
                <span id="more" class="glyphicon glyphicon-shopping-cart"></span>
                <p>¡En el cine o en casa! ¡En cartelera o una vieja reliquia! Ver cine jamás fue tan cómodo... ¡y barato!</p>
            </div>
        </div>
    </div>
</section>
