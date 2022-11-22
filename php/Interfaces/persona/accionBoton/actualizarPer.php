<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(ROOT_PATH.'/general/Pagina.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = new Pagina(Pagina::PERSONA);
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $personaDAO = new PersonaDAO($bd);

                $resultado = $personaDAO->getTodos();

                $pagina->actualizarPagina($resultado);
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>