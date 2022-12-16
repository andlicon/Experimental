<?php
    include_once('ConsultarPagoRep.php');
    include_once('ConsultarEstudiante.php');

    if(isset($_POST['pagina']) && isset($_POST['cedula'])) {
        $pagina = $_POST['pagina'] ;
        $cedula = $_POST['cedula'];
        $texto = $_POST['texto'];

        $consultor;

        if(str_contains($pagina, "pago") && str_contains($texto, "deudas no confirmadas")) {
            $consultor = new ConsultarPagoRep();
        }
        else if(str_contains($pagina, "estudiante") && str_contains($texto, "consultar")) {
            $consultor = new ConsultarEstudiante();
        }

        $consultor->consultar(array($cedula));
    }
?>