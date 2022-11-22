<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/CuentaConsul.php');
    include_once('../formulario/GenerarOption.php');

    function optionCuenta() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new CuentaConsul($bd);

        $generador = new GenerarOption($consultor);
        $generador->generar();
    }
?>