<?php
    include_once('ConsultarPagoRep.php');

    if(isset($_POST['pagina']) && isset($_POST['cedula'])) {
        $pagina = $_POST['pagina'] ;
        $cedula = $_POST['cedula'];
        $texto = $_POST['texto'];

        $consultor;

        if(str_contains($pagina, "pago") && str_contains($texto, "deudas no confirmadas")) {
            $consultor = "REP";
        }

        //$consultor->consultar(array($id));
        echo($consultor);
    }
?>