<?php

class Exceptions {
    function enabled_exception() {
        function my_warning_handler() {
            throw new Exception();
        }

        set_error_handler("my_warning_handler");
    }
}
