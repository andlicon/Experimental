<?php
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    include_once(DTO_PATH.'/Usuario.php');

    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    include_once(EXCEPTION_PATH.'/InputException.php');

    include_once(MENSAJE_PATH.'/Mensaje.php');

    /*
        Al precionar el botón con name="login", se comprobara en la base de dato
        si existe una combinación usuario/contrasena, de no existir creara un div
    */
    if(isset($_POST['login'])) {
        $pagina = new Pagina(Pagina::LOGIN);

        try {
            //combinacion usuario y contrasena introducida en el formulario
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

            $nicknameInput = comprobarInput('nicknameEntrar', $pagina);
            $contrasenaInput = comprobarInput('contrasenaEntrar', $pagina);
            $usuarioDAO = new UsuarioDAO($bd);
            $usuarios = $usuarioDAO->getInstanciaNickname(array($nicknameInput));

            if($usuarios) {
                $usuario = $usuarios[0];
                if($nicknameInput===$usuario->getNickname() && $contrasenaInput===$usuario->getContrasena()) {
                    $opcion = new Pagina(Pagina::OPCION);
                    $opcion->setUsuario($usuario);
                    $opcion->actualizarPagina(null);
                }
                else{
                    $pagina->imprimirMensaje(null, Mensaje::ERROR, "No existe combinacion usuario/contrasena");
                    die();
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