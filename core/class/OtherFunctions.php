<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OtherFunctions
 *
 * @author oscarsoto
 */
class OtherFunctions {

    function writeStart($starts) {
        $points = $starts;
        $html = "";

        for ($x = 0; $x < $points; $x++) {
            $html .= '<span class="glyphicon glyphicon-star"></span>';
        }

        $pointsEmpty = 5 - $points;
        for ($x = 0; $x < $pointsEmpty; $x++) {
            $html .= '<span class="glyphicon glyphicon-star-empty"></span>';
        }

        return $html;
    }

    function createTicket($numEntradas) {
        $arrayTickets = array();
        $filaArray = array();
        for ($x = 0; $x < $numEntradas; $x++) {
            if (($x != 0) && ($x % 10) == 0) {
                array_push($arrayTickets, $filaArray);
                $filaArray = array();
            }
            array_push($filaArray, array(0, 0));

            if ($x == ($numEntradas - 1)) {
                array_push($arrayTickets, $filaArray);
            }
        }
        
        return json_encode($arrayTickets);
    }

}
