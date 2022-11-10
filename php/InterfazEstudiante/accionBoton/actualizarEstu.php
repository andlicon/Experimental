<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/EstudianteDAO.php');
    include_once('../general/Pagina.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $estudianteDAO = new EstudianteDAO($bd);
        
                $resultado = $estudianteDAO->getTodos();
                $pagina->actualizarPagina($resultado);
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>