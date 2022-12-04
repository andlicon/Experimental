<?php
    include_once(DAO_PATH.'/ContactoDAO.php');
    include_once(DAO_PATH.'/UsuarioDAO.php');

    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'/comprobarChecks.php');

    if( isset($_POST['eliminar']) ) {

        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        try {
            $pagina = new Pagina(Pagina::USUARIOS);

            $cedulas = comprobarChecks(false, $pagina);

            $usuarioDAO = new UsuarioDAO($bd);
            $resultado = $usuarioDAO->getInstancia($cedulas);
            $usuario = $resultado[0];

            if($usuario->getValido()) {
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Para eliminar a un usuario, este debe ser inválido.");
                die();
            }

            $usuarioDAO->eliminar($cedulas);
            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha eliminado exitosamente al usuario.");
        }
        catch(SelectException $e) {
            $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());
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