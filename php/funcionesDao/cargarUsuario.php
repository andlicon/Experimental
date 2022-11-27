<?php
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    
    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    function cargarUsuario(BaseDeDatos $bd, $pagina) {
        $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
        $tipoPersona = comprobarInput('tipoPersonaInput', $pagina);
        $nickname = comprobarInput('nicknameInput', $pagina);
        $contrasena = comprobarInput('contrasenaInput', $pagina);

        $usuarioDAO = new UsuarioDAO($bd);
        $usuarioDAO->cargar(array($cedula, $nickname, $contrasena));
    }
?>