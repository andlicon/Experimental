<?php
    include_once('../../../accion/rutaAcciones.php');

    echo 'cedula '.$_POST['cedula'];
    echo 'Correo: '.$_POST['correo'];
    echo 'Telefono: '.$_POST['telefono'];
    echo 'Nickname: '.$_POST['nickname'];

    if(isset($_POST['cedula']) && isset($_POST['correo']) && isset($_POST['telefono'])
    && isset($_POST['nickname'])) {
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $nickname = $_POST['nickname'];

        echo 'a';

    }
?>