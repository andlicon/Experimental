<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');
    
    include_once(GENERAL_PATH.'/Pagina.php');

    if( isset($_POST['consultarDeudor']) ) {
        $pagina = new Pagina(Pagina::DEUDA);

            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $deudaDAO = new DeudaDAO($bd);

                $resultado = $deudaDAO->getDeudores();
                
                $pagina->actualizarPagina($resultado);
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>