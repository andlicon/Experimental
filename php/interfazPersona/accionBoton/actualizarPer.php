<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/PersonaDAO.php');
    include_once('../acciones/Actualizar.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = "Location: personaView.php";
        $objSerializar = "personas";
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $personaDAO = new PersonaDAO($bd);

                $actualizador = new Actualizar($personaDAO , $pagina, $objSerializar);
                $actualizador->actualizar();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>