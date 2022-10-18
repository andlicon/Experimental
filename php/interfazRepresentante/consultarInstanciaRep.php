<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteDAO.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
/*
    consulta única instancia para Representante
*/
    if( isset($_POST['consultarInstancia']) ) {
        //Cedula introducida por el usuario
        $cedula = crearCedula();

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteDAO = new RepresentanteDAO($bd);
            $representante = $representanteDAO->getInstancia(array($cedula));

            echo $representante->getCedula();

            $serialize = serialize(array($representante));
            header("Location: resultadoConsultaRep.php?representantes=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>




