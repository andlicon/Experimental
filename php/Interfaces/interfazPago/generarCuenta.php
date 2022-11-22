<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/CuentaConsul.php');

    include_once(FORMULARIO_PATH.'/GenerarOption.php');

    function optionCuenta() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new CuentaConsul($bd);

        $generador = new GenerarOption($consultor);
        $generador->generar();
    }
?>