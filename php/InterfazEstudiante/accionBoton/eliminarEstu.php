<?php
    include_once('../conexion/EstudianteDAO.php');
    include_once('../general/Pagina.php');
    include_once('../general/comprobarChecks.php');

    if( isset($_POST['eliminar']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);

        /*
            ! esto deberia estar dentro de un try, o buscar una mejor forma de hacerlo.
        */
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        try {
            $idsEstudiante = comprobarChecks(true, $pagina);
            $estudianteDAO = new EstudianteDAO($bd);

            for($i=0; $i<count($idsEstudiante); $i++) {
                $id = $idsEstudiante[$i];
                $estudianteDAO->eliminar(array($id));
                $bd->guardarCambios();
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha eliminado exitosamente a los estudiantes.");
        }
        catch(ExceptionSelect $e) {
            echo $e->imprimirError();
        }
        catch(PDOException $e) {
            $codigo = $e->getCode();

            if($codigo==23000) {
                $bd->revertirCambios();
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Existe alguna dependencia que impide eliminar a la persona.");

                die();
            }
            
            echo $e;
        }
    }
?>