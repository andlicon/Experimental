<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/PagoDAO.php');
    

    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'/deserializarUsuario.php');

    if( isset($_POST['consultar-rep']) ) {
        $pagina = new Pagina(Pagina::PAGO);

            try {
                //INPUTS
                $usuario = deserializarUsuario();
                $cedula = $usuario->getCedula();

                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $pagoDAO = new PagoDAO($bd);

                $resultado = $pagoDAO->getInstanciaCedulaValidez(array($cedula));

                $pagina->actualizarPagina($resultado);
            }
            catch(InputException $e) {
                $e->imprimirError();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());
            }
    }
?>