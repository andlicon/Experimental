<?php
    include_once('generarBotones.php');
    include_once(DTO_PATH.'/usuario.php');

    function deserializarUsuario() {
        if(isset($_GET['usuario'])) {
            $usuarioGet = $_GET['usuario'];
            $usuario = unserialize($usuarioGet);

            return $usuario;
        }
    }
?>