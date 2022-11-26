<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/ContactoDAO.php');

    include_once(GENERAL_PATH.'/Pagina.php');

    include_once(EXCEPTION_PATH.'/InputException.php');
    include_once(EXCEPTION_PATH.'/DaoException.php');

    include_once(FUNCIONES_DAO_PATH.'/cargarPersona.php');
    include_once(FUNCIONES_DAO_PATH.'/cargarContacto.php');
    include_once(FUNCIONES_DAO_PATH.'/cargarUsuario.php');

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

            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha registrado con exito!");
        }
        catch(InputException $e) {
            $e->imprimirError();
            die();
        }
        catch(DaoException $e) {
            $dao = $e->getDao();
            $accion = $e->getAccion();
            $mensaje = $e->getMessage();

            $nacionalidadInput = comprobarInput('nacionalidadInput', $pagina);
            $cedulaInput = comprobarInput('cedulaInput', $pagina);
            $cedula = crearCedula($nacionalidadInput, $cedulaInput);

            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

            if($dao == DaoException::CONTACTO || $dao == DaoException::USUARIO) {
                //borrar contactos
                $contactoDAO = new ContactoDAO($bd);
                $contactoDAO->eliminarPorCedula(array($cedula));

                //borrar persona
                $personaDAO = new PersonaDAO($bd);
                $personaDAO->eliminar(array($cedula));
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
?>