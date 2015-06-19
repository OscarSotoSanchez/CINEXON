<?php

include_once 'core/class/loadControllers.php';
include_once 'core/class/Sessions.php';
include_once 'db/FunctionsDB.php';

$controllers = new loadControllers();
$session = new Sessions();
$functionsDB = new FunctionsDB();

if (!empty($_REQUEST['inputEmail']) && !empty($_REQUEST['inputNick']) && !empty($_REQUEST['inputName']) && !empty($_REQUEST['inputPass'])) {
    $nick = $_REQUEST['inputNick'];
    $email = $_REQUEST['inputEmail'];
    $name = $_REQUEST['inputName'];
    $pass = $_REQUEST['inputPass'];

    //Descomentar lo siguiente para registro local
    $functionsDB->addUser($nick, $email, $name, $pass);
    $controllers->viewLoginMessage("Se ha registrado correctamente, introduzca sus datos para logearse.", "");
    
    //Descomentar lo siguiente para activacion por email
    //$functionsDB->addUserWithActivate($nick, $email, $name, $pass);
    //$controllers->viewRegisterPageMail($email);
    
} else if (!empty($_REQUEST['inputPass']) && !empty($_REQUEST['inputNick'])) {
    $nick = $_REQUEST['inputNick'];
    $pass = $_REQUEST['inputPass'];

    if ($session->connectUser($nick, $pass)) {
        $controllers->viewStartPage(10, 10);
    } else {
        $controllers->viewLoginMessage("La contraseña o el usuario introducidos no son correctos, vuelvalo a intentar.", "text-danger");
    }
} else if ($session->isUserConnected()) {
    if (!empty($_REQUEST['insertFilmInsert'])) {
        if (!empty($_FILES['insertFilmImage']['tmp_name'])) {
            if (is_uploaded_file($_FILES['insertFilmImage']['tmp_name'])) {
                $directorio = "./views/resource/img/carteles/";
                $destino = $directorio . $_FILES['insertFilmImage']['name'];
                $image = $_FILES['insertFilmImage']['name'];

                if (!is_file($destino)) {
                    move_uploaded_file($_FILES['insertFilmImage']['tmp_name'], $destino);
                }
            }
        }

        if (!empty($_FILES['insertFilmVideo']['tmp_name'])) {
            if (is_uploaded_file($_FILES['insertFilmVideo']['tmp_name'])) {
                $directorio = "./views/resource/films/";
                $destino = $directorio . $_FILES['insertFilmVideo']['name'];
                $video = $_FILES['insertFilmVideo']['name'];

                if (!is_file($destino)) {
                    move_uploaded_file($_FILES['insertFilmVideo']['tmp_name'], $destino);
                }
            }
        }

        if (!empty($_REQUEST['insertFilmName'])) {
            $nameFilm = $_REQUEST['insertFilmName'];
        }

        if (!empty($_REQUEST['insertFilmSipnosis'])) {
            $sipnosis = $_REQUEST['insertFilmSipnosis'];
        }

        if (!empty($_REQUEST['insertFilmGeneros'])) {
            $generos = $_REQUEST['insertFilmGeneros'];
        }

        if (!empty($_REQUEST['insertFilmYear'])) {
            $year = $_REQUEST['insertFilmYear'];
        }

        if (!empty($_REQUEST['insertFilmDuration'])) {
            $duration = $_REQUEST['insertFilmDuration'];
        }

        if (!empty($_REQUEST['insertFilmAdwards'])) {
            $adwards = $_REQUEST['insertFilmAdwards'];
        }

        if (empty($adwards)) {
            $adwards = 0;
        }

        if (!empty($_REQUEST['insertFilmAge'])) {
            $age = $_REQUEST['insertFilmAge'];
        }

        if (empty($age)) {
            $age = "Todos los públicos";
        }

        if (!empty($_REQUEST['insertFilmTrailer'])) {
            $trailer = $_REQUEST['insertFilmTrailer'];
        }

        if (!empty($_REQUEST['insertFilmDirector'])) {
            $directors = $_REQUEST['insertFilmDirector'];
        }

        if (!empty($_REQUEST['insertFilmActors'])) {
            $actors = $_REQUEST['insertFilmActors'];
        }

        if (!empty($_REQUEST['insertFilmFormat'])) {
            $format = $_REQUEST['insertFilmFormat'];
        }

        if ($format == "Taquilla") {
            if (!empty($_REQUEST['insertFilmCines'])) {
                $cines = $_REQUEST['insertFilmCines'];
            }

            if (!empty($_REQUEST['insertFilmHoras'])) {
                $horas = $_REQUEST['insertFilmHoras'];
            }
        }

        if (!empty($_REQUEST['insertFilmNumTickets'])) {
            $tickets = $_REQUEST['insertFilmNumTickets'];
        }

        if (!empty($_REQUEST['insertFilmPrice'])) {
            $price = $_REQUEST['insertFilmPrice'];
        }

        if ($format == "Digital") {
            $id = $functionsDB->addFilm($nameFilm, $image, $sipnosis, $generos, $year, $format, $price, $duration, $adwards, $age, $trailer, $video, $directors, $actors, array(), array(), 0);
        } else {
            $id = $functionsDB->addFilm($nameFilm, $image, $sipnosis, $generos, $year, $format, $price, $duration, $adwards, $age, $trailer, "", $directors, $actors, $cines, $horas, $tickets);
        }

        $controllers->viewFilm($id);
    } else if (!empty($_REQUEST['modFilmModifications'])) {
        if (!empty($_REQUEST['codFilm'])) {
            $id = $_REQUEST['codFilm'];
        }

        if (!empty($_FILES['modFilmImage']['tmp_name'])) {
            if (is_uploaded_file($_FILES['modFilmImage']['tmp_name'])) {
                $directorio = "./views/resource/img/carteles/";
                $destino = $directorio . $_FILES['modFilmImage']['name'];
                $image = $_FILES['modFilmImage']['name'];

                if (!is_file($destino)) {
                    move_uploaded_file($_FILES['modFilmImage']['tmp_name'], $destino);
                }
            }
        }

        if (!empty($_REQUEST['modImageOld'])) {
            if (empty($image)) {
                $image = $_REQUEST['modImageOld'];
            }
        }

        if (!empty($_FILES['modFilmVideo']['tmp_name'])) {
            if (is_uploaded_file($_FILES['modFilmVideo']['tmp_name'])) {
                $directorio = "./views/resource/films/";
                $destino = $directorio . $_FILES['modFilmVideo']['name'];
                $video = $_FILES['modFilmVideo']['name'];

                if (!is_file($destino)) {
                    move_uploaded_file($_FILES['modFilmVideo']['tmp_name'], $destino);
                }
            }
        }

        if (!empty($_REQUEST['modVideoOld'])) {
            if (empty($video)) {
                $video = $_REQUEST['modVideoOld'];
            }
        }

        if (!empty($_REQUEST['modFilmName'])) {
            $nameFilm = $_REQUEST['modFilmName'];
        }

        if (!empty($_REQUEST['modFilmSipnosis'])) {
            $sipnosis = $_REQUEST['modFilmSipnosis'];
        }

        if (!empty($_REQUEST['modFilmGeneros'])) {
            $generos = $_REQUEST['modFilmGeneros'];
        }

        if (!empty($_REQUEST['modFilmYear'])) {
            $year = $_REQUEST['modFilmYear'];
        }

        if (!empty($_REQUEST['modFilmDuration'])) {
            $duration = $_REQUEST['modFilmDuration'];
        }

        if (!empty($_REQUEST['modFilmAdwards'])) {
            $adwards = $_REQUEST['modFilmAdwards'];
        }

        if (empty($adwards)) {
            $adwards = 0;
        }

        if (!empty($_REQUEST['modFilmAge'])) {
            $age = $_REQUEST['modFilmAge'];
        }

        if (empty($age)) {
            $age = "Todos los públicos";
        }

        if (!empty($_REQUEST['modFilmTrailer'])) {
            $trailer = $_REQUEST['modFilmTrailer'];
        }

        if (!empty($_REQUEST['modFilmDirector'])) {
            $directors = $_REQUEST['modFilmDirector'];
        }

        if (!empty($_REQUEST['modFilmActors'])) {
            $actors = $_REQUEST['modFilmActors'];
        }

        if (!empty($_REQUEST['modFilmFormat'])) {
            $format = $_REQUEST['modFilmFormat'];
        }

        if ($format == "Taquilla") {
            if (!empty($_REQUEST['modFilmCines'])) {
                $cines = $_REQUEST['modFilmCines'];
            }

            if (!empty($_REQUEST['modFilmHoras'])) {
                $horas = $_REQUEST['modFilmHoras'];
            }
        }

        if (!empty($_REQUEST['modFilmNumTickets'])) {
            $tickets = $_REQUEST['modFilmNumTickets'];
        }

        if (!empty($_REQUEST['modFilmPrice'])) {
            $price = $_REQUEST['modFilmPrice'];
        }

        if ($format == "Digital") {
            $functionsDB->refreshFilm($id, $nameFilm, $image, $sipnosis, $generos, $year, $format, $price, $duration, $adwards, $age, $trailer, $video, $directors, $actors, array(), array(), 0);
        } else {
            $functionsDB->refreshFilm($id, $nameFilm, $image, $sipnosis, $generos, $year, $format, $price, $duration, $adwards, $age, $trailer, "", $directors, $actors, $cines, $horas, $tickets);
        }

        $controllers->viewFilm($id);
    } else if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        if (intval($id) == 0) {
            header('Location: peliculas');
        } else {
            $controllers->viewFilm($id);
        }
    } else if (!empty($_REQUEST['idUser'])) {
        $id = $_REQUEST['idUser'];
        if (intval($id) == 0) {
            header('Location: usuarios');
        } else {
            $controllers->viewUsersPag($id);
        }
    } else if (!empty($_REQUEST['search'])) {
        $word = "noresult";

        if (!empty($_REQUEST['search'])) {
            $word = $_REQUEST['search'];
        }

        $controllers->viewSearchFilms($word);
    } else if (!empty($_REQUEST['searchUser'])) {
        $word = "noresult";

        if (!empty($_REQUEST['user'])) {
            $word = $_REQUEST['user'];
        }

        $controllers->viewUsersSearch($word);
    } else if (!empty($_REQUEST['searchComplex'])) {
        $title = "";
        $genero = "";
        $director = "";

        if (!empty($_REQUEST['title'])) {
            $title = $_REQUEST['title'];
        }

        if (!empty($_REQUEST['genero'])) {
            $genero = $_REQUEST['genero'];
        }

        if (!empty($_REQUEST['director'])) {
            $director = $_REQUEST['director'];
        }

        if ($title == "" && $genero == "" && $director == "") {
            $controllers->viewFilms();
        } else {
            $controllers->viewSearchFilmsComplex($title, $genero, $director);
        }
    } else if (!empty($_REQUEST['shop'])) {
        if (count($session->getShoppingCart()) > 0) {
            $controllers->viewShops();
        } else {
            $controllers->viewShoppingCart();
        }
    } else if (!empty($_REQUEST['modFilm'])) {
        $id = $_REQUEST['idMovie'];
        $roleUser = $session->getConnectUser()->getRole_user();

        if ($roleUser == "admin" || $roleUser == "moderator") {
            $controllers->viewModFilm($id);
        }
    } else if (!empty($_REQUEST['modGenero'])) {
        $id = $_REQUEST['idGenero'];
        $roleUser = $session->getConnectUser()->getRole_user();

        if ($roleUser == "admin" || $roleUser == "moderator") {
            $controllers->viewModGenero($id);
        }
    } else if (!empty($_REQUEST['modDirector'])) {
        $id = $_REQUEST['idDirector'];
        $roleUser = $session->getConnectUser()->getRole_user();

        if ($roleUser == "admin" || $roleUser == "moderator") {
            $controllers->viewModDirector($id);
        }
    } else if (!empty($_REQUEST['modActor'])) {
        $id = $_REQUEST['idActor'];
        $roleUser = $session->getConnectUser()->getRole_user();

        if ($roleUser == "admin" || $roleUser == "moderator") {
            $controllers->viewModActor($id);
        }
    } else if (!empty($_REQUEST['modCinema'])) {
        $id = $_REQUEST['idCinema'];
        $roleUser = $session->getConnectUser()->getRole_user();

        if ($roleUser == "admin" || $roleUser == "moderator") {
            $controllers->viewModCinema($id);
        }
    } else if (!empty($_REQUEST['page'])) {
        $page = $_REQUEST['page'];

        switch ($page) {
            case "films":
                $controllers->viewFilms();
                break;
            case "filmsRelated":
                $controllers->viewFilmsValorated();
                break;
            case "logout":
                $session->disconnectUser();
                header('Location: .');
                break;
            case "inicio":
                $controllers->viewStartPage(10, 10);
                break;
            case "users":
                $controllers->viewUsers();
                break;
            case "shoppingCart":
                $controllers->viewShoppingCart();
                break;
            case "settings":
                $roleUser = $session->getConnectUser()->getRole_user();

                if ($roleUser == "admin") {
                    $controllers->viewSettingsAdminNormal();
                } else {
                    $controllers->viewSettings();
                }
                break;
            case "admin":
                $roleUser = $session->getConnectUser()->getRole_user();

                if ($roleUser == "admin") {
                    $controllers->viewSettingsAdmin();
                } else if ($roleUser == "moderator") {
                    $controllers->viewSettingsMod();
                } else {
                    header('Location: .');
                }
                break;
            default:
                //Caruseles
                header('Location: .');
        }
    } else {
        $controllers->viewStartPage(10, 10);
    }
} else if (!$session->isUserConnected()) {
    if (!empty($_REQUEST['page'])) {
        $page = $_REQUEST['page'];

        switch ($page) {
            case "register":
                $controllers->viewRegisterPage();
                break;
            case "sesion":
                $controllers->viewLoginMessage("Introduzca sus datos para logearse.", "");
                break;
            case "loginEmail":
                $controllers->viewLoginMessage("La cuenta se ha activado correctamente, introduzca sus datos para logearse.", "");
                break;
            case "changePassword":
                $controllers->viewChangePassword();
                break;
            default:
                //Caruseles
                header('Location: .');
        }
    } else {
        $controllers->viewMainPage();
    }
}
    