<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/DeudaDAO.php');
    
    include_once('../general/Pagina.php');

    if( isset($_POST['cobrar']) ) {
        $pagina = new Pagina(Pagina::DEUDA);

        $monto = 60;

            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $bd->procedure("CALL cobrar_mensualidad(NOW(), $monto);", null);

                $bd->guardarCambios();
                $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se cobro la mensualidad con exito.");
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>