<section class="layoutFilmSearch">
    <div>
        <div class="col-lg-12 text-center">
            <h3>Usuarios</h3>
            <hr class="star-primary">
        </div>
    </div>

    <div class="row" id="layoutUsers">
        <?php
        echo '<div class="col-md-12 text-center" style="margin-bottom: 2%;">
                        <p class="text-center">La búsqueda "<b>' . $word . '</b>" dio <b>' . $numUsers . '</b> resultados.</p>
                  </div>';

        for ($x = 0; $x < count($usersArray); $x++) {

            $idUser = $usersArray[$x]->getId_user();
            $nickUser = $usersArray[$x]->getNick_user();

            echo '
                    <div class="col-sm-6 col-lg-4 col-md-6">
                        <div class="thumbnail">
                            <a href="usuario?idUser=' . $idUser . '">
                                <div class="layoutImage">
                                    <img src="views/resource/img/icon-user.png" alt="">
                                </div>
                                <div class="caption">
                                    <p><b>' . $nickUser . '</b></p>
                                </div>
                            </a>
                        </div>
                    </div>';
        }
        ?>

    </div>

    
<?php
if ($numUsers > 9) {
    echo '<div class="row">
                <div class="moreFilms">                    
                    <span class="btn-circle" id="moreUsers">
                        <i class="fa fa-fw fa-plus"></i>
                    </span>
                    <p id="moreUsersMessage">Cargar mas Usuarios</p>
                </div>
              </div>';
}
?>
</section>

<script>
    idUsers = <?php echo json_encode($idUsers); ?>;
</script>

<!-- loadFilms -->
<script src="views/resource/js/loadUsers.js"></script>