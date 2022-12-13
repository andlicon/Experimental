<?php
    include_once('EliminarPago.php');

    if(isset($_POST['id']) && isset($_POST['pagina'])) {
        $id = $_POST['id'] ;
        $pagina = $_POST['pagina']; 

        $eliminaddor;

        if(str_contains($pagina, "pago")) {
            $eliminador = new EliminarPago();
            $eliminador->eliminar(array($id));
        }
    }
?>