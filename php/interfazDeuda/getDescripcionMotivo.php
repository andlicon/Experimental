<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/MotivoConsul.php');

    function getDescripcionMotivo($idMotivo) {
        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $motivoConsul = new MotivoConsul($bd);

            $resultado = $motivoConsul->getInstancia(array($idMotivo));
            $motivo = $resultado[0];

            return $motivo->getDescripcion();
        }
        catch(Exception $e) {
            return null;
        }
    }
?>