<?php
    include_once('../acciones/consultarClase.php');
    include_once('../general/Pagina.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-clase']) ) {
        $pagina = new Pagina(Pagina::CLASE);

        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

            $resultado = $estudianteDAO->getInstanciaClase(array($idClase));

            $pagina->actualizarPagina($resultado);
        }
        catch(Exception $e) {
            
        }
    }
?>