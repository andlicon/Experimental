<?php
    include_once('../conexion/DeudaDAO.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../acciones/Actualizar.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');
    include_once('../conexion/BaseDeDatos.php');

    if( isset($_POST['consultarDeudor']) ) {
        $pagina = "Location: deudaView.php";
        $objSerializar = "deudas";

            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $deudaDAO = new DeudaDAO($bd);

                $resultado = $deudaDAO->getDeudores();
                $serialize = serialize($resultado);
                header($pagina.'?'.$objSerializar.'='.urlencode($serialize));
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>