<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'UsuarioDAO.php');
    include_once(DAO_PATH.'TipoPersonaConsul.php');

    if(isset($_POST['nickname']) && isset($_POST['contrasena'])) {
        //Input
        $nicknameInput = $_POST['nickname'];
        $contrasenaInput = $_POST['contrasena'];

        //Comprobar que el input coincide con los datos en la bd
        $usuarioDAO = new UsuarioDAO(BaseDeDatos::getInstancia());
        $usuarioResultado = $usuarioDAO->getInstanciaSesion(array($nicknameInput, $contrasenaInput));
        
        $retorno = new stdClass();

        //Verificar que exista una cuenta
        if(count($usuarioResultado)==0) {
            $retorno->error = 'No existe usuario';
        }
        else if($usuarioResultado[0]->getValido()==0) {
            $retorno->error = 'Usuario aún no validado';
        }
        else {
            $usuario = $usuarioResultado[0];
            $cedula = $usuario->getCedula();
            $nickname = $nicknameInput;
            $valido = $usuario->getValido();
            $permiso = $usuarioDAO->getPermisoUsuario(array($cedula));

            $retorno->cedula = $cedula;
            $retorno->nickname = $nickname;
            $retorno->valido = $valido;
            $retorno->permiso = $permiso;
        }

        $json = json_encode($retorno);
        echo $json;
    }
?>