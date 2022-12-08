<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');
    
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    if( isset($_POST['consultar-rep']) ) {
        $pagina = new Pagina(Pagina::DEUDA);

            try {
                //INPUTS
                $usuario = deserializarUsuario();
                $cedula = $usuario->getCedula();

                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $deudaDAO = new DeudaDAO($bd);

                $resultado = $deudaDAO->getInstanciaCedula(array($cedula));

                $pagina->actualizarPagina($resultado);
            }
            catch(InputException $e) {
                $e->imprimirError();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>