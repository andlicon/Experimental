<?php
    include_once('../acciones/Actualizar.php');
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ProfesorConsul.php');
    include_once('../general/Pagina.php');

    if( isset($_POST['actualizar']) ) {
        $pagina = new Pagina(Pagina::PROFESOR);
        
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $profConsul = new ProfesorConsul($bd);

                $resultado = $profConsul->getTodos();
                $pagina->actualizarPagina($resultado);
            }
            catch(Exception $e) {   //De no conectarse a la bd
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "No hay representante");
            }
    }
?>