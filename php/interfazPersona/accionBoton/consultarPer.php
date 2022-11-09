<?php
    include_once('../conexion/PersonaDAO.php');
    include_once('../acciones/Consultar.php');
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');

    /*
        consulta única instancia para Representante
    */
    if( isset($_POST['consultar']) ) {
        $pagina = "Location: personaView.php";
        $objSerializar = "personas";
        
        //Cedula introducida por el usuario
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $personaDAO = new PersonaDAO($bd);

            $consultor = new Consultar($personaDAO, $pagina, $objSerializar);
            $consultor->consultar(array($cedula));
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }
?>




