<?php
    // include_once(DAO_PATH.'/UsuarioDAO.php');
    // include_once(DAO_PATH.'/BaseDeDatos.php');

    // include_once(DTO_PATH.'/Usuario.php');

    // include_once(GENERAL_PATH.'/comprobarInput.php');
    // include_once(GENERAL_PATH.'/Pagina.php');

    // include_once(EXCEPTION_PATH.'/InputException.php');

    // include_once(MENSAJE_PATH.'/Mensaje.php');

    if(isset($_POST['nickname']) && isset($_POST['contrasena'])) {
        $nickname = $_POST['nickname'];
        $contrasena = $_POST['contrasena'];

        
    }

    // if(isset($_POST['login'])) {
    //     $paginaLogin = new Pagina(Pagina::LOGIN);

    //     try {
    //         //combinacion usuario y contrasena introducida en el formulario
    //         $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

    //         $nicknameInput = comprobarInput('nicknameEntrar', $paginaLogin);
    //         $contrasenaInput = comprobarInput('contrasenaEntrar', $paginaLogin);
    //         $usuarioDAO = new UsuarioDAO($bd);
    //         $usuarios = $usuarioDAO->getInstanciaNickname(array($nicknameInput));

    //         if($usuarios) {
    //             $usuario = $usuarios[0];

    //             if(!usuarioValido($usuario)) {
    //                 $paginaLogin->imprimirMensaje(null, Mensaje::ERROR, "Usuario sigue a la espera de la validación.");
    //                 die();
    //             }
    //             if(!credencialesValidos($usuario, $nicknameInput, $contrasenaInput)) {
    //                 $paginaLogin->imprimirMensaje(null, Mensaje::ERROR, "No existe combinacion usuario/contrasena.");
    //                 die();
    //             }

    //             $paginaInicio = new Pagina(Pagina::INICIO);
    //             $paginaInicio->setUsuario($usuario);
    //             $paginaInicio->actualizarPagina(null);
    //         }
    //     }
    //     catch(InputException $e) {
    //         $e->imprimirError();
    //     }
    //     catch(Exception $e) {
    //         echo $e;
    //     }
    // }

    // function usuarioValido(Usuario $usuario) {
    //     return $usuario->getValido();
    // }

    // function credencialesValidos(Usuario $usuario, $nickname, $contrasena) {
    //     return $nickname===$usuario->getNickname() && $contrasena===$usuario->getContrasena();
    // }
?>