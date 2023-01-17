<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/PagoDAO.php');

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $idDeuda = $_POST['idDeuda'];
        $fecha = $_POST['fecha'];
        $monto = $_POST['monto'];
        $cuenta = $_POST['cuenta'];
        $tipoPago = $_POST['tipoPago'];
        $referencia = $_POST['referencia'];
        $valido = $_POST['valido']==1 ? true : false;

        $pagoDAO = new PagoDAO(BaseDeDatos::getInstancia());
        $pagoDAO->modificar(array($idDeuda, $fecha, $monto, $cuenta, $tipoPago, $referencia, $valido, $id));

        echo "true";
    }
?>