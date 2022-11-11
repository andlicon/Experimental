<?php
    include_once('../conexion/ContactoDAO.php');
    include_once('../general/Pagina.php');
    include_once('../general/comprobarChecks.php');

    if( isset($_POST['eliminar']) ) {

        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        try {
            $pagina = new Pagina(Pagina::CONTACTO);

            $idsContactos = comprobarChecks(true, $pagina);

            $contactoDAO = new ContactoDAO($bd);

            for($i=0; $i<count($idsContactos); $i++) {
                $id = $idsContactos[$i];

                $contactoDAO->eliminar(array($id));
                $bd->guardarCambios();
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha eliminado exitosamente a la persona.");
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
        catch(Exception $e) {
            echo $e;
        }
    }
?>