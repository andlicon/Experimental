<?php
    include_once('EliminadorPago.php');

    if(isset($_POST['id']) && isset($_POST['pagina'])) {
        $id = $_POST['id'] ;
        $pagina = $_POST['pagina']; 

        $eliminaddor;

        if(str_contains($pagina, "pago")) {
            $eliminador = new EliminadorPago();
            $eliminador->eliminar(array($id));
        }
    }
?>