<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoContactoConsul.php');

    function getDescripcionContacto($idMotivo) {
        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $tipoConsul = new TipoContactoConsul($bd);

            $resultado = $tipoConsul->getInstancia(array($idMotivo));
            $tipo = $resultado[0];

            return $tipo->getDescripcion();
        }
        catch(Exception $e) {
            return null;
        }
    }
?>