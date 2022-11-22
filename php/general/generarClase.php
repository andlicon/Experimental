<?php
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DTO_PATH.'/Clase.php');

    function generarClase($cedulaProf) {
        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $claseConsul = new ClaseConsul($bd);

            $resultado = $claseConsul->getInstanciaProfesor(array($cedulaProf));
            echo $resultado[0]->getDescripcion();
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>