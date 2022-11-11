<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ClaseConsul.php');
    include_once('../formulario/GenerarOption.php');

    function optionClases() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new ClaseConsul($bd);

        $generador = new GenerarOption($consultor);
        $generador->generar();
    }
?>