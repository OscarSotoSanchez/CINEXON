
<section class="menuSettings">
    <div class="list-group">
        <div class="list-group-item active text-center">
            <span>Opciones</span>
        </div>
        <div class="list-group-item">
            <span>Películas</span>
            <ul>
                <li href="#insertarPelicula" data-toggle="tab"><a>Insertar</a></li>
                <li href="#modPelicula" data-toggle="tab"><a>Modificar</a></li>
                <li href="#eliminarPelicula" data-toggle="tab"><a>Eliminar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Géneros</span>
            <ul>
                <li href="#insertarGenero" data-toggle="tab"><a>Insertar</a></li>
                <li href="#modGenero" data-toggle="tab"><a>Modificar</a></li>
                <li href="#eliminarGenero" data-toggle="tab"><a>Eliminar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Directores</span>
            <ul>
                <li href="#insertarDirector" data-toggle="tab"><a>Insertar</a></li>
                <li href="#modDirector" data-toggle="tab"><a>Modificar</a></li>
                <li href="#eliminarDirector" data-toggle="tab"><a>Eliminar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Actores</span>
            <ul>
                <li href="#insertarActor" data-toggle="tab"><a>Insertar</a></li>
                <li href="#modActor" data-toggle="tab"><a>Modificar</a></li>
                <li href="#eliminarActor" data-toggle="tab"><a>Eliminar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Cines</span>
            <ul>
                <li href="#verSalas" data-toggle="tab"><a>Ver Salas</a></li>
                <li href="#insertarCine" data-toggle="tab"><a>Insertar</a></li>
                <li href="#modCine" data-toggle="tab"><a>Modificar</a></li>
                <li href="#eliminarCine" data-toggle="tab"><a>Eliminar</a></li>
            </ul>
        </div>
        <div class="list-group-item">
            <span>Entradas</span>
            <ul>
                <li name="deleteReservedTickets"><a>Reiniciar Reservadas</a></li>
                <li name="cleanTickets"><a>Limpiar Todas</a></li>
            </ul>
        </div>
    </div>
</section>

<div class="dataSettings">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="insertarPelicula">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Insertar Película</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-md-11" style="width: 85%; margin: 0 auto;">
                    <form class="form-horizontal" action="." method="post" enctype="multipart/form-data"> 
                        <div class="form-group">
                            <label class="control-label col-xs-3">Portada</label>
                            <div class="col-xs-9">
                                <input type='file' name='insertFilmImage' style="margin: 0 auto;" required>
                            </div>                   
                        </div>
                        <div class="form-group" name="cuadroName">
                            <label class="control-label col-xs-3">Nombre:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertFilmName" placeholder="Nombre Película" required>
                                <div class="text-center">
                                    <label class="control-label" name="messageName" style="display:none; margin-bottom: 10px;"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Sipnopsis:</label>
                            <div class="col-xs-9">
                                <textarea maxlength="500" rows="5" class="form-control" name="insertFilmSipnosis" placeholder="Sinopsis Película"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Género:</label>
                            <div class="col-xs-9">
                                <select name="insertFilmGeneros[]" class="form-control" multiple required>
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
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Año:</label>
                            <div class="col-xs-9">
                                <input type="number" min="1910" max="9999" class="form-control" name="insertFilmYear" placeholder="1990" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Duración:</label>
                            <div class="col-xs-9">
                                <input type="number" min="0" max="999" class="form-control" name="insertFilmDuration" placeholder="60" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Premios:</label>
                            <div class="col-xs-9">
                                <input type="number" min="0" class="form-control" name="insertFilmAdwards" placeholder="0" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Calificación Edad:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertFilmAge" placeholder="Dejar vacio para todos los públicos">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Trailer:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertFilmTrailer" placeholder="Enlace Youtube" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Directores:</label>
                            <div class="col-xs-9">
                                <select name="insertFilmDirector[]" class="form-control" multiple required>
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
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Actores:</label>
                            <div class="col-xs-9">
                                <select name="insertFilmActors[]" class="form-control" multiple required>
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
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Formato:</label>
                            <div class="col-xs-9">
                                <select name="insertFilmFormat" class="form-control">
                                    <option value="Digital" selected>Digital</option>
                                    <option value="Taquilla">Taquilla</option>                      
                                </select>
                                <div name="divDigital" style="margin-top: 4%; display: block;">
                                    <label class="control-label col-xs-3">Video:</label>
                                    <div class="col-xs-9">
                                        <label class="help-block"><i class="help-block">Selecciona una película</i></label>

                                        <input type="file" name="insertFilmVideo" required>
                                    </div>
                                </div>
                                <div name="divTaquilla" class="form-group" style="margin-top: 4%; display: none;">                          
                                    <div class="col-xs-12">
                                        <div style="overflow: hidden;">
                                            <div style="width: 40%; float:left;">
                                                <p class="text-center"><b>Cines</b></p>
                                                <select name="insertFilmCines[]" class="form-control" multiple style="overflow: auto;">
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
                                            </div>
                                            <div style="width: 40%; float:right;">
                                                <p class="text-center"><b>Horas</b></p>
                                                <select name="insertFilmHoras[]" class="form-control" multiple>
                                                    <?php
                                                    for ($x = 13; $x <= 23; $x++) {
                                                        $hora = $x . ":00";
                                                        $horayMedia = $x . ":30";

                                                        echo "<option value='$hora' " . $horaSelected . ">$hora</option>";
                                                        echo "<option value='$horayMedia'" . $horaMediaSelected . ">$horayMedia</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>  
                                        </div>
                                        <div style="width: 50%; margin: 0 auto; margin-top: 5%;">
                                            <p class="text-center"><b>Número Entradas</b></p>
                                            <input type="number" class="form-control" name="insertFilmNumTickets" min="1" value="20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 4%;">
                            <label class="control-label col-xs-3">Precio:</label>
                            <div class="col-xs-9">
                                <input type="number" min="1" class="form-control" name="insertFilmPrice" placeholder="1" required value="">
                            </div>
                        </div>
                        <div class="text-center" style="margin-top: 2%; margin-bottom: 5%;">
                            <input type="submit" name="insertFilmInsert" class="btn btn-primary disabled" value="Insertar Película">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="insertarDirector">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Insertar Director</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-md-11" style="width: 85%; margin: 0 auto;">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Nombre:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertNameDirector" placeholder="Nombre Director" required>
                            </div>                   
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 2%; margin-bottom: 5%;">
                    <input type="button" name="insertDirector" class="btn btn-primary disabled" value="Insertar Director" />
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="insertarActor">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Insertar Actor</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-md-11" style="width: 85%; margin: 0 auto;">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Nombre:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertNameActor" placeholder="Nombre Actor" required>
                            </div>                   
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 2%; margin-bottom: 5%;">
                    <input type="button" name="insertActor" class="btn btn-primary disabled" value="Insertar Actor" />
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="insertarCine">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Insertar Cine</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-md-11" style="width: 85%; margin: 0 auto;">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Nombre:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertNameCinema" placeholder="Nombre Cine" required>
                            </div>                   
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Dirección:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertNameAddress" placeholder="Dirección Cine" required>
                            </div>                   
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 2%; margin-bottom: 5%;">
                    <input type="button" name="insertCinema" class="btn btn-primary disabled" value="Insertar Cine"/>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="insertarGenero">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Insertar Género</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-md-11" style="width: 85%; margin: 0 auto;">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Nombre:</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="insertNameGenero" placeholder="Nombre Genero" required>
                            </div>                   
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top: 2%; margin-bottom: 5%;">
                    <input type="button" name="insertGenero" class="btn btn-primary disabled" value="Insertar Genero"/>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="modPelicula">
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
        <div role="tabpanel" class="tab-pane fade" id="eliminarPelicula">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Eliminar Película</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <select name="selectRemoveFilm" class="form-control">
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
                    <button name="removeFilm" style="margin-top: 5%;" class="btn btn-primary">Eliminar</button>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="eliminarDirector">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Eliminar Director</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <select name="selectRemoveDirector" class="form-control">
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
                    <button name="removeDirector" style="margin-top: 5%;" class="btn btn-primary">Eliminar</button>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="eliminarActor">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Eliminar Actor</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <select name="selectRemoveActor" class="form-control">
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
                    <button name="removeActor" style="margin-top: 5%;" class="btn btn-primary">Eliminar</button>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="eliminarCine">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Eliminar Cine</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <select name="selectRemoveCinema" class="form-control">
                        <?php
                        for ($x = 0; $x < count($cinemas); $x++) {
                            $selected = "";
                            if ($x == 0) {
                                $selected = "selected";
                            }
                            echo "<option value='" . $cinemas[$x]->getId_cinema() . "'>" . $cinemas[$x]->getName_cinema() . "</option>";
                        }
                        ?>
                    </select>
                    <button name="removeCinema" style="margin-top: 5%;" class="btn btn-primary">Eliminar</button>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="eliminarGenero">
            <div class="row" style="width: 90%; margin: 0 auto; margin-top: 4%;">
                <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
                    <h3>Eliminar Género</h3>
                    <hr class="star-primary">
                </div>

                <div class="col-lg-12 text-center">
                    <select name="selectRemoveGenero" class="form-control">
                        <?php
                        for ($x = 0; $x < count($generos); $x++) {
                            $selected = "";
                            if ($x == 0) {
                                $selected = "selected";
                            }
                            echo "<option value='" . $generos[$x][0] . "'>" . $generos[$x][1] . "</option>";
                        }
                        ?>
                    </select>
                    <button name="removeGenero" style="margin-top: 5%;" class="btn btn-primary">Eliminar</button>
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
                    <button name="cleanTicketsCinema" style="margin-top: 5%;" class="btn btn-primary">Limpiar Reservadas</button>
                    <button name="resetTicketsCinema" style="margin-top: 5%;" class="btn btn-primary">Reiniciar Sala</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Messages -->
<script src="views/resource/js/messages.js"></script>

<!-- removeElements -->
<script src="views/resource/js/settingsAdmin.removeElements.js"></script>

<!-- addElements -->
<script src="views/resource/js/settingsAdmin.addElements.js"></script>

<!-- clearTickets -->
<script src="views/resource/js/settingsAdmin.clearTickets.js"></script>

<!-- modFilm -->
<script src="views/resource/js/settingsAdmin.modFilm.js"></script>

<!-- checkNameNewFilm -->
<script src="views/resource/js/settingsAdmin.checkNameNewFilm.js"></script>
