<?php

class User {
    
    private $id_user;
    private $nick_user;
    private $email_user;
    private $role_user;
    private $name_user;
    private $pass_user;
    private $age_user;
    
    function __construct($id_user, $nick_user, $email_user, $role_user, $name_user, $pass_user, $age_user) {
        $this->id_user = $id_user;
        $this->nick_user = $nick_user;
        $this->email_user = $email_user;
        $this->role_user = $role_user;
        $this->name_user = $name_user;
        $this->pass_user = $pass_user;
        $this->age_user = $age_user;
    }
    
    function getId_user() {
        return $this->id_user;
    }

    function getNick_user() {
        return $this->nick_user;
    }

    function getEmail_user() {
        return $this->email_user;
    }

    function getRole_user() {
        return $this->role_user;
    }

    function getName_user() {
        return $this->name_user;
    }

    function getPass_user() {
        return $this->pass_user;
    }

    function getAge_user() {
        return $this->age_user;
    }

    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setNick_user($nick_user) {
        $this->nick_user = $nick_user;
    }

    function setEmail_user($email_user) {
        $this->email_user = $email_user;
    }

    function setRole_user($role_user) {
        $this->role_user = $role_user;
    }

    function setName_user($name_user) {
        $this->name_user = $name_user;
    }

    function setPass_user($pass_user) {
        $this->pass_user = $pass_user;
    }

    function setAge_user($age_user) {
        $this->age_user = $age_user;
    }
    
}
