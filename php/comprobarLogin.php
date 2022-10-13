<?php
    if(isset($_REQUEST['enviar'])) {
        //Aca se debe extraer la contra y usuario de la base de datos
        $usuario = 'admin';
        $contrasena = 'admin';

        //combinacion usuario y contrasena introducida por el usuario
        $usuarioInput =  $_REQUEST['usuario'];
        $contrasenaInput = $_REQUEST['contrasena'];

        if($usuario===$usuarioInput && $contrasena===$contrasenaInput) {
            header("Location: /index.php");
        }
        else {
            //aca pondre lo que debe hccer mi programa de introducir
            //usuario y contrasena incorrecta 
        }
    }
?>