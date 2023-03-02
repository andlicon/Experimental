<?php
    include_once('CargarPago.php');
    include_once('CargarEstudiante.php');
    include_once('CargarDeuda.php');


    if(isset($_POST['pagina'])) {
        $pagina = $_POST['pagina'];

        $cargador;

        if(str_contains($pagina, "pago")) {
            $cargador = new CargarPago();
        }
        else if(str_contains($pagina, "estudiante")) {
            echo 'aaa';
            $cargador = new CargarEstudiante();
        }
        else if(str_contains($pagina, "deuda")) {
            $cargador = new CargarDeuda();
        }

        if($cargador!=null) {
            $cargador->cargar();
        }
    }

?>