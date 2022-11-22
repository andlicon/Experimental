<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoPagoConsul.php');

    include_once(FORMULARIO_PATH.'/GenerarOption.php');

    function optionTipoPago() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new TipoPagoConsul($bd);

        $generador = new GenerarOption($consultor);
        $generador->generar();
    }
?>