<?php
    include_once('../formulario/Mensaje.php');
    include_once('mandarMensaje.php');

    function comprobarInput($keyInput, $mensaje, $pagina) {
        $input = $_POST[$keyInput];

        if(!$input || $input=="") {
            //Mandando error a la pagina
            $alerta = new Mensaje($keyInput, false, $mensaje);
            mandarMensaje($alerta, $pagina);
        }

        return $input;
    }
?>