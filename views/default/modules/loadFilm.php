<section class="film">
    <div class="row">
        <div class="col-sm-12 col-lg-4 col-md-4 image">
            <img name="imageShop" class="img-responsive" src="<?php echo $film->getPoster_movie() ?>" alt="">
            <div class="text-center" style="margin-bottom: 2%;">
                <?php
                if ($roleUser == "admin" || $roleUser == "moderator") {
                    echo '<form action="." method="post">
                            <input name="idMovie" type="hidden" value="' . $id . '"/>
                            <input name="modFilm" class="btn btn-xs btn-primary" type="submit" value="Modificar Película" />
                          </form>';
                }
                ?>
            </div>
        </div>

        <div name="messageShop" class="col-sm-12 col-lg-3 col-md-3 shop">
            <?php
            if ($roleUser == "admin") {
                echo '<p class="text-muted">El administrador no puede comprar.</p>';
            } else {
                if ($film->getFormat_movie() == "Digital") {
                    if ($buy) {
                        echo '<p class="text-muted">Película comprada, <a name="downloadFILM" id="' . $id . '" href="#">Descargar</a></p>';
                    } else {
                        if ($buttonShop) {
                            echo '<a href="#" name="addShoppingDigitalCart"><i class="fa fa-shopping-cart fa-lg"> Añadir al carrito</i></a>';
                        } else {
                            echo '<p class="text-muted">Película en el carrito</p>';
                        }
                    }
                } else {
                    echo '<a href="#" data-toggle="modal" data-target="#addShoppingCartTaquilla"><i class="fa fa-shopping-cart fa-lg"> Añadir al carrito</i></a>';
                }
            }
            ?>
        </div>

        <div class="col-sm-12 col-lg-6 col-md-6">
            <h3><?php echo $film->getTitle_movie(); ?></h3>
            <ul>
                <li>
                    <p><b>Director:</b>                         
                        <?php
                        $director = $film->getDirector();

                        for ($x = 0; $x < count($director); $x++) {
                            if ($x == 0) {
                                echo $director[$x][1];
                            } else {
                                echo ", " . $director[$x][1];
                            }
                        }
                        ?>
                    </p>
                </li>
                <li>
                    <p><b>Género:</b>
                        <?php
                        $genero = $film->getGenero();

                        for ($x = 0; $x < count($genero); $x++) {
                            if ($x == 0) {
                                echo $genero[$x][1];
                            } else {
                                echo ", " . $genero[$x][1];
                            }
                        }
                        ?>
                    </p>
                </li>
                <li>
                    <p><b>Año:</b> <?php echo $film->getYear_movie(); ?></p>
                </li>
                <li>
                    <p><b>Duración:</b> <?php echo $film->getDuration_movie(); ?> Mins</p>
                </li>
                <li>
                    <p><b>Formato:</b> <?php echo $film->getFormat_movie(); ?></p>
                </li>
                <li>
                    <p><b>Recomendada Para:</b> <?php echo $film->getAge_calification(); ?></p>
                </li>
                <li>
                    <p><b>Premios:</b> <?php echo $film->getAwards_movie(); ?></p>
                </li>
                <li>
                    <p class="text-center" name="startsMovie">
                        <?php
                        if ($roleUser != "admin") {
                            if ($film->getNote() > 0) {
                                echo $otherFunc->writeStart($film->getNote());
                                echo " Nota General";
                            } else {
                                echo "Esta película no tiene valoraciones.";
                            }
                        }
                        ?>                           
                    </p>
                </li>
                <li>
                    <p class="text-center" name="startsUser">
                        <?php
                        if ($roleUser == "admin") {
                            echo "<span class='text-muted'>El administrador no puede tener listas, ni puntuar películas.</span>";
                        } else {
                            if ($valorationUser > 0) {
                                echo $otherFunc->writeStart($valorationUser);
                                echo " Mi nota";
                            } else {
                                echo "No has valorado esta película.";
                            }
                        }
                        ?>                           
                    </p>
                </li>

            </ul>
            <?php
            if ($roleUser != "admin") {
                if (count($lists) > 0) {
                    echo '<div class="button" name="divAddList">
                            <select name="codList" class="form-control">';

                    for ($x = 0; $x < count($lists); $x++) {
                        if ($x == 0) {
                            echo '<option value="' . $lists[$x]->getId_list() . '" selected>' . $lists[$x]->getName_list() . '</option>';
                        } else {
                            echo '<option value="' . $lists[$x]->getId_list() . '">' . $lists[$x]->getName_list() . '</option>';
                        }
                    }

                    echo '  </select>
                            <button name="addList" class="btn btn-primary btn-sm">Añadir a mis Listas</button>
                          </div>';
                } else {
                    echo '<div class="button" name="divAddList">
                            <p class="text-center text-muted">No tienes listas disponibles.</p>
                          </div>';
                }
            }
            ?>
        </div>
    </div>

    <div class="pestannas" id="tabs" data-tabs="tabs">
        <a href="#detalles" data-toggle="tab">
            <div class="pestanna active" name="pestanna">
                <h3>Detalles</h3>
            </div>
        </a>
        <a href="#relacionadas" data-toggle="tab">
            <div class="pestanna" name="pestanna">                 
                <h3>Relacionadas</h3>
            </div>
        </a>
        <a href="#criticas" data-toggle="tab">
            <div class="pestanna" name="pestanna" data-toggle="tab">
                <h3>Críticas</h3>
            </div>
        </a>
    </div>
</section>

<section class="filmSecctions">
    <div class="row tab-content" id="my-tab-content">
        <div class="tab-pane active fade in" id="detalles">
            <div class="col-sm-5 col-lg-5 col-md-5">
                <p><b>Sinopsis</b></p>
                <p><?php echo $film->getSipnosis_movie(); ?></p>
                <br/>
                <p><b>Reparto</b></p>
                <ul>
                    <?php
                    $actors = $film->getActors();

                    for ($x = 0; $x < count($actors); $x++) {
                        echo "<li>" . $actors[$x][1] . "</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-sm-7 col-lg-7 col-md-7">
                <iframe width="100%" height="300px" src="https://www.youtube.com/embed/<?php echo $film->getTrailer_movie_Youtube() ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="tab-pane fade" id="relacionadas">
            <div class="row">
                <?php
                for ($x = 0; $x < count($moviesArray); $x++) {

                    $idMovie = $moviesArray[$x]->getId_movie();
                    $titleMovie = $moviesArray[$x]->getTitle_Movie_Cut();
                    $image = $moviesArray[$x]->getPoster_movie();

                    echo '
                                <div class="col-sm-6 col-lg-4 col-md-6">
                                    <div class="thumbnail">
                                        <a href="pelicula?id=' . $idMovie . '">
                                            <div class="layoutImageMin">
                                                <img src="' . $image . '" alt="">
                                            </div>
                                            <div class="caption">
                                            <p><b>' . $titleMovie . '</b></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                }

                if (count($moviesArray) <= 0) {
                    echo '<div class="col-md-12" id="vacio">
                                <p class="text-center">No hay más películas de este tipo.</p>
                          </div>';
                }
                ?>
            </div> 
        </div>
        <div class="tab-pane fade" id="criticas" style="padding: 4%;">
            <div class="text-right critica" style="padding-top: 0% !important;">
                <?php
                if ($roleUser != "admin") {
                    if ($valorationUser > 0) {
                        echo '<a name="btnAddValoration" class="btn btn-primary disabled" data-toggle="modal" data-target="#addValoration">No puedes dejar mas críticas</a>';
                    } else {
                        echo '<a name="btnAddValoration" class="btn btn-primary" data-toggle="modal" data-target="#addValoration">Dejar una crítica</a>';
                    }
                }
                ?>              
            </div>

            <div class="row" id="valorations">          
                <?php
                for ($x = 0; $x < count($valorationArray); $x++) {
                    echo '<div class="col-md-12 critica">
                                                <p><span class="text-left">' . $valorationArray[$x]->getName_user() . '</span><span style="float: right;">' . $valorationArray[$x]->getDate_valoration() . '</span></p>
                                                <p class="text-center">' . $otherFunc->writeStart($valorationArray[$x]->getValoration()) . '</p>
                                                <br/>
                                                <p>' . $valorationArray[$x]->getReview() . '</p>';

                    if ($valorationArray[$x]->getId_user() == $session->getConnectUser()->getId_user()) {
                        echo '<a name="btnDeleteValoration" data-toggle="modal" data-target="#deleteValoration" style="float: right; margin-top: 1%;" id="' . $valorationArray[$x]->getId_valoration() . '">Eliminar mi crítica</a>';
                    } else if ($roleUser == "moderator" || $roleUser == "admin") {
                        echo '<a name="btnDeleteValoration" data-toggle="modal" data-target="#deleteValoration" style="float: right; margin-top: 1%;" id="' . $valorationArray[$x]->getId_valoration() . '">Eliminar crítica</a>';
                    }

                    echo '</div>';
                }

                if (count($valorationArray) <= 0) {
                    echo '<div class="col-md-12 critica" id="vacio">
                                <p class="text-center">Esta película todavia no tiene ninguna crítica.</p>
                          </div>';
                }
                ?>
            </div>
        </div>    
</section>

<!-- /.container -->
<div class="modal fade" id="addValoration">
    <div class="modal-dialog addValoration">
        <div class="modal-content">
            <div class="modal-header">
                <button name="cancelReview" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Dejar Una Critica</h4>
            </div>
            <div class="modal-body">
                <textarea name="review" maxlength="250"></textarea>
                <?php
                echo '<input type="hidden" name="codMovie" value="' . $id . '"/>';
                ?>
                <div name="starts" class="text-center starts">
                    <span name="start" id='1' class="glyphicon glyphicon-star"></span><span name="start" id='2' class="glyphicon glyphicon-star-empty"></span><span name="start" id='3' class="glyphicon glyphicon-star-empty"></span><span name="start" id='4' class="glyphicon glyphicon-star-empty"></span><span name="start" id='5' class="glyphicon glyphicon-star-empty"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button name="cancelReview" type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button name="publishReview" type="button" class="btn btn-primary disabled">Publicar Comentario</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Eliminar-->
<div class="modal fade" id="deleteValoration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Eliminar Valoración</h4>
            </div>
            <div class="modal-body">
                ¿Esta seguro de que quiere eliminar la valoración?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" name="btnYes">Sí</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addShoppingCartTaquilla" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="gridSystemModalLabel">Comprar Entradas</h4>
            </div>
            <div class="modal-body">
                <?php
                if (count($taquillaArray) > 0) {
                    for ($w = 0; $w < count($taquillaArray); $w++) {
                        $visibility = "none";
                        if ($w == 0) {
                            $visibility = "block";
                            $codOffer = $taquillaArray[$w]->getId_offer();
                        }
                        echo '<div name="cinemas" class="table-responsive" style="display: ' . $visibility . ';" id="cinema' . $taquillaArray[$w]->getId_offer() . '">';
                        echo '<table class="table table-condensed ticket">';
                        $arrayEntradas = $taquillaArray[$w]->getTickets();

                        for ($x = 0; $x < count($arrayEntradas); $x++) {
                            echo '<tr>';
                            for ($i = 0; $i < count($arrayEntradas[$x]); $i++) {
                                $color = "free";
                                if ($arrayEntradas[$x][$i][0] == 2) {
                                    $color = "shop";
                                } else if ($arrayEntradas[$x][$i][0] == 1) {
                                    $color = "reserved";
                                }

                                echo '<td style="padding: 2px;" name="selectTicket" id="' . $x . 'f' . $i . '"><a class="' . $color . '"><img style="width: 45px;" src="views/resource/img/chair.png"/></a></td>';
                            }
                            echo '</tr>';
                        }
                        echo '</table>';
                        echo '</div>';
                    }

                    echo '<select name="selectCinema" class="form-control">';
                    for ($x = 0; $x < count($taquillaArray); $x++) {
                        echo '<option value="cinema' . $taquillaArray[$x]->getId_offer() . '">' . $taquillaArray[$x]->getCinema()->getName_cinema() . ' - Hora: ' . $taquillaArray[$x]->getHora() . '</option>';
                    }
                    echo '</select>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <div style="width: 100%; margin: 0 auto;">
                    <div class="input-group number-spinner" style="width: 100%;">
                        <h4 class="text-center" style="margin-bottom: 5%;">Entradas</h4>
                        <div name="ticketsShops">
                            <p class="text-center">Pendiente de añadir.</p>
                        </div>
                    </div>
                </div>
                <div class="btnComprarEntradas"> 
                    <?php
                    if ($film->getFormat_movie() != "Digital") {
                        echo '<button type="button" id="' . $codOffer . '" name="addShoppingCart" class="btn btn-primary disabled">Añadir al carrito</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo '<input name="idMovie" type="hidden" value="' . $id . '"/>';
?>

<!-- loadFilms -->
<script src="views/resource/js/film.tabs.js"></script>

<!-- publishValoration -->
<script src="views/resource/js/film.publishValoration.js"></script>

<!-- deleteValoration -->
<script src="views/resource/js/film.deleteValoration.js"></script>

<!-- addList -->
<script src="views/resource/js/film.addList.js"></script>

<!-- addShopping -->
<script src="views/resource/js/film.addShoppingCart.js"></script>

<!-- numberSpinner -->
<script src="views/resource/js/film.numberSpinner.js"></script>

<!-- downloadFilm -->
<script src="views/resource/js/downloadFilm.js"></script>

<!-- Messages -->
<script src="views/resource/js/messages.js"></script>