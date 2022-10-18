<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteDAO.php');
    include_once('../formulario/Alerta.php');



    if( isset($_POST['buscar']) ) {
        //Cedula introducida por el usuario
        $inputNacionalidad = $_POST['nacionalidad'];
        $inputCedula =  $_POST['cedula'];
        $cedula = $inputNacionalidad.$inputCedula;

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteDAO = new RepresentanteDAO($bd);
            $representante = $representanteDAO->getInstancia(array($cedula));
            echo 'cedula'.$representante->getCedula();
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>