<?php
    include_once('../conexion/EstudianteDAO.php');
    include_once('../excepciones/InputException.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');
    include_once('../general/Pagina.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-cedula']) ) {
        $pagina = new Pagina(Pagina::ESTUDIANTE);

        try {  
            $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
            $cedulaInput = comprobarInput('cedulaInput', $pagina);
            $cedula = crearCedula($nacionalidadInput, $cedulaInput);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

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

