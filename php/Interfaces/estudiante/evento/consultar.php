<?php
    include_once(DAO_PATH.'/EstudianteDAO.php');

    include_once(DTO_PATH.'Usuario.php');

    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'deserializarUsuario.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);
        
        try {  
            $usuario = deserializarUsuario();
            $cedula = $usuario->getCedula();

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

            $resultado = $estudianteDAO->getInstanciaCedula(array($cedula));
            $pagina->actualizarPagina($resultado);
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }
?>