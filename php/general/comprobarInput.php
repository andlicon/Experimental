<?php
    include_once(EXCEPTION_PATH.'/InputException.php');

    function comprobarInput($keyInput, Pagina $pagina) {
        $input = $_POST[$keyInput];

        if(!$input || $input=="") {
            throw new InputException("Se debe introducir un $keyInput valido", $pagina);
        }

        return $input;
    }
?>