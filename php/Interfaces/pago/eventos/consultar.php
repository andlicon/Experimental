<?php
    include_once(DAO_PATH.'/PagoDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar']) ) {
        $pagina = new Pagina(Pagina::PAGO);

        try {  
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $pagoDAO = new PagoDAO($bd);

            $cedula = $_POST['representanteInput'];

            if($cedula=="todos") {
                $resultado = $pagoDAO->getTodos();
            }
            else {
                $resultado = $pagoDAO->getInstanciaCedula(array($cedula));
            }

            $pagina->actualizarPagina($resultado);
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());;
        }
    }
?>