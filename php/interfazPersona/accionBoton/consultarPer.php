<?php
    include_once('../conexion/PersonaDAO.php');
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/Pagina.php');

    /*
        consulta única instancia para Representante
    */
    if( isset($_POST['consultar']) ) {
        $pagina = new Pagina(Pagina::PERSONA);
        
        //Cedula introducida por el usuario
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try {   
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $personaDAO = new PersonaDAO($bd);

            $resultado = $personaDAO->getInstancia(array ($cedula));
            $pagina->actualizarPagina($resultado);
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }
?>




