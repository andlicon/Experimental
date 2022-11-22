<?php
    include_once(DAO_PATH.'/DeudaDAO.php');

    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'/comprobarChecks.php');

    if( isset($_POST['eliminar']) ) {
        $pagina = new Pagina(Pagina::DEUDA);

        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        try {
            $deudaDAO = new DeudaDAO($bd);

            $idsDeudas = comprobarChecks(true, $pagina);

            for($i=0; $i<count($idsDeudas); $i++) {
                $idDeuda = $idsDeudas[$i];

                $deudaDAO->eliminar(array($idDeuda));
                $bd->guardarCambios();
            }

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha eliminado exitosamente las deudas.");
        }
        catch(SelectException $e) {
           $e->imprimirError();
        }
        catch(PDOException $e) {
            $codigo = $e->getCode();

            if($codigo==23000) {
                $bd->revertirCambios();
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Existe alguna dependencia que impide eliminar a la deuda.");

                die();
            }
            
            echo $e;
        }
        catch(Exception $e) {  
            echo($e);
        }
    }
?>