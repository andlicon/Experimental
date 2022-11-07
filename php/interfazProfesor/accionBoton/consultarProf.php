<?php
    include_once('../acciones/Actualizar.php');
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ProfesorConsulta.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');
    include_once('../acciones/Consultar.php');

    if( isset($_POST['consultar']) ) {
        $pagina = "Location: profesorView.php";
        $objSerializar = "profesores";
        
        //Cedula introducida por el usuario
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $profConsul = new ProfesorConsulta($bd);

                $consultor = new Consultar($profConsul, $pagina, $objSerializar);
                $consultor->consultar(array($cedula));
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>