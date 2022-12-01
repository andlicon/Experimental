<?php
    include_once(DAO_PATH.'/EstudianteDAO.php');

    include_once(DTO_PATH.'Usuario.php');

    include_once(GENERAL_PATH.'/Pagina.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-all']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);
        
        try {  
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

            $resultado = $estudianteDAO->getTodos();
            $pagina->actualizarPagina($resultado);
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            $pagina->imprimirMensaje(null, Mensaje::ERROR, $e->getMessage());
        }
    }
?>