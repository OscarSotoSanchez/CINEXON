<?php

include_once 'core/class/ControllersBase.php';
include_once 'core/class/OtherFunctions.php';
include_once 'models/Loadfilm_Model.php';
include_once 'core/class/Sessions.php';

class Loadfilm_Controller extends ControllersBase {

    public function view($id) {

        ob_start();

        $loadFilm = new Loadfilm_Model();
        $otherFunc = new OtherFunctions();
        $session = new Sessions();

        $film = $loadFilm->getFilm($id);
        if (!$film) {
            header('Location: peliculas');
        }

        $buy = $session->getBuyDigital($id);
        $moviesArray = $loadFilm->getRelated($id);
        $valorationArray = $loadFilm->getValoration($id);
        $valorationUser = $session->getValorationMovie($id);
        $lists = $loadFilm->getListsIfNotFilm($session->getConnectUser()->getId_user(), $id);
        $roleUser = $session->getConnectUser()->getRole_user();
        //$stockFilm = $film->getTickets_movie() - $session->getNumShop($id);       

        $buttonShop = true;
        if ($film->getFormat_movie() == "Digital") {
            if ($session->getNumShop($id) > 0) {
                $buttonShop = false;
            }
        } else {
            $taquillaArray = $loadFilm->getOfferAll($id);
        }

        include 'views/default/modules/loadFilm.php';
        $films = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $films, $page);

        $this->view_page($page);
    }

}
