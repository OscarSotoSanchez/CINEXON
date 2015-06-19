<div class="barraLateral">
    <h4>Búsqueda</h4>

    <form action="." method="post">
        <div class="list-group">
            <span class="list-group-item">
                <span>Usuario</span>
                <input name="user" type="text" placeholder="Buscar Usuario"/>
            </span>
        </div>

        <div class="boton">
            <input type="submit" class="btn btn-success btn-sm button" name="searchUser" value="Buscar"/>
        </div>
    </form>

</div>

<section class="layoutFilm">
    <div>
        <div class="col-lg-12 text-center">
            <h3>Usuarios</h3>
            <hr class="star-primary">
        </div>
    </div>

    <div class="row" id="layoutUsers">
        <?php
        for ($x = 0; $x < count($usersArray); $x++) {

            if ($usersArray[$x]->getRole_user() != "admin") {
                $idUser = $usersArray[$x]->getId_user();
                $nickUser = $usersArray[$x]->getNick_user();
                $css = "";

                if ($usersArray[$x]->getRole_user() == "moderator") {
                    $css = "style='color: #2c3e50;'";
                }
                
                echo '
                    <div class="col-sm-6 col-lg-4 col-md-6">
                        <div class="thumbnail">
                            <a href="usuario?idUser=' . $idUser . '">
                                <div class="layoutImage">
                                    <img src="views/resource/img/icon-user.png" alt="">
                                </div>
                                <div class="caption">
                                    <p ' . $css . '><b>' . $nickUser . '</b></p>
                                </div>
                            </a>
                        </div>
                    </div>';
            }
        }
        ?>

    </div>

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