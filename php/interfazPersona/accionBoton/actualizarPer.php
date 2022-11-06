<?php
    include_once('../conexion/PersonaContactoConsulta.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../acciones/Actualizar.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = "Location: personaView.php";
        $objSerializar = "personas";
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $persoConsulta = new PersonaContactoConsulta($bd);

                $actualizador = new Actualizar($persoConsulta , $pagina, $objSerializar);
                $actualizador->actualizar();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>