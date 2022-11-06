<?php
    include_once('../acciones/Actualizar.php');
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ProfesorConsulta.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = "Location: profesorView.php";
        $objSerializar = "profesores";
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $profConsul = new ProfesorConsulta($bd);

                $actualizador = new Actualizar($profConsul, $pagina, $objSerializar);
                $actualizador->actualizar();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>