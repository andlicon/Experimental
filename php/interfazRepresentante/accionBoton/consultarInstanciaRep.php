<?php
    include_once('../instancias/Representante.php');
    include_once('../conexion/RepresentanteConsul.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');

    /*
        consulta única instancia para Representante
    */
    $pagina = "Location: RepresentanteView.php";

    if( isset($_POST['consultar']) ) {
        //Cedula introducida por el usuario
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteConsul = new RepresentanteConsul($bd);
            $representante = $representanteConsul->getInstancia(array($cedula));
            
            //Serializar el objeto representante para poderlo enviar a la view resultado
            $serialize = serialize(array($representante));
            header("$pagina?representantes=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>




