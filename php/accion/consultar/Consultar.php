<?php
    include_once('ConsultarPagoRep.php');

    if(isset($_POST['pagina']) && isset($_POST['cedula']) && isset($_POST['texto'])) {
        $pagina = $_POST['pagina'] ;
        $cedula = $_POST['cedula'];
        $texto = $_POST['texto'];

        $consultor;

        if(str_contains($pagina, "pago") && str_constains($texto, "deudas no confirmadas")) {
            //$consultor = new ConsultorPagoRep();
            alert('a');
        }

        $consultor->consultarr(array($id));
        echo($pagina.'?usuario='.$_POST['cedula']);
    }
?>