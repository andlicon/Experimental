<?php
    include_once('../conexion/RepresentanteConsul.php');
    include_once('../formulario/Alerta.php');
    include_once('../general/crearCedula.php');
    include_once('../acciones/Actualizar.php');

    $pagina = "Location: RepresentanteView.php";
    $objSerializar = "representantes";

    if( isset($_POST['actualizar']) ) {
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $representanteConsul = new RepresentanteConsul($bd);
                
                $actualizador = new Actualizar($representanteConsul, $pagina, $objSerializar);
                $actualizador->actualizar();
            }
            catch(Exception $e) {
                echo $e;
            }
    }
?>