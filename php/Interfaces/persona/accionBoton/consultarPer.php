<?php
    include_once(ROOT_PATH.'/conexion/PersonaDAO.php');
    include_once(ROOT_PATH.'/general/crearCedula.php');
    include_once(ROOT_PATH.'/general/comprobarInput.php');
    include_once(ROOT_PATH.'/general/Pagina.php');

    /*
        consulta única instancia para Representante
    */
    if( isset($_POST['consultar']) ) {
        $pagina = new Pagina(Pagina::PERSONA);

        try {   
            //Cedula introducida por el usuario
            $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
            $cedulaInput = comprobarInput('cedulaInput', $pagina);
            $cedula = crearCedula($nacionalidadInput, $cedulaInput);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $personaDAO = new PersonaDAO($bd);

            $resultado = $personaDAO->getInstancia(array ($cedula));
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