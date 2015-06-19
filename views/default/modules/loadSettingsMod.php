
<section class="menuSettings">
    <div class="list-group">
        <div class="list-group-item active text-center">
            <span>Opciones</span>
        </div>
        <div class="list-group-item">
            <span>Películas</span>
            <ul>
                <li href="#modPelicula" data-toggle="tab"><a>Modificar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Géneros</span>
            <ul>
                <li href="#modGenero" data-toggle="tab"><a>Modificar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Directores</span>
            <ul>
                <li href="#modDirector" data-toggle="tab"><a>Modificar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Actores</span>
            <ul>
                <li href="#modActor" data-toggle="tab"><a>Modificar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Cines</span>
            <ul>
                <li href="#verSalas" data-toggle="tab"><a>Ver Salas</a></li>
                <li href="#modCine" data-toggle="tab"><a>Modificar</a></li>
            </ul>
        </div>
    </div>
</section>

<div class="dataSettings">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="modPelicula">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Modificar Película</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <form method="post" action=".">
                        <select name="idMovie" class="form-control">
                            <?php
                            for ($x = 0; $x < count($films); $x++) {
                                $selected = "";
                                if ($x == 0) {
                                    $selected = "selected";
                                }
                                echo "<option value='" . $films[$x]->getId_movie() . "' $selected>" . $films[$x]->getTitle_movie() . "</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="modFilm" style="margin-top: 5%;" class="btn btn-primary" value="Seleccionar" />
                    </form>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="modDirector">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Modificar Director</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <form method="post" action=".">
                        <select name="idDirector" class="form-control">
                            <?php
                            for ($x = 0; $x < count($directors); $x++) {
                                $selected = "";
                                if ($x == 0) {
                                    $selected = "selected";
                                }
                                echo "<option value='" . $directors[$x][0] . "' $selected>" . $directors[$x][1] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="modDirector" style="margin-top: 5%;" class="btn btn-primary" value="Seleccionar" />
                    </form>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="modActor">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Modificar Actor</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <form method="post" action=".">
                        <select name="idActor" class="form-control">
                            <?php
                            for ($x = 0; $x < count($actors); $x++) {
                                $selected = "";
                                if ($x == 0) {
                                    $selected = "selected";
                                }
                                echo "<option value='" . $actors[$x][0] . "' $selected>" . $actors[$x][1] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="modActor" style="margin-top: 5%;" class="btn btn-primary" value="Seleccionar" />
                    </form>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="modCine">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Modificar Cine</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <form method="post" action=".">
                        <select name="idCinema" class="form-control">
                            <?php
                            for ($x = 0; $x < count($cinemas); $x++) {
                                $selected = "";
                                if ($x == 0) {
                                    $selected = "selected";
                                }
                                echo "<option value='" . $cinemas[$x]->getId_cinema() . "' $selected>" . $cinemas[$x]->getName_cinema() . "</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="modCinema" style="margin-top: 5%;" class="btn btn-primary" value="Seleccionar" />
                    </form>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="modGenero">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Modificar Género</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <form method="post" action=".">
                        <select name="idGenero" class="form-control">
                            <?php
                            for ($x = 0; $x < count($generos); $x++) {
                                $selected = "";
                                if ($x == 0) {
                                    $selected = "selected";
                                }
                                echo "<option value='" . $generos[$x][0] . "' $selected>" . $generos[$x][1] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="modGenero" style="margin-top: 5%;" class="btn btn-primary" value="Seleccionar" />
                    </form>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="verSalas">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Salas Cine</h3>
                    <hr class="star-primary">
                </div>
                <div class="col-lg-12 text-center">
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
                            echo '<option value="cinema' . $taquillaArray[$x]->getId_offer() . '">' . $taquillaArray[$x]->getMovie() . ' - ' . $taquillaArray[$x]->getCinema()->getName_cinema() . ' - Hora: ' . $taquillaArray[$x]->getHora() . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Messages -->
<script src="views/resource/js/messages.js"></script>

<script src="views/resource/js/settingsAdmin.clearTickets.js"></script>

<!-- modFilm -->
<script src="views/resource/js/settingsAdmin.modFilm.js"></script>


