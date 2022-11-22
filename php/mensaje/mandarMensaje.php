<?php
    function mandarMensaje($mensaje, $pagina) {
        $serialize = serialize($mensaje);
        if(str_contains($pagina, "?")) {
            header("$pagina&mensaje=".urlencode($serialize));
        }
        else {
            header("$pagina?mensaje=".urlencode($serialize));
        }
        die();
    }
?>