<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/UsuarioDAO.php');

    if(isset($_POST['tipoUsuario']) && isset($_POST['valido']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $valido = $_POST['valido'];
        $valido = $valido==1 ? true : false;

        $usuarioDAO = new UsuarioDAO(BaseDeDatos::getInstancia());
        $usuarioDAO->modificarAdmin(array($id, $tipoUsuario, $valido));

        echo "true";
    }
?>