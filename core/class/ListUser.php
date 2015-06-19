<?php

class ListUser {

    private $id_list;
    private $id_user;
    private $name_list;
    private $elements_lists = array();

    function __construct($id_list, $id_user, $name_list) {
        $this->id_list = $id_list;
        $this->id_user = $id_user;
        $this->name_list = $name_list;       
    }

    function getId_list() {
        return $this->id_list;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getName_list() {
        return $this->name_list;
    }
    
    function getElementsList(){
        $this->setElementsList();
        
        return $this->elements_lists;
    }

    function setId_list($id_list) {
        $this->id_list = $id_list;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setName_list($name_list) {
        $this->name_list = $name_list;
    }

    function setElementsList() {
        $functionDB = new FunctionsDB();

        $elementsLists = $functionDB->getListElements($this->id_list);
        $this->elements_lists = $elementsLists;
    }

}
