<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteConsul.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');

    $pagina = "Location: RepresentanteView.php";

    if( isset($_POST['actualizar']) ) {
        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteConsul = new RepresentanteConsul($bd);
            $representanteConsul = $representanteConsul->getTodos();

            //Serializar el objeto para poderlo pasar a la vista resultado
            $serialize = serialize($representanteConsul);
            
            header("$pagina?representantes=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>