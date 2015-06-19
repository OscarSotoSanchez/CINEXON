<div class="container">
    <div class="card card-container">
        <a href=".">
            <img id="profile-img" class="profile-img-card" src="views/resource/img/logo.png" />
        </a>
        <p id="profile-name" class="profile-name-card <?php echo $type ?>"><?php echo $message ?> </p>
        <form class="form-signin" action="" method="post">
            <input type="text" name="inputNick" class="form-control" placeholder="Nick" required>
            <input type="password" name="inputPass" class="form-control" placeholder="Contraseña" required>
            <div class="text-center" style="margin-bottom: 5%; margin-top: 5%;">
                <a href="cambiarcontra">Olvidé Mi Contraseña</a>
            </div>
            <input type="submit" id="button" class="btn btn-lg btn-primary btn-block btn-signin" value="Inicia Sesión">
        </form><!-- /form -->
    </div>
</div>