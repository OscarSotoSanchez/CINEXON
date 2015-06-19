<?php

include_once 'DataBase.php';

/* Clase encargada de hacer inserciones, modificaciones y elminaciones de la BBDD */

class FunctionsDB extends DataBase {

    public function __construct() {
        //Incluir todas las clases necesarias
        foreach (glob("core/class/*.php") as $file) {
            include_once $file;
        }
    }

    /* Querys Films */

    function selectReturnArrayFilms($select) {
        $this->connection_database();
        $films = array();

        $query = $this->execution_query($select);

        while ($resultQuery = $query->fetch_assoc()) {
            $film = new Film($resultQuery["id_movie"], $resultQuery["title_movie"], $resultQuery["poster_movie"], $resultQuery["sinopsis_movie"], $resultQuery["year_movie"], $resultQuery["format_movie"], $resultQuery["price_movie"], $resultQuery["duration_movie"], $resultQuery["awards_movie"], $resultQuery["age_calification"], $resultQuery["trailer_movie"], $resultQuery["archive_url"]);
            array_push($films, $film);
        }

        $this->disconnect_database();
        if ($query) {
            return $films;
        } else {
            return false;
        }
    }

    function selectReturnArrayFilmsID($select) {
        $this->connection_database();
        $films = array();

        $query = $this->execution_query($select);

        while ($resultQuery = $query->fetch_assoc()) {
            array_push($films, $resultQuery["id_movie"]);
        }

        $this->disconnect_database();
        if ($query) {
            return $films;
        } else {
            return false;
        }
    }

    function getFilmsRange($start, $finish) {
        $start = $this->scape_string($start);
        $finish = $this->scape_string($finish);
        $selectGetFilmsRange = "SELECT * FROM peliculas WHERE id_movie BETWEEN $start AND $finish;";
        return $this->selectReturnArrayFilms($selectGetFilmsRange);
    }

    function getFinish($num) {
        $num = $this->scape_string($num);
        $selectGetFinish = "SELECT * FROM peliculas ORDER BY id_movie DESC LIMIT $num;";
        return $this->selectReturnArrayFilms($selectGetFinish);
    }

    function getFilmsCartelera($num) {
        $num = $this->scape_string($num);
        $selectGetFilmsCartelera = "SELECT * FROM peliculas WHERE format_movie = 'Taquilla' ORDER BY id_movie DESC LIMIT $num;";
        return $this->selectReturnArrayFilms($selectGetFilmsCartelera);
    }

    function getAllFilms() {
        $selectGetAllFilms = "SELECT * FROM peliculas ORDER BY title_movie;";
        return $this->selectReturnArrayFilms($selectGetAllFilms);
    }

    function getFilmsID($id) {
        $id = $this->scape_string($id);
        $selectGetFilmsID = "SELECT * FROM peliculas where id_movie=$id;";
        $return = $this->selectReturnArrayFilms($selectGetFilmsID);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getAllIDFilms() {
        $selectGetAllIDFilm = "SELECT id_movie FROM peliculas ORDER BY title_movie;";
        return $this->selectReturnArrayFilmsID($selectGetAllIDFilm);
    }

    function getIDFilmsMostValorated() {
        $mostValorated = array();

        $query = "SELECT id_movie
                    FROM valora
                    GROUP BY id_movie
                    ORDER BY ROUND(SUM( valoration ) + COUNT(id_movie)) DESC;";
        $arrayValorated = $this->selectReturnArrayFilmsID($query);

        $query = "SELECT id_movie FROM peliculas 
			WHERE id_movie NOT IN (SELECT id_movie
                                                FROM valora
                                                GROUP BY id_movie
                                                ORDER BY ROUND(SUM(valoration) + COUNT(id_movie)) DESC) ORDER BY title_movie;";
        $arrayNoValorated = $this->selectReturnArrayFilmsID($query);

        $mostValorated = $arrayValorated + $arrayNoValorated;

        return $mostValorated;
    }

    function getRelatedFilms($id) {
        $genero = $this->getGeneroID($id)[0][1];

        $selectGetRelatedFilms = "SELECT peli.* FROM peliculas peli, generos ge, tiene tie WHERE (ge.name_genre = '$genero') AND peli.id_movie != $id AND peli.id_movie = tie.id_movie AND ge.id_genre = tie.id_genre GROUP BY peli.id_movie ORDER BY peli.title_movie LIMIT 3;";
        return $this->selectReturnArrayFilms($selectGetRelatedFilms);
    }

    function getAllFilmSearch($word) {
        $word = $this->scape_string($word);
        $selectFilmSearch = "SELECT id_movie FROM peliculas WHERE title_movie Like '%" . $word . "%' ORDER BY title_movie;";
        return $this->selectReturnArrayFilmsID($selectFilmSearch);
    }

    function getAllFilmSearchBarra($word) {
        $word = $this->scape_string($word);
        $selectFilmSearch = "SELECT * FROM peliculas WHERE title_movie Like '%" . $word . "%' ORDER BY title_movie;";
        return $this->selectReturnArrayFilms($selectFilmSearch);
    }

    function getAllFilmSearchComplex($title, $genero, $director) {
        $title = $this->scape_string($title);
        $genero = $this->scape_string($genero);
        $director = $this->scape_string($director);
        $selectFilmSearchComplex = "SELECT peli.id_movie FROM peliculas peli, directores direc, dirige diri, generos ge, tiene ti WHERE peli.title_movie LIKE '%$title%' AND direc.name_director LIKE '%$director%'AND ge.name_genre LIKE '%$genero%' AND peli.id_movie = diri.id_movie AND direc.id_director = diri.id_director AND peli.id_movie = ti.id_movie AND ge.id_genre = ti.id_genre GROUP BY peli.id_movie ORDER BY peli.title_movie;";
        return $this->selectReturnArrayFilmsID($selectFilmSearchComplex);
    }

    function getNumTotalFilms() {

        $this->connection_database();

        $selectGetNumTotalFilms = "SELECT MAX(id_movie) Total FROM peliculas;";
        $queryGetNumTotalFilms = $this->execution_query($selectGetNumTotalFilms);
        $resultGetNumTotalFilms = $queryGetNumTotalFilms->fetch_assoc();
        $numTotal = $resultGetNumTotalFilms['Total'];

        $this->disconnect_database();
        return $numTotal;
    }

    /* Fin Querys Films */

    /* Quert User */

    function selectUser($select) {
        $this->connection_database();
        $users = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            $user = new User($result['id_user'], $result['nick_user'], $result['email_user'], $result['role_user'], $result['name_user'], $result['pass_user'], $result['age_user']);
            array_push($users, $user);
        }

        $this->disconnect_database();
        if ($query) {
            return $users;
        } else {
            return false;
        }
    }

    function selectUserID($select) {
        $this->connection_database();
        $users = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            array_push($users, $result['id_user']);
        }

        $this->disconnect_database();
        if ($query) {
            return $users;
        } else {
            return false;
        }
    }

    function loginUser($nickName, $pass) {
        $nickName = $this->scape_string($nickName);
        $this->connection_database();

        $passSHA = sha1($pass);
        $selectLogin = "SELECT id_user, nick_user, email_user, role_user, name_user, pass_user, age_user FROM usuarios WHERE nick_user='" . $nickName . "' AND pass_user='" . $passSHA . "';";
        $queryLogin = $this->execution_query($selectLogin);
        $resultQueryLoginCount = $queryLogin->num_rows;
        $resultQueryLogin = $queryLogin->fetch_assoc();

        $this->disconnect_database();

        if ($resultQueryLoginCount <= 0) {
            return false;
        } else {
            $user = new User($resultQueryLogin['id_user'], $resultQueryLogin['nick_user'], $resultQueryLogin['email_user'], $resultQueryLogin['role_user'], $resultQueryLogin['name_user'], $resultQueryLogin['pass_user'], $resultQueryLogin['age_user']);
            return $user;
        }
    }

    function loginUserWidthActivate($nickName, $pass) {
        $nickName = $this->scape_string($nickName);
        $this->connection_database();

        $passSHA = sha1($pass);
        $selectLogin = "SELECT id_user, nick_user, email_user, role_user, name_user, pass_user, age_user FROM usuarios WHERE nick_user='" . $nickName . "' AND pass_user='" . $passSHA . "' AND activo = 'activate';";
        $queryLogin = $this->execution_query($selectLogin);
        $resultQueryLoginCount = $queryLogin->num_rows;
        $resultQueryLogin = $queryLogin->fetch_assoc();

        $this->disconnect_database();

        if ($resultQueryLoginCount <= 0) {
            return false;
        } else {
            $user = new User($resultQueryLogin['id_user'], $resultQueryLogin['nick_user'], $resultQueryLogin['email_user'], $resultQueryLogin['role_user'], $resultQueryLogin['name_user'], $resultQueryLogin['pass_user'], $resultQueryLogin['age_user']);
            return $user;
        }
    }

    function getAllUsersAccountNotActivate() {
        $this->connection_database();
        $users = array();
        
        $select = "SELECT id_user, activo FROM usuarios WHERE activo != 'activate';";
        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            array_push($users, array($result['id_user'], $result['activo']));
        }

        $this->disconnect_database();
        if ($query) {
            return $users;
        } else {
            return false;
        }
    }

    function getAllUsers() {
        $selectGetAllUsers = "SELECT id_user, nick_user, email_user, role_user, name_user, pass_user, age_user FROM usuarios;";
        return $this->selectUser($selectGetAllUsers);
    }

    function getAllUsersID() {
        $selectGetAllUsers = "SELECT id_user FROM usuarios WHERE role_user != 'admin';";
        return $this->selectUserID($selectGetAllUsers);
    }

    function getUserID($id) {
        $id = $this->scape_string($id);
        $selectUserID = "SELECT id_user, nick_user, email_user, role_user, name_user, pass_user, age_user FROM usuarios WHERE id_user=$id;";
        $return = $this->selectUser($selectUserID);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getAllUsersSearch($word) {
        $word = $this->scape_string($word);
        $selectAllUserSearch = "SELECT id_user, nick_user, email_user, role_user, name_user, pass_user, age_user FROM usuarios WHERE nick_user Like '%" . $word . "%' AND role_user != 'admin';";
        return $this->selectUserID($selectAllUserSearch);
    }

    /* Fin Query User */

    /* Query ListUser */

    function selectListUser($select) {
        $this->connection_database();
        $usersList = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            $list = new ListUser($result["id_list"], $result["id_user"], $result["name_list"]);
            array_push($usersList, $list);
        }

        $this->disconnect_database();
        if ($query) {
            return $usersList;
        } else {
            return false;
        }
    }

    function getListsIfNotAddFilmUser($id_user, $id_film) {
        $id_user = $this->scape_string($id_user);
        $id_film = $this->scape_string($id_film);
        $selectGetListIfNotAddFilmUser = "SELECT * 
                            FROM listas 
                            WHERE id_user = $id_user 
                            AND id_list 
                            NOT IN (SELECT li.id_list 
                                    FROM listas li, almacena alm 
                                    WHERE li.id_user = $id_user 
                                    AND alm.id_movie = $id_film 
                                    AND li.id_list = alm.id_list);";
        return $this->selectListUser($selectGetListIfNotAddFilmUser);
    }

    function getListUser($id) {
        $id = $this->scape_string($id);
        $selectGetLists = "SELECT * FROM listas WHERE id_user = $id;";
        return $this->selectListUser($selectGetLists);
    }

    function getListUserByID($id) {
        $id = $this->scape_string($id);
        $selectGetListUserByID = "SELECT * FROM listas WHERE id_list = $id;";
        $return = $this->selectListUser($selectGetListUserByID);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    /* Fin Query ListUser */

    /* Query ListElements */

    function selectListElements($select) {
        $this->connection_database();
        $listElements = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            $list = new ElementList($result["id_storage"], $result["id_list"], $result["id_movie"]);
            array_push($listElements, $list);
        }

        $this->disconnect_database();
        if ($query) {
            return $listElements;
        } else {
            return false;
        }
    }

    function getListElements($id) {
        $id = $this->scape_string($id);
        $selectGetElementsList = "SELECT * FROM almacena WHERE id_list = $id;";
        return $this->selectListElements($selectGetElementsList);
    }

    function getElementList($id) {
        $id = $this->scape_string($id);
        $selectGetElementList = "SELECT * FROM almacena WHERE id_storage = $id;";
        $return = $this->selectListElements($selectGetElementList);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    /* Fin Query ListElements */

    /* Query Actors */

    function selectActors($select) {
        $this->connection_database();
        $actors = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            array_push($actors, array($result['id_actor'], $result['name_actor']));
        }

        $this->disconnect_database();
        if ($query) {
            return $actors;
        } else {
            return false;
        }
    }

    function getActorsByName($name) {
        $name = $this->scape_string($name);
        $selectGetActorsByName = "SELECT * FROM actores WHERE name_actor='$name';";
        $return = $this->selectActors($selectGetActorsByName);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getAllActors() {
        $selectGetAllActors = "SELECT * FROM actores;";
        return $this->selectActors($selectGetAllActors);
    }

    function getActorsID($id) {
        $id = $this->scape_string($id);
        $selectGetActorID = "SELECT acto.* FROM peliculas peli, actores acto, participa pa WHERE peli.id_movie = $id AND peli.id_movie = pa.id_movie AND acto.id_actor = pa.id_actor;";
        return $this->selectActors($selectGetActorID);
    }

    function getOneActorID($id) {
        $id = $this->scape_string($id);
        $selectGetOneActorID = "SELECT * FROM actores WHERE id_actor=$id;";
        $return = $this->selectActors($selectGetOneActorID);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getActorsNotInFilmID($id) {
        $id = $this->scape_string($id);
        $selectGetActorNotInFilmID = "SELECT *
                            FROM actores 
                            WHERE id_actor 
                            NOT IN (SELECT acto.id_actor 
                                    FROM peliculas peli, actores acto, participa pa 
                                    WHERE peli.id_movie = $id 
                                    AND peli.id_movie = pa.id_movie 
                                    AND acto.id_actor = pa.id_actor);";
        return $this->selectActors($selectGetActorNotInFilmID);
    }

    /* Fin Query Actors */

    /* Query Genero */

    function selectGenero($select) {
        $this->connection_database();
        $generos = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            array_push($generos, array($result['id_genre'], $result['name_genre']));
        }

        $this->disconnect_database();
        if ($query) {
            return $generos;
        } else {
            return false;
        }
    }

    function getOneGeneroID($id) {
        $id = $this->scape_string($id);
        $selectGetOneDirectors = "SELECT * FROM generos WHERE id_genre='$id';";
        $return = $this->selectGenero($selectGetOneDirectors);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getGeneroByName($name) {
        $name = $this->scape_string($name);
        $selectGetGeneroByName = "SELECT * FROM generos WHERE name_genre='$name';";
        $return = $this->selectGenero($selectGetGeneroByName);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getGeneroID($id) {
        $id = $this->scape_string($id);
        $selectGetGeneroID = "SELECT ge.* FROM peliculas peli, generos ge, tiene ti WHERE peli.id_movie = $id AND peli.id_movie = ti.id_movie AND ge.id_genre = ti.id_genre;";
        return $this->selectGenero($selectGetGeneroID);
    }

    function getAllGeneros() {
        $selectGetAllDirectors = "SELECT * FROM generos;";
        return $this->selectGenero($selectGetAllDirectors);
    }

    function getGeneroNotInFilmID($id) {
        $id = $this->scape_string($id);
        $selectGetGeneroNotInFilmID = "SELECT * FROM generos WHERE id_genre NOT IN (SELECT ge.id_genre GENERO FROM peliculas peli, generos ge, tiene ti WHERE peli.id_movie = $id AND peli.id_movie = ti.id_movie AND ge.id_genre = ti.id_genre) ORDER BY id_genre ASC;";
        return $this->selectGenero($selectGetGeneroNotInFilmID);
    }

    /* Fin Query Genero */

    /* Query Director */

    function selectDirector($select) {
        $this->connection_database();
        $directors = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            array_push($directors, array($result['id_director'], $result['name_director']));
        }

        $this->disconnect_database();
        if ($query) {
            return $directors;
        } else {
            return false;
        }
    }

    function getDirectorByName($name) {
        $name = $this->scape_string($name);
        $selectGetDirectorByName = "SELECT * FROM directores WHERE name_director='$name';";
        $return = $this->selectDirector($selectGetDirectorByName);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getAllDirectors() {
        $selectGetAllDirectors = "SELECT * FROM directores;";
        return $this->selectDirector($selectGetAllDirectors);
    }

    function getDirectorID($id) {
        $id = $this->scape_string($id);
        $selectGetDirectorID = "SELECT direc.* FROM peliculas peli, directores direc, dirige diri WHERE peli.id_movie = $id AND peli.id_movie = diri.id_movie AND direc.id_director = diri.id_director;";
        return $this->selectDirector($selectGetDirectorID);
    }

    function getOneDirectorID($id) {
        $id = $this->scape_string($id);
        $selectGetOneDirectorID = "SELECT * FROM directores WHERE id_director=$id;";
        $return = $this->selectDirector($selectGetOneDirectorID);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getDirectorNotInFilmID($id) {
        $id = $this->scape_string($id);
        $selectGetDirectorNotInFilmID = "SELECT * 
                                FROM directores 
                                WHERE id_director 
                                NOT IN (SELECT direc.id_director 
                                        FROM peliculas peli, directores direc, dirige diri 
                                        WHERE peli.id_movie = $id 
                                        AND peli.id_movie = diri.id_movie 
                                        AND direc.id_director = diri.id_director);";
        return $this->selectDirector($selectGetDirectorNotInFilmID);
    }

    /* Fin Query Director */

    /* Query Notes */

    function getGeneralNoteID($id) {
        $id = $this->scape_string($id);
        $this->connection_database();

        $selectReview = "SELECT SUM(valoration) VAL, COUNT(id_movie) CONT FROM valora WHERE id_movie=$id;";
        $queryReview = $this->execution_query($selectReview);
        $resultQueryReview = $queryReview->fetch_assoc();
        $starts = $resultQueryReview["VAL"];
        $countReviews = $resultQueryReview["CONT"];

        if ($starts != 0 && $countReviews != 0) {
            $result = round($starts / $countReviews);
        } else {
            $result = 0;
        }

        $this->disconnect_database();
        return $result;
    }

    function getNoteByUser($id_user, $id_movie) {
        $id_user = $this->scape_string($id_user);
        $id_movie = $this->scape_string($id_movie);
        $this->connection_database();

        $selectReview = "SELECT valoration VAL FROM valora WHERE id_user = $id_user AND id_movie = $id_movie;";
        $queryReview = $this->execution_query($selectReview);
        $resultQueryReview = $queryReview->fetch_assoc();
        $starts = $resultQueryReview["VAL"];

        if ($starts == 0) {
            $starts = 0;
        }

        $this->disconnect_database();
        return $starts;
    }

    /* Fin Query Notes */

    /* Query Valorations */

    function selectValorations($select) {
        $this->connection_database();
        $valorations = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            $valoration = new Valorations($result["id_valoration"], $result["id_user"], $result["id_movie"], $result["valoration"], $result["review"], $result["date_valoration"]);
            array_push($valorations, $valoration);
        }

        $this->disconnect_database();
        if ($query) {
            return $valorations;
        } else {
            return false;
        }
    }

    function getAllValorations($id) {
        $id = $this->scape_string($id);
        $selectAllValorations = "SELECT id_valoration, id_user, id_movie, valoration, review, DATE_FORMAT(date_valoration, '%d-%m-%Y') AS date_valoration FROM valora WHERE id_movie=$id ORDER BY id_valoration DESC;";
        return $this->selectValorations($selectAllValorations);
    }

    function getAllValorationsByUser($id) {
        $id = $this->scape_string($id);
        $selectVallorationsByUser = "SELECT id_valoration, id_user, id_movie, valoration, review, DATE_FORMAT(date_valoration, '%d-%m-%Y') AS date_valoration FROM valora WHERE id_user=$id ORDER BY id_valoration DESC;";
        return $this->selectValorations($selectVallorationsByUser);
    }

    function getValorationID($id) {
        $id = $this->scape_string($id);
        $selectGetValorationsID = "SELECT id_valoration, id_user, id_movie, valoration, review, DATE_FORMAT(date_valoration, '%d-%m-%Y') AS date_valoration FROM valora WHERE id_valoration=$id;";
        $return = $this->selectValorations($selectGetValorationsID);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    /* Fin Query Valorations */

    /* Query Buy */

    function getAllBuyFilms($id) {
        $id = $this->scape_string($id);
        $this->connection_database();
        $buyFilms = array();

        $selectReview = "SELECT id_buy_digital, id_movie, id_user, DATE_FORMAT(date_buy, '%d-%m-%Y') AS date_buy FROM compra_digital WHERE id_user = $id ORDER BY id_buy_digital DESC;";

        $queryReview = $this->execution_query($selectReview);

        while ($resultQueryBuyFilm = $queryReview->fetch_assoc()) {
            $buy = new Buy($resultQueryBuyFilm['id_buy_digital'], $resultQueryBuyFilm['id_movie'], $resultQueryBuyFilm['id_user'], $resultQueryBuyFilm['date_buy'], "", "", "");
            array_push($buyFilms, $buy);
        }

        $selectReview = "SELECT id_buy_tickets, id_movie, id_user, DATE_FORMAT(date_buy, '%d-%m-%Y') AS date_buy, tickets_buy, id_cinema, hora_sesion FROM compra_tickets WHERE id_user = $id ORDER BY id_buy_tickets DESC;";

        $queryReview = $this->execution_query($selectReview);

        while ($resultQueryBuyFilm = $queryReview->fetch_assoc()) {
            $buy = new Buy($resultQueryBuyFilm['id_buy_tickets'], $resultQueryBuyFilm['id_movie'], $resultQueryBuyFilm['id_user'], $resultQueryBuyFilm['date_buy'], $resultQueryBuyFilm['tickets_buy'], $resultQueryBuyFilm['id_cinema'], $resultQueryBuyFilm['hora_sesion']);
            array_push($buyFilms, $buy);
        }


        $this->disconnect_database();
        return $buyFilms;
    }

    function getBuyFilmDigital($idFilm, $idUser) {
        $idFilm = $this->scape_string($idFilm);
        $idUser = $this->scape_string($idUser);
        $this->connection_database();

        $selectReview = "SELECT id_buy_digital, id_movie, id_user, DATE_FORMAT(date_buy, '%d-%m-%Y') AS date_buy FROM compra_digital WHERE id_user = $idUser AND id_movie=$idFilm ORDER BY id_buy_digital DESC;";

        $queryReview = $this->execution_query($selectReview);
        $resultQueryBuyFilm = $queryReview->fetch_assoc();

        if ($resultQueryBuyFilm) {
            $buy = new Buy($resultQueryBuyFilm['id_buy_digital'], $resultQueryBuyFilm['id_movie'], $resultQueryBuyFilm['id_user'], $resultQueryBuyFilm['date_buy'], "", "", "");

            $this->disconnect_database();
            return $buy;
        } else {
            return false;
        }
    }

    function getBuyTickets($idBuy) {
        $idBuy = $this->scape_string($idBuy);
        $this->connection_database();

        $selectReview = "SELECT id_buy_tickets, id_movie, id_user, DATE_FORMAT(date_buy, '%d-%m-%Y') AS date_buy, tickets_buy, id_cinema, hora_sesion FROM compra_tickets WHERE id_buy_tickets=$idBuy;";
        $queryReview = $this->execution_query($selectReview);
        $resultQueryBuyFilm = $queryReview->fetch_assoc();

        if ($resultQueryBuyFilm) {
            $buy = new Buy($resultQueryBuyFilm['id_buy_tickets'], $resultQueryBuyFilm['id_movie'], $resultQueryBuyFilm['id_user'], $resultQueryBuyFilm['date_buy'], $resultQueryBuyFilm['tickets_buy'], $resultQueryBuyFilm['id_cinema'], $resultQueryBuyFilm['hora_sesion']);

            $this->disconnect_database();
            return $buy;
        } else {
            return false;
        }
    }

    /* Fin Query Buy */

    /* Query Messages */

    function selectMessages($select) {
        $this->connection_database();
        $messages = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            $message = new Message($result['id_message'], $result['id_transmitter'], $result['id_receiver'], $result['content_message']);
            array_push($messages, $message);
        }

        $this->disconnect_database();
        if ($query) {
            return $messages;
        } else {
            return false;
        }
    }

    function getMessages($id) {
        $id = $this->scape_string($id);
        $selectGetMessages = "SELECT * FROM mensajea WHERE id_receiver = $id ORDER BY id_message DESC;";
        return $this->selectMessages($selectGetMessages);
    }

    function getMessage($id) {
        $id = $this->scape_string($id);
        $selectGetMessages = "SELECT * FROM mensajea WHERE id_message = $id;";
        $return = $this->selectMessages($selectGetMessages);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    /* Fin Query Message */

    /* Query Offer */

    function selectOffer($select) {
        $this->connection_database();
        $offers = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            $offer = new Offer($result['id_offer'], $result['id_cinema'], $result['id_movie'], $result['tickets'], $result['hora']);
            array_push($offers, $offer);
        }

        $this->disconnect_database();
        if ($query) {
            return $offers;
        } else {
            return false;
        }
    }

    function getAllOffers() {
        $selectAllOffers = "SELECT * FROM ofrece;";
        return $this->selectOffer($selectAllOffers);
    }

    function getOfferByFilm($id) {
        $id = $this->scape_string($id);
        $selectOfferByFilm = "SELECT * FROM ofrece WHERE id_movie = $id;";
        return $this->selectOffer($selectOfferByFilm);
    }

    function getOfferByID($id) {
        $id = $this->scape_string($id);
        $selectOfferByID = "SELECT * FROM ofrece WHERE id_offer = $id";
        $return = $this->selectOffer($selectOfferByID);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getOfferByCinemaHora($idMovie, $idCinema, $hora) {
        $idMovie = $this->scape_string($idMovie);
        $idCinema = $this->scape_string($idCinema);
        $hora = $this->scape_string($hora);
        $selectOfferByCinemaHora = "SELECT * FROM ofrece WHERE id_movie = $idMovie AND id_cinema = $idCinema AND hora = '$hora';";
        $return = $this->selectOffer($selectOfferByCinemaHora);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getHorasOffer($id) {
        $id = $this->scape_string($id);
        $this->connection_database();

        $selectReview = "SELECT DISTINCT hora FROM ofrece WHERE id_movie = $id;";
        $queryReview = $this->execution_query($selectReview);
        $horas = array();

        while ($resultQueryBuyFilm = $queryReview->fetch_assoc()) {
            array_push($horas, substr($resultQueryBuyFilm['hora'], 0, 5));
        }

        $this->disconnect_database();
        return $horas;
    }

    /* Fin Query Offer */

    /* Query Cinema */

    function selectCinema($select) {
        $this->connection_database();
        $cinemas = array();

        $query = $this->execution_query($select);
        while ($result = $query->fetch_assoc()) {
            $cinema = new Cinema($result['id_cinema'], $result['address_cinema'], $result['name_cinema']);
            array_push($cinemas, $cinema);
        }

        $this->disconnect_database();
        if ($query) {
            return $cinemas;
        } else {
            return false;
        }
    }

    function getCinemaNotInFilmID($id) {
        $id = $this->scape_string($id);
        $selectGetCinemaNotInFilmID = "SELECT * FROM cines WHERE id_cinema NOT IN (SELECT DISTINCT ci.id_cinema FROM ofrece ofre, cines ci WHERE ofre.id_movie = $id AND ofre.id_cinema = ci.id_cinema);";
        return $this->selectCinema($selectGetCinemaNotInFilmID);
    }

    function getCinemaByName($name) {
        $name = $this->scape_string($name);
        $selectGetCinemaByName = "SELECT * FROM cines WHERE name_cinema='$name';";
        $return = $this->selectCinema($selectGetCinemaByName);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getAllCinemas() {
        $selectAllCinemas = "SELECT * FROM cines;";
        return $this->selectCinema($selectAllCinemas);
    }

    function getCinema($id) {
        $id = $this->scape_string($id);
        $selectGetCinema = "SELECT * FROM cines WHERE id_cinema=$id;";
        $return = $this->selectCinema($selectGetCinema);
        if (!$return) {
            return false;
        } else {
            return $return[0];
        }
    }

    function getCinemasOffer($id) {
        $id = $this->scape_string($id);
        $selectCinemasOffer = "SELECT DISTINCT ci.* FROM ofrece ofre, cines ci WHERE ofre.id_movie = $id AND ofre.id_cinema = ci.id_cinema;";
        return $this->selectCinema($selectCinemasOffer);
    }

    /* Fin Query Cinema */

    /* Query Add */

    function selectAdd($select) {
        $this->connection_database();
        $query = $this->execution_query($select);
        $id = $this->id_autoincrement();
        $this->disconnect_database();

        if ($query) {
            return $id;
        } else {
            return false;
        }
    }

    function addUser($nick_user, $email_user, $name_user, $pass_user) {
        $nick_user = $this->scape_string($nick_user);
        $email_user = $this->scape_string($email_user);
        $name_user = $this->scape_string($name_user);
        $passSHA = sha1($pass_user);
        $selectAddUser = "INSERT INTO usuarios(nick_user, email_user, name_user, pass_user) VALUES ('$nick_user', '$email_user','$name_user','$passSHA')";
        $id = $this->selectAdd($selectAddUser);

        if ($id) {
            return $this->addList($id, "Mis Favoritas");
        } else {
            return false;
        }
    }

    function addUserWithActivate($nick_user, $email_user, $name_user, $pass_user) {
        $nick_user = $this->scape_string($nick_user);
        $email_user = $this->scape_string($email_user);
        $name_user = $this->scape_string($name_user);
        $passSHA = sha1($pass_user);
        $hora = date("H:i");
        $idGenerate = substr(md5(microtime()), 1, 8);
        $selectAddUser = "INSERT INTO usuarios(nick_user, email_user, name_user, pass_user, activo, idActivo) VALUES ('$nick_user', '$email_user','$name_user','$passSHA','$hora','$idGenerate')";
        $id = $this->selectAdd($selectAddUser);

        if ($id) {
            $email = new Mail();
            $url = "http://cinexon.webhop.me/activar?code=$idGenerate";
            $email->activateAccount($url, $email_user);

            return $this->addList($id, "Mis Favoritas");
        } else {
            return false;
        }
    }

    function addFilm($title, $image, $sipnosis, $genero, $year, $format, $price, $duration, $adwards, $age, $trailer, $video, $directors, $actors, $cines, $horas, $tickets) {
        $title = $this->scape_string($title);
        $image = $this->scape_string($image);
        $sipnosis = $this->scape_string($sipnosis);
        $year = $this->scape_string($year);
        $format = $this->scape_string($format);
        $price = $this->scape_string($price);
        $duration = $this->scape_string($duration);
        $adwards = $this->scape_string($adwards);
        $age = $this->scape_string($age);
        $trailer = $this->scape_string($trailer);
        $video = $this->scape_string($video);
        $selectAddFilm = "INSERT INTO peliculas(title_movie, poster_movie, sinopsis_movie, year_movie, format_movie, price_movie, duration_movie, awards_movie, age_calification, trailer_movie, archive_url) VALUES ('$title', '$image', '$sipnosis', '$year', '$format', $price, $duration, $adwards, '$age', '$trailer','$video');";
        $id = $this->selectAdd($selectAddFilm);

        if ($id) {

            for ($x = 0; $x < count($genero); $x++) {
                $this->addGeneroToFilm($genero[$x], $id);
            }

            for ($x = 0; $x < count($directors); $x++) {
                $this->addDirectorToFilm($directors[$x], $id);
            }

            for ($x = 0; $x < count($actors); $x++) {
                $this->addActorsToFilm($id, $actors[$x]);
            }

            if ($format == "Taquilla") {

                $other = new OtherFunctions();
                $ticketsJSON = $other->createTicket($tickets);

                for ($x = 0; $x < count($cines); $x++) {
                    for ($i = 0; $i < count($horas); $i++) {
                        $this->addOfferToFilm($cines[$x], $id, $ticketsJSON, $horas[$i]);
                    }
                }
            }

            return $id;
        } else {
            return false;
        }
    }

    function addOfferToFilm($id_cinema, $id_movie, $tickets, $time) {
        $id_cinema = $this->scape_string($id_cinema);
        $id_movie = $this->scape_string($id_movie);
        $tickets = $this->scape_string($tickets);
        $time = $this->scape_string($time);
        $selectAddOfferToFilm = "INSERT INTO ofrece(id_cinema, id_movie, tickets, hora) VALUES ($id_cinema, $id_movie, '$tickets', '$time');";
        return $this->selectAdd($selectAddOfferToFilm);
    }

    function addDirectorToFilm($id_director, $id_film) {
        $id_director = $this->scape_string($id_director);
        $id_film = $this->scape_string($id_film);
        $selectAddDirectorToFilm = "INSERT INTO dirige(id_director, id_movie) VALUES ($id_director, $id_film);";
        return $this->selectAdd($selectAddDirectorToFilm);
    }

    function addGeneroToFilm($id_genero, $id_film) {
        $id_genero = $this->scape_string($id_genero);
        $id_film = $this->scape_string($id_film);
        $selectAddGeneroToFilm = "INSERT INTO tiene(id_movie, id_genre) VALUES ($id_film, $id_genero);";
        return $this->selectAdd($selectAddGeneroToFilm);
    }

    function addActorsToFilm($id_movie, $id_actor) {
        $id_movie = $this->scape_string($id_movie);
        $id_actor = $this->scape_string($id_actor);
        $selectAddActorsToFilm = "INSERT INTO participa(id_movie, id_actor) VALUES ($id_movie, $id_actor);";
        return $this->selectAdd($selectAddActorsToFilm);
    }

    function addDirector($name_director) {
        $name_director = $this->scape_string($name_director);
        $selectAddDirector = "INSERT INTO directores(name_director) VALUES ('$name_director');";
        return $this->selectAdd($selectAddDirector);
    }

    function addActor($name_actor) {
        $name_actor = $this->scape_string($name_actor);
        $selectAddActor = "INSERT INTO actores(name_actor) VALUES ('$name_actor');";
        return $this->selectAdd($selectAddActor);
    }

    function addCinema($name_cinema, $address_cinema) {
        $name_cinema = $this->scape_string($name_cinema);
        $address_cinema = $this->scape_string($address_cinema);
        $selectAddCinema = "INSERT INTO cines(address_cinema, name_cinema) VALUES ('$address_cinema', '$name_cinema');";
        return $this->selectAdd($selectAddCinema);
    }

    function addGenero($name_genero) {
        $name_genero = $this->scape_string($name_genero);
        $selectAddGenero = "INSERT INTO generos(name_genre) VALUES ('$name_genero');";
        return $this->selectAdd($selectAddGenero);
    }

    function addValorations($id_user, $id_movie, $valoration, $review) {
        $id_user = $this->scape_string($id_user);
        $id_movie = $this->scape_string($id_movie);
        $valoration = $this->scape_string($valoration);
        $review = $this->scape_string($review);
        $selectAddValorations = "INSERT INTO valora(id_user, id_movie, valoration, review) VALUES ($id_user, $id_movie, $valoration, '$review');";
        return $this->selectAdd($selectAddValorations);
    }

    function addList($id_user, $name_list) {
        $id_user = $this->scape_string($id_user);
        $name_list = $this->scape_string($name_list);
        $selectAddList = "INSERT INTO listas(id_user, name_list) VALUES ($id_user, '$name_list');";
        return $this->selectAdd($selectAddList);
    }

    function addFilmList($id_list, $id_movie) {
        $id_list = $this->scape_string($id_list);
        $id_movie = $this->scape_string($id_movie);
        $selectAddFilmList = "INSERT INTO almacena(id_list, id_movie) VALUES ($id_list, $id_movie);";
        return $this->selectAdd($selectAddFilmList);
    }

    function addBuyDigital($idMovie, $idUser) {
        $idMovie = $this->scape_string($idMovie);
        $idUser = $this->scape_string($idUser);
        $selectAddBuyDigital = "INSERT INTO compra_digital(id_movie, id_user) VALUES ($idMovie, $idUser);";
        return $this->selectAdd($selectAddBuyDigital);
    }

    function addBuyTickets($idMovie, $idUser, $ticketsBuy, $idCinema, $hora) {
        $idMovie = $this->scape_string($idMovie);
        $idUser = $this->scape_string($idUser);
        $idCinema = $this->scape_string($idCinema);
        $hora = $this->scape_string($hora);
        $ticketsBuy = json_encode($ticketsBuy);
        $selectAddBuyTickets = "INSERT INTO compra_tickets(id_movie, id_user, tickets_buy, id_cinema, hora_sesion) VALUES ($idMovie, $idUser, '$ticketsBuy', $idCinema, '$hora');";
        return $this->selectAdd($selectAddBuyTickets);
    }

    function addMessage($idTransmitter, $idReceiver, $message) {
        $idTransmitter = $this->scape_string($idTransmitter);
        $idReceiver = $this->scape_string($idReceiver);
        $message = $this->scape_string($message);
        $selectAddMessage = "INSERT INTO mensajea(id_transmitter, id_receiver, content_message) VALUES ($idTransmitter, $idReceiver, '$message');";
        return $this->selectAdd($selectAddMessage);
    }

    /* Fin Query Add */

    /* Query Delete */

    function selectDelete($select) {
        $this->connection_database();
        $query = $this->execution_query($select);
        $this->disconnect_database();

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function deleteGeneroFilm($id) {
        $id = $this->scape_string($id);
        $selectDeleteGeneroFilm = "DELETE FROM tiene WHERE id_movie=$id;";
        return $this->selectDelete($selectDeleteGeneroFilm);
    }

    function deleteActorsFilm($id) {
        $id = $this->scape_string($id);
        $selectDeleteActorsFilm = "DELETE FROM participa WHERE id_movie=$id;";
        return $this->selectDelete($selectDeleteActorsFilm);
    }

    function deleteDirectoresFilm($id) {
        $id = $this->scape_string($id);
        $selectDeleteDirectoresFilm = "DELETE FROM dirige WHERE id_movie=$id;";
        return $this->selectDelete($selectDeleteDirectoresFilm);
    }

    function deleteOfferFilm($id) {
        $id = $this->scape_string($id);
        $selectDeleteOfferFilm = "DELETE FROM ofrece WHERE id_movie=$id;";
        return $this->selectDelete($selectDeleteOfferFilm);
    }

    function deleteValoration($id_valoration) {
        $id_valoration = $this->scape_string($id_valoration);
        $selectDeleteValoration = "DELETE FROM valora WHERE id_valoration = $id_valoration;";
        return $this->selectDelete($selectDeleteValoration);
    }

    function deleteList($id) {
        $id = $this->scape_string($id);
        $selectDeleteList = "DELETE FROM listas WHERE id_list = $id;";
        return $this->selectDelete($selectDeleteList);
    }

    function deleteElementList($id) {
        $id = $this->scape_string($id);
        $selectDeleteElementList = "DELETE FROM almacena WHERE id_storage = $id;";
        return $this->selectDelete($selectDeleteElementList);
    }

    function deleteFilm($id) {
        $id = $this->scape_string($id);
        $selectDeleteFilm = "DELETE FROM peliculas WHERE id_movie = $id;";
        return $this->selectDelete($selectDeleteFilm);
    }

    function deleteDirector($id) {
        $id = $this->scape_string($id);
        $selectDeleteDirector = "DELETE FROM directores WHERE id_director = $id;";
        return $this->selectDelete($selectDeleteDirector);
    }

    function deleteActor($id) {
        $id = $this->scape_string($id);
        $selectDeleteActor = "DELETE FROM actores WHERE id_actor = $id;";
        return $this->selectDelete($selectDeleteActor);
    }

    function deleteCinema($id) {
        $id = $this->scape_string($id);
        $selectDeleteCinema = "DELETE FROM cines WHERE id_cinema = $id;";
        return $this->selectDelete($selectDeleteCinema);
    }

    function deleteGenero($id) {
        $id = $this->scape_string($id);
        $selectDeleteGenero = "DELETE FROM generos WHERE id_genre = $id;";
        return $this->selectDelete($selectDeleteGenero);
    }

    function deleteMessage($id) {
        $id = $this->scape_string($id);
        $selectDeleteGenero = "DELETE FROM mensajea WHERE id_message = $id;";
        return $this->selectDelete($selectDeleteGenero);
    }

    function deleteShopsDigital($id) {
        $id = $this->scape_string($id);
        $selectDeleteGenero = "DELETE FROM compra_digital WHERE id_user = $id;";
        return $this->selectDelete($selectDeleteGenero);
    }

    function deleteShopsTickets($id) {
        $id = $this->scape_string($id);
        $selectDeleteGenero = "DELETE FROM compra_tickets WHERE id_user = $id;";
        return $this->selectDelete($selectDeleteGenero);
    }

    function deleteUser($id) {
        $id = $this->scape_string($id);
        $selectDeleteUser = "DELETE FROM usuarios WHERE id_user = $id;";
        return $this->selectDelete($selectDeleteUser);
    }

    /* Fin Query Delete */

    /* Query Refresh */

    function selectRefresh($select) {
        $this->connection_database($select);

        $query = $this->execution_query($select);
        $afected = $this->afected_rows();
        $this->disconnect_database();

        if ($afected <= 0) {
            return false;
        } else {
            return true;
        }
    }

    function refreshFilm($id, $title, $image, $sipnosis, $genero, $year, $format, $price, $duration, $adwards, $age, $trailer, $video, $directors, $actors, $cines, $horas, $tickets) {
        $title = $this->scape_string($title);
        $image = $this->scape_string($image);
        $sipnosis = $this->scape_string($sipnosis);
        $year = $this->scape_string($year);
        $format = $this->scape_string($format);
        $price = $this->scape_string($price);
        $duration = $this->scape_string($duration);
        $adwards = $this->scape_string($adwards);
        $age = $this->scape_string($age);
        $trailer = $this->scape_string($trailer);
        $video = $this->scape_string($video);
        $selectRefreshFilm = "UPDATE peliculas SET title_movie='$title', poster_movie='$image', sinopsis_movie='$sipnosis', year_movie='$year', format_movie='$format', price_movie=$price, duration_movie=$duration, awards_movie=$adwards, age_calification='$age', trailer_movie='$trailer', archive_url='$video' WHERE id_movie=$id;";
        $query = $this->selectRefresh($selectRefreshFilm);

        if ($query) {
            $this->deleteGeneroFilm($id);
            for ($x = 0; $x < count($genero); $x++) {
                $this->addGeneroToFilm($genero[$x], $id);
            }

            $this->deleteDirectoresFilm($id);
            for ($x = 0; $x < count($directors); $x++) {
                $this->addDirectorToFilm($directors[$x], $id);
            }

            $this->deleteActorsFilm($id);
            for ($x = 0; $x < count($actors); $x++) {
                $this->addActorsToFilm($id, $actors[$x]);
            }

            $this->deleteOfferFilm($id);
            if ($format == "Taquilla") {

                $other = new OtherFunctions();
                $ticketsJSON = $other->createTicket($tickets);

                for ($x = 0; $x < count($cines); $x++) {
                    for ($i = 0; $i < count($horas); $i++) {
                        $this->addOfferToFilm($cines[$x], $id, $ticketsJSON, $horas[$i]);
                    }
                }
            }
        } else {
            return false;
        }
    }

    function refreshGenero($idGenero, $nameGenero) {
        $idGenero = $this->scape_string($idGenero);
        $nameGenero = $this->scape_string($nameGenero);
        $selectRefreshGenero = "UPDATE generos SET name_genre = '$nameGenero' WHERE id_genre = $idGenero;";
        return $this->selectRefresh($selectRefreshGenero);
    }

    function refreshDirector($idDirector, $nameDirector) {
        $idDirector = $this->scape_string($idDirector);
        $nameDirector = $this->scape_string($nameDirector);
        $selectRefreshDirector = "UPDATE directores SET name_director = '$nameDirector' WHERE id_director = $idDirector;";
        return $this->selectRefresh($selectRefreshDirector);
    }

    function refreshActor($idActor, $nameActor) {
        $idActor = $this->scape_string($idActor);
        $nameActor = $this->scape_string($nameActor);
        $selectArticleRefresh = "UPDATE actores SET name_actor = '$nameActor' WHERE id_actor = $idActor;";
        return $this->selectRefresh($selectArticleRefresh);
    }

    function refreshCinema($idCinema, $nameCinema, $addressCinema) {
        $idCinema = $this->scape_string($idCinema);
        $nameCinema = $this->scape_string($nameCinema);
        $addressCinema = $this->scape_string($addressCinema);
        $selectRefreshCinema = "UPDATE cines SET address_cinema = '$addressCinema', name_cinema = '$nameCinema' WHERE id_cinema = $idCinema;";
        return $this->selectRefresh($selectRefreshCinema);
    }

    function refreshTickets($tickets) {
        $selectRefreshTickets = "UPDATE ofrece SET tickets = '$tickets';";
        return $this->selectRefresh($selectRefreshTickets);
    }

    function refreshTicketsOffer($id, $tickets) {
        $id = $this->scape_string($id);
        $tickets = json_encode($tickets);
        $selectRefreshTicketsOffer = "UPDATE ofrece SET tickets = '$tickets' WHERE id_offer = $id;";
        return $this->selectRefresh($selectRefreshTicketsOffer);
    }

    function refreshUser($id, $role, $name, $pass, $age) {
        $id = $this->scape_string($id);
        $role = $this->scape_string($role);
        $name = $this->scape_string($name);
        $age = $this->scape_string($age);
        $selectRefreshUser = "UPDATE usuarios SET role_user='$role',name_user='$name',pass_user='$pass',age_user=$age WHERE id_user=$id";
        return $this->selectRefresh($selectRefreshUser);
    }

    function refreshUserPassword($id, $pass) {
        $id = $this->scape_string($id);
        $selectRefreshUserPassword = "UPDATE usuarios SET pass_user='$pass' WHERE id_user=$id";
        return $this->selectRefresh($selectRefreshUserPassword);
    }

    function changePassWord($email, $pass) {
        $email = $this->scape_string($email);
        $selectRefreshPassword = "UPDATE usuarios SET pass_user = '$pass' WHERE email_user = '$email';";
        return $this->selectRefresh($selectRefreshPassword);
    }

    function activateUser($id) {
        $id = $this->scape_string($id);
        $selectActivateUser = "UPDATE usuarios SET activo='activate', idActivo='NULL' WHERE activo != 'NULL' AND idActivo='$id'";
        return $this->selectRefresh($selectActivateUser);
    }

    /* Fin Query Refresh */

    /* Querys Exit */

    function selectExitElementBBDD($select) {
        $this->connection_database();

        $query = $this->execution_query($select);
        $result = $query->num_rows;
        $this->disconnect_database();

        if ($result <= 0) {
            return false;
        } else {
            return true;
        }
    }

    function exitFilmByName($nameFilm) {
        $nameFilm = $this->scape_string($nameFilm);
        $selectExitFilmByName = "SELECT * FROM peliculas WHERE title_movie = '$nameFilm';";
        return $this->selectExitElementBBDD($selectExitFilmByName);
    }

    function exitClientByEmail($email) {
        $email = $this->scape_string($email);
        $selectExitClientByEmail = "SELECT * FROM usuarios WHERE email_user='$email'";
        return $this->selectExitElementBBDD($selectExitClientByEmail);
    }

    function exitClientByNickName($email) {
        $email = $this->scape_string($email);
        $selectExitClientByNickName = "SELECT * FROM usuarios WHERE nick_user='$email'";
        return $this->selectExitElementBBDD($selectExitClientByNickName);
    }

    function exitListClient($id, $nameList) {
        $id = $this->scape_string($id);
        $nameList = $this->scape_string($nameList);
        $selectExitListClient = "SELECT * FROM listas WHERE id_user = $id AND name_list = '$nameList';";
        return $this->selectExitElementBBDD($selectExitListClient);
    }

    /* Fin Querys Exit */
}
