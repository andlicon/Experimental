<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/DeudaDAO.php');
    
    include_once('../general/crearCedula.php');
    include_once('../general/comprobarInput.php');
    include_once('../general/crearCedula.php');

    if( isset($_POST['cobrar']) ) {
        $pagina = "Location: deudaView.php";
        $objSerializar = "deudas";

        $monto = 60;

            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $bd->procedure("CALL cobrar_mensualidad(NOW(), $monto);", null);

                header($pagina);
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>