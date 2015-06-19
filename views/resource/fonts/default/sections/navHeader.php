<!-- Barra Navegacion -->
<nav class = "navbar navbar-default navbar-static-top">
    <div class = "container">
        <!--Brand and toggle get grouped for better mobile display -->
        <div class = "navbar-header">
            <button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#bs-example-navbar-collapse-1">
                <span class = "sr-only">Toggle navigation</span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
            </button>

            <a class = "navbar-brand logo" href = "#page-top">
                <img style = "" src = "img/logo.png"/>
            </a>
            <a class = "navbar-brand logo">CINEXON</a>
        </div>

        <!--Collect the nav links, forms, and other content for toggling -->
        <div class = "collapse navbar-collapse logo" id = "bs-example-navbar-collapse-1">
            <ul class = "nav navbar-nav">
                <li class = "hidden">
                    <a href = "#page-top"></a>
                </li>
                <li class = "page-scroll">
                    <a href = "#">Inicio</a>
                </li>
                <li class = "page-scroll">
                    <a href = "#">Peliculas</a>
                </li>
            </ul>

            <ul class = "nav navbar-nav navbar-right">
                <!--/.dropdown -->
                <li>
                    <a>
                        <i class = "fa fa-shopping-cart fa-lg"></i>
                    </a>
                </li>
                <li class = "dropdown">
                    <a class = "dropdown-toggle" data-toggle = "dropdown">
                        <i class = "fa fa-user fa-fw fa-lg"></i> <i class = "fa fa-caret-down fa-lg"></i>
                    </a>
                    <ul class = "dropdown-menu">
                        <li><a href = "#"><i class = "fa fa-user fa-fw"></i>Perfil</a>
                        </li>
                        <li><a href = "#"><i class = "fa fa-gear fa-fw"></i>Ajustes</a>
                        </li>
                        <li class = "divider"></li>
                        <li><a href = "login.html"><i class = "fa fa-sign-out fa-fw"></i>Desconectar</a>
                        </li>
                    </ul>
                    <!--/.dropdown-user -->
                </li>
                <!--/.dropdown -->
            </ul>
            <form class = "navbar-form navbar-right" role = "search" action = "form/Busqueda.php" method = "get">
                <div class = "input-group" style = "text-center: center;">
                    <input type = "text" name = "search" class = "form-control" placeholder = "Buscar..." required>
                    <span class = "input-group-btn">
                        <button class = "btn btn-default" type = "submit">
                            <span class = "glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <!--/.container-fluid -->
</nav>

