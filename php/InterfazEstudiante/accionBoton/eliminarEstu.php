<?php
    include_once('../conexion/EstudianteDAO.php');
    include_once('../acciones/EliminarEstudiante.php');

    if( isset($_POST['eliminar']) ) {
        if( isset($_POST['check']) ) {
        
            $checks = $_POST['check'];

            $pagina = "Location: estudianteView.php";

            try {   //Extraer informacion de la base de datos
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $estudianteDAO = new EstudianteDAO($bd);

                $eliminador = new EliminarEstudiante($estudianteDAO);

                for($i=0; $i<count($checks); $i++) {
                    $idEstudiante = $checks[$i];
                    $eliminador->eliminar(array($idEstudiante));
                }
    
                header($pagina);
            }
            catch(Exception $mensaje) {  
                alerta($mensaje);
            }
        }
    }

?>