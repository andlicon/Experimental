<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(DAO_PATH.'/PersonaDAO.php');

    if(isset($_POST['tipoUsuario']) && 
        isset($_POST['valido']) && 
        isset($_POST['id']) &&
        isset($_POST['nombre']) &&
        isset($_POST['apellido']) &&
        isset($_POST['direccionTrabajo']) &&
        isset($_POST['direccionHogar'])) {
        $id = $_POST['id'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $valido = $_POST['valido'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccionTrabajo = $_POST['direccionTrabajo'];
        $direccionHogar = $_POST['direccionHogar'];
        $valido = $valido==1 ? true : false;

        //usuario
        $usuarioDAO = new UsuarioDAO(BaseDeDatos::getInstancia());
        $usuarioDAO->modificarAdmin(array($id, $tipoUsuario, $valido));
        //persona
        $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
        $personaDAO->modificarInfo(array($nombre, $apellido, $direccionHogar, $direccionTrabajo, $id));

        echo "true";
    }
?>