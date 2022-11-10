<?php
    include_once('../conexion/ClaseConsul.php');
    include_once('../conexion/BaseDeDatos.php');
    include_once('../instancias/Clase.php');

    function getNombreClase($idClase) {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $claseConsul = new ClaseConsul($bd);

        $clases = $claseConsul->getInstancia(array($idClase));

        $clase = $clases[0];
        
        return $clase->getDescripcion();
    }
?>