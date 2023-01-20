<?php
    include_once('EliminarPago.php');
    include_once('EliminarUsuario.php');
    include_once('EliminarDeuda.php');

    if(isset($_POST['id']) && isset($_POST['pagina'])) {
        $id = $_POST['id'] ;
        $pagina = $_POST['pagina'];

        $eliminador = null;

        if(str_contains($pagina, "pago")) {
            $eliminador = new EliminarPago();
        }
        else if(str_contains($pagina, "usuario")) {
            $eliminador = new EliminarUsuario();
        }
        else if(str_contains($pagina, "deuda")) {
            $eliminador = new EliminarDeuda();
        }

        $respuesta = false;

        if($eliminador!=null){
            $eliminador->eliminar(array($id));
            $respuesta = true;
        }      

    }
?>