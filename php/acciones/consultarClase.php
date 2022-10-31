<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../acciones/Consultar.php');
    include_once('../conexion/EstudianteDAO.php');

    function consultarClase($pagina, $claseId) {
        $objSerializar = "estudiantes";

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);
            
            $consultor = new Consultar($estudianteDAO, $pagina, $objSerializar);
            $consultor->consultar(array($claseId, null, null));
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }

?>