<?php
    include_once('generarBotones.php');
    include_once('../instancias/usuario.php');

    function deserializarUsuario() {
        if(isset($_GET['usuario'])) {
            $usuarioGet = $_GET['usuario'];
            $usuario = unserialize($usuarioGet);

            return $usuario;
        }
    }
?>