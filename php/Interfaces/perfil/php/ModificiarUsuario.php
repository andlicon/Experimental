<?php
    include_once('../../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'ContactoDAO.php');
    include_once(DAO_PATH.'UsuarioDAO.php');
    include_once(DAO_PATH.'PersonaDAO.php');

    if(isset($_POST['cedula']) && isset($_POST['correo']) && 
    isset($_POST['telefono']) && isset($_POST['nickname']) &&
    isset($_POST['nombre']) && isset($_POST['apellido']) &&
    isset($_POST['contrasena'])) {
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $nickname = $_POST['nickname'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $contrasena = $_POST['contrasena'];

        $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
        $personaDAO->modificarNombreApellido(array($nombre, $apellido, $cedula));

        $contactoDAO = new ContactoDAO(BaseDeDatos::getInstancia());
        $contactoDAO->modificarContacto(array($correo, 1, $cedula));
        $contactoDAO->modificarContacto(array($telefono, 2, $cedula));

        $usuarioDAO = new UsuarioDAO(BaseDeDatos::getInstancia());
        if($contrasena=="") {
            $usuarioDAO->modificarNickname(array($nickname, $cedula));
        }
        else {
            $usuarioDAO->modificar(array($nickname, $contrasena, $cedula));
        }

        echo 'funciono';
    }

?>