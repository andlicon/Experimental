<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteDAO.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');

    if( isset($_POST['consultarTodos']) ) {
        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteDAO = new RepresentanteDAO($bd);
            $representantes = $representanteDAO->getTodos();

            //REPRESENTANTES ES UN ARREGLO DE REPRESENTANTES, VER QUÉ HACER CON ESO
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>