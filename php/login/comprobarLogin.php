<?php
    include("../conexion/BaseDeDatos.php");

    if(isset($_REQUEST['enviar'])) {
        //combinacion usuario y contrasena introducida por el usuario
        $usuarioInput =  $_REQUEST['usuario'];
        $contrasenaInput = $_REQUEST['contrasena'];
        
        //Aca se debe extraer la contra y usuario de la base de datos   
        $baseDeDatos = new BaseDeDatos("login","logger");
        $baseDeDatos->conectar();
        $usuario = 'admin';
        $contrasena = 'admin';

        if($usuario===$usuarioInput && $contrasena===$contrasenaInput) {
            header("Location: /index.php");
        }
        else {
            //aca pondre lo que debe hccer mi programa de introducir
            //usuario y contrasena incorrecta 
        }
    }
?>