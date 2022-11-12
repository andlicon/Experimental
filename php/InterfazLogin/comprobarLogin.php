<?php
    include_once('../instancias/Usuario.php');
    include_once('../conexion/UsuarioDAO.php');
    include_once('../conexion/BaseDeDatos.php');

    include_once('../general/comprobarInput.php');
    include_once('../general/Pagina.php');

    include_once('../excepciones/InputException.php');

    /*
        Al precionar el botón con name="login", se comprobara en la base de dato
        si existe una combinación usuario/contrasena, de no existir creara un div
    */
    if(isset($_POST['login'])) {
        $pagina = new Pagina(Pagina::LOGIN);
        try {
            //combinacion usuario y contrasena introducida en el formulario
            $usuarioInput = comprobarInput('usuario', $pagina);;
            $contrasenaInput = comprobarInput('contrasena', $pagina);; 

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $usuarioDAO = new UsuarioDAO($bd);
            $usuarios = $usuarioDAO->getInstancia(array($usuarioInput));

            if($usuarios) {
                $usuario = $usuarios[0];
                if($usuarioInput===$usuario->getNombre() && $contrasenaInput===$usuario->getContrasena()) {
                    $paginaOpcion = new Pagina(Pagina::OPCION);
                    
                    $idTipoUsuario = $usuario->getIdTipoUsuario();
                    $paginaOpcion->actualizarPagina($idTipoUsuario);
                }
            }
        }
        catch(InputException $e) {
            $e->imprimirError();
            die();
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>