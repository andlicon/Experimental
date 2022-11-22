<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/TipoPagoConsul.php');
    include_once('../formulario/GenerarOption.php');

    function optionTipoPago() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new TipoPagoConsul($bd);

        $generador = new GenerarOption($consultor);
        $generador->generar();
    }
?>