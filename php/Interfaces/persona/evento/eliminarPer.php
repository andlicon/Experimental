<?php
    include_once(DAO_PATH.'/ContactoDAO.php');
    include_once(DAO_PATH.'/PersonaDAO.php');

    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'/comprobarChecks.php');

    if( isset($_POST['eliminar']) ) {

        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        try {
            $pagina = new Pagina(Pagina::PERSONA);

            $cedulas = comprobarChecks(true, $pagina);

            $contactoDAO = new ContactoDAO($bd);
            $personaDAO = new PersonaDAO($bd);

            for($i=0; $i<count($cedulas); $i++) {
                $cedula = $cedulas[$i];

                $personaDAO->eliminar(array($cedula));
                $contactoDAO->eliminarPorCedula(array($cedula));
                $bd->guardarCambios();
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha eliminado exitosamente a la persona.");
        }
        catch(SelectException $e) {
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
        catch(Exception $e) {
            echo $e;
        }
    }
?>