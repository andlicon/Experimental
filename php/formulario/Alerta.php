<?php
    /*
        Arroja una alerta con un texto determinado

        @param $mensaje es una cadena que contiene las indicaciones que se desea pasar al usuario
    */
    function alerta($mensaje) {
        echo
            "<script>
                var div = document.getElementById('alerta');
                div.innerHTML= '$mensaje';
                div.classList.add('formulario__alerta--activo');
            </script>";
    }
?>