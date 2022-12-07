<?php
    include_once(DAO_PATH.'/DeudaDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(EXCEPTION_PATH.'/InputException.php');

    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'deserializarUsuario.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar']) ) {
        $pagina = new Pagina(Pagina::DEUDA);

        try {  
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $deudaDAO = new DeudaDAO($bd);

            $cedula = $_POST['representanteInput'];

            if($cedula=="todos") {
                $resultado = $deudaDAO->getTodos();
            }
            else {
                $resultado = $deudaDAO->getInstanciaCedula(array($cedula));
            }

            $pagina->actualizarPagina($resultado);
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());;
        }
    }
?>