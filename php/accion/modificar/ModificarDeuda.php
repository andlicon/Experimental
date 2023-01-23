<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');

    if(isset($_POST['id']) && isset($_POST['motivo']) && isset($_POST['fecha']) && 
        isset($_POST['descripcion']) && isset($_POST['montoInicial'])) {
        $id = $_POST['id'];
        $motivo = $_POST['motivo'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
        $montoInicial = $_POST['montoInicial'];

        $pagoDAO = new DeudaDAO(BaseDeDatos::getInstancia());
        $pagoDAO->modificar(array($motivo, $fecha, $descripcion, $montoInicial, $id));

        echo "true";
    }
?>