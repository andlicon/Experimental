<?php
    include_once('CargarPago.php');
    include_once('CargarEstudiante.php');

    if(isset($_POST['pagina'])) {
        $pagina = $_POST['pagina'];

        $cargador;

        if(str_contains($pagina, "pago")) {
            $cargador = new CargarPago();
        }
        if(str_contains($pagina, "estudiante")) {
            $cargador = new CargarEstudiante();
        }

        if($cargador!=null) {
            $cargador->cargar();
        }
    }

?>