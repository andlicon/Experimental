<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/MotivoConsul.php');
    include_once(FORMULARIO_PATH.'GenerarOption.php');

    function optionMotivo() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new MotivoConsul($bd);

        $generador = new GenerarOption($consultor);
        $generador->generar();
    }
?>