<?php
    include_once('EliminarPago.php');
    include_once('EliminarEstudiante.php');

    if(isset($_POST['id']) && isset($_POST['pagina'])) {
        $id = $_POST['id'] ;
        $pagina = $_POST['pagina'];

        $eliminador;

        if(str_contains($pagina, "pago")) {
            $eliminador = new EliminarPago();
        }

        $eliminador->eliminar(array($id));
        echo($pagina.'?usuario='.$_POST['cedula']);
    }
?>