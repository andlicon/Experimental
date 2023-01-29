<?php
    include_once('../../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'ContactoDAO.php');
    include_once(DAO_PATH.'UsuarioDAO.php');

    if(isset($_POST['cedula']) && isset($_POST['correo']) && 
    isset($_POST['telefono']) && isset($_POST['nickname'])) {
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $nickname = $_POST['nickname'];
        $contrasena = $_POST['contrasena'];
        $contrasenaOtra = $_POST['contrasenaDos'];

        //Consultar a 
        $respuesta = true;

        try {
            $usuarioDAO = new UsuarioDAO(BaseDeDatos::getInstancia());
            $contactoDAO = new ContactoDAO(BaseDeDatos::getInstancia());

            if(!$usuarioDAO->validarUsuario($nickname, $cedula)) {
                $respuesta = false;
            }
            else if(!$contactoDAO->validarContacto($correo, $cedula)) {
                $respuesta = false;
            }
            else if(!$contactoDAO->validarContacto($telefono, $cedula)) {
                $respuesta = false;
            }
            if ($contrasena!=$contrasenaOtra) {
                $respuesta = false;
            }
        }
        catch(Exception $e) {
            $respuesta = false;
        }

        echo $respuesta;
    }
?>