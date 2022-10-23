<?php
    function mandarMensaje($mensaje, $pagina) {
        $serialize = serialize($mensaje);
        header("$pagina?mensaje=".urlencode($serialize));
        die();
    }
?>