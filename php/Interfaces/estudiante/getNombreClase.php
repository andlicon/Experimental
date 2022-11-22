<?php
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(DTO_PATH.'/Clase.php');

    function getNombreClase($idClase) {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $claseConsul = new ClaseConsul($bd);

        $clases = $claseConsul->getInstancia(array($idClase));

        $clase = $clases[0];
        
        return $clase->getDescripcion();
    }
?>