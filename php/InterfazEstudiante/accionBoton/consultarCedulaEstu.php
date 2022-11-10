<?php
    include_once('../conexion/EstudianteDAO.php');
    include_once('../acciones/Consultar.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');

    /*
        Consulta estudiantes dependiendo de la clase.
    */
    if( isset($_POST['consultar-cedula']) ) {
        $pagina = "Location: estudianteView.php";
        $objSerializar = "estudiantes";
        
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $estudianteDAO = new EstudianteDAO($bd);

            $resultado = $estudianteDAO->getInstanciaCedula(array($cedula));
            $serialize = serialize($resultado);
            header($pagina.'?'.$objSerializar.'='.urlencode($serialize));
        }
        catch(Exception $e) {  //No se ha podido conectar a la bd
            echo $e;
        }
    }
?>

