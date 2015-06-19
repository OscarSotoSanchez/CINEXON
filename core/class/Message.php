<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Messages
 *
 * @author oscarsoto
 */
class Message {
    private $id_message;
    private $id_transmitter;
    private $id_receiver;
    private $content_message;
    private $user_transmitter;
    
    function __construct($id_message, $id_transmitter, $id_receiver, $content_message) {
        $this->id_message = $id_message;
        $this->id_transmitter = $id_transmitter;
        $this->id_receiver = $id_receiver;
        $this->content_message = $content_message;
        
    }
    
    function getId_message() {
        return $this->id_message;
    }

    function getId_transmitter() {
        return $this->id_transmitter;
    }

    function getId_receiver() {
        return $this->id_receiver;
    }

    function getContent_message() {
        return $this->content_message;
    }

    function getUser_transmitter() {
        $this->setUser_transmitter();
        
        return $this->user_transmitter;
    }

    function setId_message($id_message) {
        $this->id_message = $id_message;
    }

    function setId_transmitter($id_transmitter) {
        $this->id_transmitter = $id_transmitter;
    }

    function setId_receiver($id_receiver) {
        $this->id_receiver = $id_receiver;
    }

    function setContent_message($content_message) {
        $this->content_message = $content_message;
    }

    function setUser_transmitter() {
        $functionDB = new FunctionsDB();
        
        $user_transmitter = $functionDB->getUserID($this->id_transmitter);
        $this->user_transmitter = $user_transmitter;
    }

}
