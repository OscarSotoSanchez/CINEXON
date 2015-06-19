<!-- Portfolio Grid Section -->
<section class="shoppingCart">
    <div>
        <div class="col-lg-12 text-center" style="margin-bottom: 2%;">
            <h3>Modificar Película</h3>
            <hr class="star-primary">
        </div>
    </div>


    <div class="row">
        <div class="col-md-11" style="width: 85%; margin: 0 auto;">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action=".">
                <?php
                echo "<input type='hidden' name='codFilm' value='$id'/>";
                ?>  
                <div class="form-group">
                    <label class="control-label col-xs-3">Portada</label>
                    <div class="col-xs-9">
                        <img style="width: 200px; height: 300px; margin: 0 auto;" src="<?php echo $film->getPoster_movie(); ?>" class="img-responsive" alt="">
                        <?php
                        
                            if(!empty($film->getPoster_movie())){
                                echo "<input type='hidden' name='modImageOld' value='".$film->getPoster_movie_Name()."'";
                            }
                        
                        ?>
                        <br/>
                        <input type='file' name='modFilmImage' style="margin: 0 auto;">
                    </div>                   
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Nombre:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="modFilmName" placeholder="Nombre Película" required value="<?php echo $film->getTitle_movie(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Sinopsis:</label>
                    <div class="col-xs-9">
                        <textarea maxlength="500" rows="5" class="form-control" name="modFilmSipnosis" placeholder="Sinopsis Película" required><?php echo $film->getSipnosis_movie(); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Género:</label>
                    <div class="col-xs-9">
                        <select name="modFilmGeneros[]" class="form-control" multiple required>
                            <?php
                            $generoFilm = $film->getGenero();
                            for ($x = 0; $x < count($generoFilm); $x++) {
                                echo '<option value="'.$generoFilm[$x][0].'" selected>' . $generoFilm[$x][1] . '</option>';
                            }
                            for ($x = 0; $x < count($generos); $x++) {
                                echo '<option value="'.$generos[$x][0].'">' . $generos[$x][1] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Año:</label>
                    <div class="col-xs-9">
                        <input type="number" min="1910" max="9999" class="form-control" name="modFilmYear" placeholder="1990" required value="<?php echo $film->getYear_movie(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Duración:</label>
                    <div class="col-xs-9">
                        <input type="number" min="0" max="999" class="form-control" name="modFilmDuration" placeholder="60" required value="<?php echo $film->getDuration_movie(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Premios:</label>
                    <div class="col-xs-9">
                        <input type="number" min="0" class="form-control" name="modFilmAdwards" placeholder="0" required value="<?php echo $film->getAwards_movie(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Calificación Edad:</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="modFilmAge" placeholder="Dejar vacio para todos los públicos" value="<?php echo $film->getAge_calification(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Trailer:</label>
                    <div class="col-xs-9">
                        <iframe width="100%" height="300px" src="https://www.youtube.com/embed/<?php echo $film->getTrailer_movie_Youtube(); ?>" frameborder="0" allowfullscreen></iframe>
                        <br/>
                        <br/>
                        <input type="text" class="form-control" name="modFilmTrailer" placeholder="Enlace Youtube" required value="<?php echo $film->getTrailer_movie(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Directores:</label>
                    <div class="col-xs-9">
                        <select name="modFilmDirector[]" class="form-control" multiple>
                            <?php
                            $directorFilm = $film->getDirector();
                            for ($x = 0; $x < count($directorFilm); $x++) {
                                echo '<option value="'.$directorFilm[$x][0].'" selected>' . $directorFilm[$x][1] . '</option>';
                            }
                            for ($x = 0; $x < count($directors); $x++) {
                                echo '<option value="'.$directors[$x][0].'">' . $directors[$x][1] . '</option>';
                            }
                            ?>                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Actores:</label>
                    <div class="col-xs-9">
                        <select name="modFilmActors[]" class="form-control" multiple>
                            <?php
                            $actorsFilm = $film->getActors();

                            for ($x = 0; $x < count($actorsFilm); $x++) {
                                echo '<option value="'.$actorsFilm[$x][0].'" selected>' . $actorsFilm[$x][1] . '</option>';
                            }
                            for ($x = 0; $x < count($actors); $x++) {
                                echo '<option value="'.$actors[$x][0].'">' . $actors[$x][1] . '</option>';
                            }
                            ?>                        
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">Formato:</label>
                    <div class="col-xs-9">
                        <select name="modFilmFormat" class="form-control">
                            <?php
                            if ($film->getFormat_movie() == "Digital") {
                                echo '<option value="Digital" selected>Digital</option>';
                                echo '<option value="Taquilla">Taquilla</option>';
                                $taquilla = "none";
                                $digital = "in-block";
                            } else {
                                echo '<option value="Digital">Digital</option>';
                                echo '<option value="Taquilla" selected>Taquilla</option>';
                                $taquilla = "in-block";
                                $digital = "none";
                            }
                            ?>                        
                        </select>
                        <div name="divDigital" style="margin-top: 4%; display: <?php echo $digital ?> ;">
                            <label class="control-label col-xs-3">Video:</label>
                            <div class="col-xs-9">
                                <?php
                                if ($film->getFormat_movie() == "Digital") {
                                    if(!empty($film->getArchive_url())){
                                        echo '<label class="help-block"><i class="help-block">' . $film->getArchive_url() . '</i></label>';                                   
                                        echo "<input type='hidden' name='modVideoOld' value='".$film->getArchive_url()."' />";
                                    }
                                } else {
                                    echo '<label class="help-block"><i class="help-block">Selecciona una película</i></label>';
                                }
                                
                                echo '<input type="file" name="modFilmVideo" />';
                                ?>                               
                            </div>
                        </div>
                        <div name="divTaquilla" class="form-group" style="margin-top: 4%; display: <?php echo $taquilla ?> ;">                          
                            <div class="col-xs-12">
                                <div style="overflow: hidden;">
                                    <div style="width: 40%; float:left;">
                                        <p class="text-center"><b>Cines</b></p>
                                        <select name="modFilmCines[]" class="form-control" multiple>
                                            <?php
                                            $cines = $film->getCines();
                                            for ($x = 0; $x < count($cines); $x++) {
                                                echo "<option value='" . $cines[$x]->getId_cinema() . "' selected>" . $cines[$x]->getName_cinema() . "</option>";
                                            }
                                            for ($x = 0; $x < count($cinemas); $x++) {
                                                echo "<option value='" . $cinemas[$x]->getId_cinema() . "'>" . $cinemas[$x]->getName_cinema() . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div style="width: 40%; float:right;">
                                        <p class="text-center"><b>Horas</b></p>
                                        <select name="modFilmHoras[]" class="form-control" multiple>
                                            <?php
                                            $horas = $film->getHoras();

                                            for ($x = 13; $x <= 23; $x++) {
                                                $hora = $x . ":00";
                                                $horayMedia = $x . ":30";
                                                $horaSelected = "";
                                                $horaMediaSelected = "";

                                                for ($i = 0; $i < count($horas); $i++) {
                                                    if ($hora == $horas[$i]) {
                                                        $horaSelected = "selected";
                                                        break;
                                                    }

                                                    if ($horayMedia == $horas[$i]) {
                                                        $horaMediaSelected = "selected";
                                                        break;
                                                    }
                                                }

                                                echo "<option value='$hora' " . $horaSelected . ">$hora</option>";
                                                echo "<option value='$horayMedia'" . $horaMediaSelected . ">$horayMedia</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>  
                                </div>
                                <div style="width: 50%; margin: 0 auto; margin-top: 5%;">
                                    <p class="text-center"><b>Número Entradas</b></p>
                                    <input type="number" class="form-control" name="modFilmNumTickets" min="1" value="<?php echo $tickets; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 4%;">
                    <label class="control-label col-xs-3">Precio:</label>
                    <div class="col-xs-9">
                        <input type="number" min="1" class="form-control" name="modFilmPrice" placeholder="1" required value="<?php echo $film->getPrice_movie(); ?>">
                        <div class="text-center" style="margin-top: 5%;">
                            <input type="submit" name="modFilmModifications" class="btn btn-primary" value="Modificar Película">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- deleteShop -->
<script src="views/resource/js/modFilm.js"></script>
