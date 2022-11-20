<?php
    include_once('../conexion/ClaseConsul.php');
    include_once('../instancias/Clase.php');

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