<?php
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        //$cedula = $_POST['cedula'];
        //$idDeuda = $_POST['idDeuda'];
        $fecha = $_POST['fecha'];
        $monto = $_POST['monto'];
        //$cuenta = $_POST['cuenta'];
        //$tipoPago = $_POST['tipoPago'];
        $referencia = $_POST['referencia'];
        //$valido = $_POST['valido'];

        echo $id.' '.$fecha.' '.$monto.' '.$referencia;
    }
?>