<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/ClaseModif.php');

    if(isset($_POST['salon']) && isset($_POST['cedula']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        $cedula = $_POST['cedula'];
        $salon = $_POST['salon'];

        $claseModif = new ClaseModif(BaseDeDatos::getInstancia());
        $claseModif->modificar(array($salon, $cedula, $id));

        echo "true";
    }
?>