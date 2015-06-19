<?php

/* Clase encargada de controlar la sesión del usuario y el carrito */

class Sessions {

    public function __construct() {
        $this->openSession();
    }

    /* Metodo encargado de hacer un session_start */

    private function openSession() {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /* Metodo que destruye la sesion y la cierra */

    private function closeSession() {
        $_SESSION = array();
        session_destroy();
    }

    /* Metodo encargado de comprobar si el usuario esta conectado y si es asi cierra la sesión */

    public function disconnectUser() {
        if (isset($_SESSION['user'])) {
            $this->deleteTicketsCartShop();
            $this->closeSession();
        }
    }

    /* Metodo encargado de almacenar en las variables de sesión el usuario conectado */

    public function connectUser($nickName, $pass) {
        $functionsDB = new FunctionsDB();

        //Descomentar lo siguiente para logeo local
        $user = $functionsDB->loginUser($nickName, $pass);
        //Descomentar lo siguiente para logeo con activacion
        //$user = $functionsDB->loginUserWidthActivate($nickName, $pass);

        if ($user !== false) {
            $_SESSION['user'] = $user;
            $_SESSION['shoppingCart'] = array();
            return true;
        } else {
            $this->closeSession();
            return false;
        }
    }

    public function reloadUser() {
        $functionsDB = new FunctionsDB();

        $user = $functionsDB->getUserID($this->getConnectUser()->getId_user());
        $_SESSION['user'] = $user;
    }

    /* Metodo que devuelve el usuario conectado */

    public function getConnectUser() {
        return $_SESSION['user'];
    }

    /* Metodo que devuelve true o false, dependiendo si hay un usuario conectado o no */

    public function isUserConnected() {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getValorationMovie($id_movie) {
        $functionsDB = new FunctionsDB();

        return $functionsDB->getNoteByUser($this->getConnectUser()->getId_user(), $id_movie);
    }

    public function getLists() {
        $functionsDB = new FunctionsDB();

        return $functionsDB->getListUser($this->getConnectUser()->getId_user());
    }

    public function getBuys() {
        $functionsDB = new FunctionsDB();

        return $functionsDB->getAllBuyFilms($this->getConnectUser()->getId_user());
    }

    public function getBuyDigital($id) {
        $functionsDB = new FunctionsDB();

        return $functionsDB->getBuyFilmDigital($id, $this->getConnectUser()->getId_user());
    }

    public function getMessages() {
        $functionsDB = new FunctionsDB();

        return $functionsDB->getMessages($this->getConnectUser()->getId_user());
    }

    /* Metodo encargado de añadir una compra al carrito */

    public function addShoppingCart($codFilm, $numShoppings, $ticketsOffer = array(0, "", "")) {
        $exits = false;

        for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
            if ($_SESSION['shoppingCart'][$x][0]->getId_movie() == $codFilm && $_SESSION['shoppingCart'][$x][2][0] == $ticketsOffer[0] && $_SESSION['shoppingCart'][$x][2][2] == $ticketsOffer[2]) {
                $exits = true;

                for ($i = 0; $i < count($ticketsOffer[1]); $i++) {
                    array_push($_SESSION['shoppingCart'][$x][2][1], $ticketsOffer[1][$i]);
                }

                $_SESSION['shoppingCart'][$x][1] += $numShoppings;
                break;
            }
        }

        if (!$exits) {
            $functionsDB = new FunctionsDB();
            $film = $functionsDB->getFilmsID($codFilm);

            if ($film->getFormat_movie() == "Digital") {
                array_push($_SESSION['shoppingCart'], array($film, $numShoppings));
            } else {
                array_push($_SESSION['shoppingCart'], array($film, $numShoppings, $ticketsOffer, substr(md5(microtime()), 1, 8)));
            }
        }
    }

    /* Metodo encargado de eliminar una compra del carrito */

    public function deleteElementShoppingCart($codFilm, $idGenerate = "") {
        $newArray = array();

        for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
            if ($_SESSION['shoppingCart'][$x][0]->getId_movie() != $codFilm) {
                array_push($newArray, $_SESSION['shoppingCart'][$x]);
            } else {
                if ($_SESSION['shoppingCart'][$x][0]->getFormat_movie() != "Digital") {
                    if ($_SESSION['shoppingCart'][$x][3] == $idGenerate) {
                        $this->modTickets($x, 0);
                    } else {
                        array_push($newArray, $_SESSION['shoppingCart'][$x]);
                    }
                }
            }
        }

        $_SESSION['shoppingCart'] = $newArray;

        if (count($newArray) < count($_SESSION['shoppingCart'])) {
            return true;
        } else {
            return false;
        }
    }

    public function modTickets($idShop, $numNew) {
        $functionsDB = new FunctionsDB();
        $ticketsOffer = $_SESSION['shoppingCart'][$idShop][2];

        $offer = $functionsDB->getOfferByCinemaHora($_SESSION['shoppingCart'][$idShop][0]->getId_Movie(), $ticketsOffer[0], $ticketsOffer[2]);
        $tickets = $ticketsOffer[1];
        $newTickets = $offer->getTickets();

        for ($i = 0; $i < count($tickets); $i++) {
            if ($numNew == 0) {
                $arrayNew = array(0, 0);
            } else {
                $arrayNew = array($numNew, $newTickets[$tickets[$i][0]][$tickets[$i][1]][1]);
            }
            $newTickets[$tickets[$i][0]][$tickets[$i][1]] = $arrayNew;
        }

        $functionsDB->refreshTicketsOffer($offer->getId_offer(), $newTickets);
    }

    public function deleteTicketsCartShop() {
        for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
            if ($_SESSION['shoppingCart'][$x][0]->getFormat_movie() != "Digital") {
                $this->modTickets($x, 0);
            }
        }
    }

    /* Metodo que devuelve las veces que se han comprado un articulo, del carrito */

    public function getNumShop($codFilm) {
        $numShop = 0;

        if (isset($_SESSION['shoppingCart'])) {
            for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
                if ($_SESSION['shoppingCart'][$x][0]->getId_movie() == $codFilm) {
                    $numShop = $_SESSION['shoppingCart'][$x][1];
                    break;
                }
            }
        }

        return $numShop;
    }

    public function checkTickets() {
        $functionsDB = new FunctionsDB();
        $newArray = array();

        for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
            $ticketsRenew = false;

            if ($_SESSION['shoppingCart'][$x][0]->getFormat_movie() != "Digital") {
                $ticketsOffer = $_SESSION['shoppingCart'][$x][2];

                $offer = $functionsDB->getOfferByCinemaHora($_SESSION['shoppingCart'][$x][0]->getId_Movie(), $ticketsOffer[0], $ticketsOffer[2]);
                $tickets = $ticketsOffer[1];
                $ticketsFilm = $offer->getTickets();

                for ($i = 0; $i < count($tickets); $i++) {
                    if ($ticketsFilm[$tickets[$i][0]][$tickets[$i][1]][0] == 0) {
                        $ticketsRenew = true;
                        break;
                    }
                }
            }

            if (!$ticketsRenew) {
                array_push($newArray, $_SESSION['shoppingCart'][$x]);
            }
        }

        if (count($newArray) != count($_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'] = $newArray;
            return true;
        } else {
            return false;
        }
    }

    /* Metodo encargado del pago, actualiza la BBDD una vez realizado el pago y elimina el carro */

    public function cartPay() {
        $functionsDB = new FunctionsDB();
        $shops = array();

        for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
            if ($_SESSION['shoppingCart'][$x][0]->getFormat_movie() != "Digital") {
                $this->modTickets($x, 2);
                $idShop = $functionsDB->addBuyTickets($_SESSION['shoppingCart'][$x][0]->getId_movie(), $this->getConnectUser()->getId_user(), $_SESSION['shoppingCart'][$x][2][1], $_SESSION['shoppingCart'][$x][2][0], $_SESSION['shoppingCart'][$x][2][2]);
                array_push($shops, array($_SESSION['shoppingCart'][$x], $idShop, $_SESSION['shoppingCart'][$x][2]));
            } else {
                $idShop = $functionsDB->addBuyDigital($_SESSION['shoppingCart'][$x][0]->getId_movie(), $this->getConnectUser()->getId_user());
                array_push($shops, array($_SESSION['shoppingCart'][$x], $idShop));
            }
        }

        $_SESSION['shoppingCart'] = array();
        return $shops;
    }

    /* Metodo que devuelve el carrito */

    public function getShoppingCart() {
        return $_SESSION['shoppingCart'];
    }

    /* Metodo que devuelve el número de elementos actual del carrito */

    public function getTotalShoppings() {
        $sumTotal = 0;

        for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
            $sumTotal += $_SESSION['shoppingCart'][$x][1];
        }

        return $sumTotal;
    }

    /* Metodo de devuelve el precio total de los elementos del carrito */

    public function getTotalPriceShoppings() {
        $sumTotal = 0;

        for ($x = 0; $x < count($_SESSION['shoppingCart']); $x++) {
            $sumTotal += ($_SESSION['shoppingCart'][$x][0]->getPrice_movie() * $_SESSION['shoppingCart'][$x][1]);
        }

        return $sumTotal;
    }

}
