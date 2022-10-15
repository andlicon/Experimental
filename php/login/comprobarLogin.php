<?php
    include('../instancias/Usuario.php');
    //PROBANDO
    include('../conexion/UsuarioDAO.php');

    if(isset($_REQUEST['enviar'])) {
        //combinacion usuario y contrasena introducida por el usuario
        $usuarioInput =  $_REQUEST['usuario'];
        $contrasenaInput = $_REQUEST['contrasena']; 

        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getInstancia($usuarioInput);

        if($usuarioInput===$usuario->getNombre() && $contrasenaInput===$usuario->getContrasena()) {
            header("Location: /index.php");
        }
        else {
            //aca pondre lo que debe hccer mi programa de introducir
            //usuario y contrasena incorrecta 
        }
    }
?>