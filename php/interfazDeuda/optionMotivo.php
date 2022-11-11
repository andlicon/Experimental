<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/MotivoConsul.php');
    include_once('../formulario/GenerarOption.php');

    function optionMotivo() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new MotivoConsul($bd);

        $generador = new GenerarOption($consultor);
        $generador->generar();
    }
?>