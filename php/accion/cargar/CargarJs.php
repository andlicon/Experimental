<?php
    include_once('CargarPago.php');

    if(isset($_POST['pagina'])) {
        $pagina = $_POST['pagina'];

        $cargador;

        if(str_contains($pagina, "pago")) {
            $cargador = new CargarPago();
        }

        if($cargador!=null) {
            $cargador->cargar();
        }
    }

?>