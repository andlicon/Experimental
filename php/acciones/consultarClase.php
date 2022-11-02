<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../acciones/Consultar.php');
    include_once('../conexion/EstudianteDAO.php');

    function consultarClase($pagina, $claseId) {
        $objSerializar = "estudiantes";

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

            $resultado = $estudianteDAO->getInstanciaClase(array($claseId));
            $serialize = serialize($resultado);
            header($pagina.'?'.$objSerializar.'='.urlencode($serialize)."&idClase=$claseId");

        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            $alerta = new Mensaje(null, false, "No hay estudiantes en la clase");
            mandarMensaje($alerta, $pagina);
        }
    }

?>