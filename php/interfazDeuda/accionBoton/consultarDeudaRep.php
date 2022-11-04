<?php
    include_once('../conexion/DeudaDAO.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../acciones/Actualizar.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');
    include_once('../conexion/BaseDeDatos.php');

    if( isset($_POST['consultarCedula']) ) {
        $pagina = "Location: deudaView.php";
        $objSerializar = "deudas";
        
        $nacionalidadInput = comprobarInput('nacionalidadInput', 'Se debe introducir una nacionalidad valida', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', 'Se debe introducir un numero de cedula valido', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);

            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $deudaDAO = new DeudaDAO($bd);

                $resultado = $deudaDAO->getInstanciaCedula(array($cedula));
                $serialize = serialize($resultado);
                header($pagina.'?'.$objSerializar.'='.urlencode($serialize));
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>