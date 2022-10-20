<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteDAO.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
/*
    consulta única instancia para Representante
*/
    if( isset($_POST['cargar']) ) {
        //Cedula introducida por el usuario
        $cedula = crearCedula('nacionalidad-cargar', 'cedula-cargar');
        $nombre = $_POST['nombre-cargar'];
        $apellido = $_POST['cedula-cargar'];
        $correo = $_POST['correo-cargar'];


        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteDAO = new RepresentanteDAO($bd);

            
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>