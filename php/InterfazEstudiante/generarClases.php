<?php
    include_once('../instancias/Clase.php');
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ClaseConsul.php');

    function generarClases() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
        $consultor = new ClaseConsul($bd);
        echo 'a';
        $clases = $consultor->getTodos();

        for($i=0; $i<count($clases); $i++) {
            $clase = $clases[$i];
            $idClase = $clase->getId();
            $descripcionClase = $clase->getDescripcion();
            echo 
                "
                    <option value=\"$idClase\">$descripcionClase</option>
                ";
        }
    }
?>