<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/ContactoDAO.php');
    include_once(DAO_PATH.'/UsuarioDAO.php');

    include_once(DTO_PATH.'/Usuario.php');

    include_once(GENERAL_PATH.'/comprobarInput.php');
    include_once(GENERAL_PATH.'/crearCedula.php');
    include_once(GENERAL_PATH.'/Pagina.php');

    include_once(EXCEPTION_PATH.'/InputException.php');
    include_once(EXCEPTION_PATH.'/DaoException.php');

    /*
        Al precionar el botón con name="login", se comprobara en la base de dato
        si existe una combinación usuario/contrasena, de no existir creara un div
    */
    if(isset($_POST['registrar'])) {
        $pagina = new Pagina(Pagina::LOGIN);

        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

            cargarPersona($bd, $pagina);
            cargarContacto($bd, $pagina);
            cargarUsuario($bd, $pagina);
        }
        catch(InputException $e) {
            $e->imprimirError();
            die();
        }
        catch(DaoException $e) {
            $dao = $e->getDao();
            $accion = $e->getAccion();
            $mensaje = $e->getMessage();

            if($dao == DaoException::CONTACTO) {
                //borrar personas
            }
            else if ($dao == DaoException::USUARIO) {
                //borrar contactos
                //borrar persona
            }
 
            $pagina->imprimirMensaje(null, Mensaje::ERROR, $mensaje);
        }
        catch(PDOException $e) {
            //Error en la conexion a la bd
            echo $e;
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    function cargarPersona(BaseDeDatos $bd, $pagina) {
        $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
        $nombre = comprobarInput('nombreInput', $pagina);
        $apellido = comprobarInput('apellidoInput', $pagina);
        $idTipoPersona = comprobarInput('tipoPersonaInput', $pagina);
        
        $personaDAO = new PersonaDAO($bd);
        $personaDAO->cargar(array($cedula, $nombre, $apellido, $idTipoPersona));
    }

    function cargarContacto(BaseDeDatos $bd, $pagina) {
        $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
        $cedulaInput = comprobarInput('cedulaInput', $pagina);
        $cedula = crearCedula($nacionalidadInput, $cedulaInput);    //se crea la cedula
        $correo = comprobarInput('correoInput', $pagina);
        $telefono = $_POST['telefonoInput'];

        $contactoDAO = new ContactoDAO($bd, $pagina);

        $contactoDAO->cargar(array($cedula, 1, $correo));

        if($telefono!="") {
            $contactoDAO->cargar(array($cedula, 2, $telefono));
        }
    }

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