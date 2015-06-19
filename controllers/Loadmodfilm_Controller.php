<?php

include_once 'core/class/ControllersBase.php';
include_once 'models/Loadmodfilm_Model.php';

class Loadmodfilm_Controller extends ControllersBase {

    public function view($id) {

        ob_start();

        $loadModFilm = new Loadmodfilm_Model();
        $film = $loadModFilm->getFilm($id);
        $directors = $loadModFilm->getDirectors($id);
        $actors = $loadModFilm->getActors($id);
        $generos = $loadModFilm->getGeneros($id);
        $cinemas = $loadModFilm->getCinemas($id);
        $tickets = 20;
        
        if($film->getFormat_movie() == "Taquilla"){
            $offers = $loadModFilm->getOffer($id);
            $ticketsOffer = $offers[0]->getTickets();
            $numTickets = 0;
            
            for($x=0; $x < count($ticketsOffer); $x++){
                $numTickets += count($ticketsOffer[$x]);
            }
            
            $tickets = $numTickets;
        }
        
        include 'views/default/modules/loadModFilm.php';
        $film = ob_get_clean();

        $page = $this->load_template_normal("layoutFilmFondo");
        $page = $this->replace_content('/\#CONTENT\#/ms', $film, $page);

        $this->view_page($page);
    }

}
