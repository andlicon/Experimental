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
            $representanteDAO = new RepresentanteDAO();
            $representante = $representanteDAO->getInstancia(array($cedula));
            return $representante;
        }
        catch(Exception $e) {  
            $representante = 'no existe el representante';
            alerta($mensaje);
        }
    }
?>