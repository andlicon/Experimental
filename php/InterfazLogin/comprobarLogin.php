<?php
    include_once('../instancias/Usuario.php');
    include_once('../conexion/UsuarioDAO.php');
    include_once('../formulario/Alerta.php');
    include_once('../conexion/BaseDeDatos.php');

    /*
        Al precionar el botón con name="login", se comprobara en la base de dato
        si existe una combinación usuario/contrasena, de no existir creara un div
    */
    if(isset($_POST['login'])) {
        //combinacion usuario y contrasena introducida en el formulario
        $usuarioInput =  $_POST['usuario'];
        $contrasenaInput = $_POST['contrasena']; 

        try {   //Extraer informacion de la base de datos
            try {
                $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                $usuarioDAO = new UsuarioDAO($bd);
                $usuario = $usuarioDAO->getInstancia(array($usuarioInput));
            }
            catch (Exception $e) {
                echo $e;
            }
    
            //Se compara la combinación del formulario con la combinación de la base de datos.
            if($usuario) {
                if($usuarioInput===$usuario->getNombre() && $contrasenaInput===$usuario->getContrasena()) {
                    header("Location: /index.php");
                }
            }
        }
        catch(Exception $e) {   //De no existir combinacion usuario/contrasena
            $mensaje = 'usuario incorrecto';
            alerta($mensaje);
        }
    }
?>