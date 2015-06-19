<?php

class loadControllers {

    public function __construct() {
        //Incluir todas las clases necesarias
        foreach (glob("controllers/*.php") as $file) {
            include_once $file;
        }
    }

    public function viewMainPage() {
        $main = new Loadmainpage_Controller();
        $main->view();
    }

    public function viewRegisterPage() {
        $register = new Loadregisterpage_Controller();
        $register->view();
    }

    public function viewRegisterPageMail($email) {
        $registerMail = new Loadregisterwithmail_Controller();
        $registerMail->view($email);
    }

    public function viewLoginMessage($message, $type) {
        $loginMessage = new Loadloginmesajepage_Controller();
        $loginMessage->view($message, $type);
    }

    public function viewFilm($id) {
        $film = new Loadfilm_Controller();
        $film->view($id);
    }

    public function viewFilms() {
        $films = new Loadfilms_Controller();
        $films->view();
    }

    public function viewFilmsValorated() {
        $films = new Loadfilmsmostrelated_Controller();
        $films->view();
    }

    public function viewModFilm($id) {
        $modFilm = new Loadmodfilm_Controller();
        $modFilm->view($id);
    }

    public function viewModGenero($id) {
        $modGenero = new Loadmodgenero_Controller();
        $modGenero->view($id);
    }

    public function viewModDirector($id) {
        $modDirector = new Loadmoddirector_Controller();
        $modDirector->view($id);
    }

    public function viewModActor($id) {
        $modActor = new Loadmodactor_Controller();
        $modActor->view($id);
    }

    public function viewModCinema($id) {
        $modCinema = new Loadmodcinema_Controller();
        $modCinema->view($id);
    }

    public function viewUsers() {
        $users = new Loadusers_Controller();
        $users->view();
    }

    public function viewUsersPag($id) {
        $userPag = new Loaduserspag_Controller();
        $userPag->view($id);
    }

    public function viewUsersSearch($word) {
        $usersSearch = new Loaduserssearch_Controller();
        $usersSearch->view($word);
    }

    public function viewStartPage($numLast, $numCartelera) {
        $films = new LoadStartPage_Controller();
        $films->view($numLast, $numCartelera);
    }

    public function viewSearchFilms($word = "") {
        $filmsSearch = new Loadfilmssearch_Controller();
        $filmsSearch->view($word);
    }

    public function viewSearchFilmsComplex($title, $genero, $director) {
        $filmsSearch = new LoadfilmsSearchComplex_Controller();
        $filmsSearch->view($title, $genero, $director);
    }

    public function viewShoppingCart() {
        $shoppingCart = new Loadshoppingcart_Controller();
        $shoppingCart->view();
    }

    public function viewShops() {
        $shops = new Loadshops_Controller();
        $shops->view();
    }

    public function viewChangePassword() {
        $changePass = new Loadchangepassword_Controller();
        $changePass->view();
    }

    public function viewSettings() {
        $settings = new Loadsettings_Controller();
        $settings->view();
    }

    public function viewSettingsAdmin() {
        $settingsAdmin = new Loadsettingsadmin_Controller();
        $settingsAdmin->view();
    }

    public function viewSettingsAdminNormal() {
        $settingsAdmin = new Loadsettingsadminnormal_Controller();
        $settingsAdmin->view();
    }

    public function viewSettingsMod() {
        $settingsMod = new Loadsettingsmod_Controller();
        $settingsMod->view();
    }

}
