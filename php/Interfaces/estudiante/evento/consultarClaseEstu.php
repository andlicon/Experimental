<?php
    include_once(GENERAL_PATH.'/Pagina.php');
    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-clase']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);
        
        try {
            $idClase = $_POST['claseInput'];

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

            $resultado = $estudianteDAO->getInstanciaClase(array($idClase));
            $pagina->actualizarPagina($resultado);
        }
        catch(Exception $e) {
            echo $e;
        }
        
    }
?>