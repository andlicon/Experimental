<?php
    include_once(DAO_PATH.'/EstudianteDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(EXCEPTION_PATH.'/InputException.php');

    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');
    include_once(GENERAL_PATH.'deserializarUsuario.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-rep']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);

        try {  
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

            $usuario = deserializarUsuario();
            $cedula = $usuario->getCedula();

            $resultado = $estudianteDAO->getInstanciaCedula(array($cedula));
            $pagina->actualizarPagina($resultado);
        }
        catch(InputException $e) {
            $e->imprimirError();
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }
?>