<?php
    include_once('EliminarPago.php');
    include_once('EliminarUsuario.php');

    if(isset($_POST['id']) && isset($_POST['pagina'])) {
        $id = $_POST['id'] ;
        $pagina = $_POST['pagina'];

        $eliminador;

        if(str_contains($pagina, "pago")) {
            $eliminador = new EliminarPago();
        }
        else if(str_contains($pagina, "usuario")) {
            $eliminador = new EliminarUsuario();
        }

        $respuesta = false;

        if($eliminador!=null){
            $eliminador->eliminar(array($id));
            $respuesta = true;
        }      

        echo $respuesta;
    }
?>