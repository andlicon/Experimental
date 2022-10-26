<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/EstudianteDAO.php');
    include_once('../general/crearCedula.php');
    include_once('../acciones/Actualizar.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = "Location: estudianteView.php";
        $objSerializar = "estudiantes";
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $estudianteDAO = new EstudianteDAO($bd);

                $actualizador = new Actualizar($estudianteDAO, $pagina, $objSerializar);
                $actualizador->actualizar();
            }
            catch(Exception $e) {   //De no conectarse a la bd
                echo $e;
            }
    }
?>