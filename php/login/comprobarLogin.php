<?php
    include('../instancias/Usuario.php');
    include('../conexion/UsuarioDAO.php');
    include('../formulario/Alerta.php');

    /*
        Al precionar el botón con name="login", se comprobara en la base de dato
        si existe una combinación usuario/contrasena, de no existir creara un div
    */
    if(isset($_REQUEST['login'])) {
        //combinacion usuario y contrasena introducida en el formulario
        $usuarioInput =  $_REQUEST['usuario'];
        $contrasenaInput = $_REQUEST['contrasena']; 

        try {   //Extraer informacion de la base de datos
            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->getInstancia(array($usuarioInput));
    
            //Se compara la combinación del formulario con la combinación de la base de datos.
            if($usuarioInput===$usuario->getNombre() && $contrasenaInput===$usuario->getContrasena()) {
                header("Location: /index.php");
            }
        }
        catch(Exception $e) {   //De no existir combinacion usuario/contrasena
            //crea un div que alerte al usuario

            echo 
                "<script>
                    var div = document.getElementById('alerta');
                    div.innerHTML= 'Combinación contraseña/clave errónea';
                    div.classList.add('formulario__alerta--activo');
                </script>";
        }
    }
?>