<!-- Barra Pagina Interna -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand logo" href=".">
                <img style="" src="views/resource/img/logo_superior.png"/>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse logo" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="inicio">Inicio</a>
                </li>
                <li class="page-scroll">
                    <a href="peliculas">Películas</a>
                </li>
                <li class="page-scroll">
                    <a href="usuarios">Usuarios</a>
                </li>
            </ul>           

            <ul class="nav navbar-nav navbar-right">
                <!-- /.dropdown -->
                <li>
                    <a href="compra">
                        <span class="badge" name="numShop"><?php echo $numShops; ?></span>
                        <i class="fa fa-shopping-cart fa-lg" name="shop"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-user fa-fw fa-lg"></i><?php echo $nameUser; ?> <i class="fa fa-caret-down fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="ajustes"><i class="fa fa-user fa-fw"></i>Perfil</a>
                        </li>
                        <?php
                        if($role == "admin" || $role == "moderator"){
                            echo '<li><a href="admin"><i class="fa fa-cog fa-fw"></i>Administración</a></li>';
                        }
                        ?>                       
                        <li class="divider"></li>
                        <li><a href="desconectar"><i class="fa fa-sign-out fa-fw"></i>Desconectar</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <form class="navbar-form navbar-right" role="search" action="buscar" method="get">
                <div class="input-group" style="text-center: center;">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar..." required>
                    <span class="input-group-btn">
                        <button id="btnSearch" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- /.container-fluid -->
</nav>

