<?php
    function formatoFecha($fecha) {
        $fechaSeparada = explode("-", $fecha);
        $anio = $fechaSeparada[0];
        $mes = $fechaSeparada[1];
        $dia = $fechaSeparada[2];

        return "$anio-$mes-$dia";
    }
?>