<?php
    include_once('../instancias/Usuario.php');
    include_once('../conexion/UsuarioDAO.php');
    include_once('../formulario/Alerta.php');

    /*
        Al precionar el botón con name="login", se comprobara en la base de dato
        si existe una combinación usuario/contrasena, de no existir creara un div
    */
    if(isset($_POST['login'])) {
        //combinacion usuario y contrasena introducida en el formulario
        $usuarioInput =  $_POST['usuario'];
        $contrasenaInput = $_POST['contrasena']; 

        try {   //Extraer informacion de la base de datos
            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->getInstancia(array($usuarioInput));
    
            //Se compara la combinación del formulario con la combinación de la base de datos.
            if($usuarioInput===$usuario->getNombre() && $contrasenaInput===$usuario->getContrasena()) {
                header("Location: /index.php");
            }
        }
        catch(Exception $e) {   //De no existir combinacion usuario/contrasena
            $mensaje = 'usuario incorrecto';
            alerta($mensaje);
        }
    }
?>