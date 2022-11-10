<?php
    include_once('../conexion/ContactoDAO.php');
    include_once('../conexion/PersonaDAO.php');
    include_once('../general/Pagina.php');

    if( isset($_POST['eliminar']) ) {

        try {
            $pagina = new Pagina(Pagina::PERSONA);

            $cedulas = comprobarChecks(true, $pagina);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $contactoDAO = new ContactoDAO($bd);
            $personaDAO = new PersonaDAO($bd);

            for($i=0; $i<count($cedulas); $i++) {
                $cedula = $cedulas[$i];

                $personaDAO->eliminar(array($cedula));
                $contactoDAO->eliminarPorCedula(array($cedula));
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha eliminado exitosamente a la persona.");
        }
        catch(ExceptionSelect $e) {
            echo $e->imprimirError();
        }
        catch(PDOException $e) {
            $codigo = $e->getCode();

            if($codigo==23000) {
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Existe alguna dependencia que impide eliminar a la persona.");

                die();
            }
            
            echo $e;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>