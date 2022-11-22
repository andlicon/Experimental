<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/ContactoDAO.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = new Pagina(Pagina::CONTACTO);
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $contactoDAO = new ContactoDAO($bd);

                $resultado = $contactoDAO->getTodos();

                $pagina->actualizarPagina($resultado);
            }
            catch(Exception $e) {   //De no conectarse a la bd
                $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());
            }
    }
?>