<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/PagoDAO.php');

    if(isset($_POST['id']) && isset($_POST['valido'])) {
        $id = $_POST['id'];
        $valido = $_POST['valido']==1 ? true : false;

        $pagoDAO = new PagoDAO(BaseDeDatos::getInstancia());
        $pagoDAO->validar(array($valido, $id));

        echo "true";
    }
?>