<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteConsul.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
/*
    consulta única instancia para Representante
*/
    if( isset($_POST['consultarInstancia']) ) {
        //Cedula introducida por el usuario
        $cedula = crearCedula('nacionalidad-consulta', 'cedula-consulta');

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteConsul = new RepresentanteConsul($bd);
            $representante = $representanteConsul->getInstancia(array($cedula));

            //Serializar el objeto representante para poderlo enviar a la view resultado
            $serialize = serialize(array($representante));
            header("Location: RepresentanteView.php?representantes=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>




