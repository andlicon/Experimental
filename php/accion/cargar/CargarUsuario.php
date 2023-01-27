<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'UsuarioDAO.php');
    include_once(DAO_PATH.'ContactoDAO.php');

    if(isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) &&
    isset($_POST['nickname']) && isset($_POST['contrasena']) && isset($_POST['tipoPersona'])
    && isset($_POST['correo']) && isset($_POST['telefono'])) {
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];;
        $apellido = $_POST['apellido'];
        $nickname = $_POST['nickname'];
        $contrasena = $_POST['contrasena'];
        $tipoPersona = $_POST['tipoPersona'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];

        $respuesta = array();

        //dao
        $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
        $usuarioDAO = new UsuarioDAO(BaseDeDatos::getInstancia());
        $contactoDAO = new ContactoDAO(BaseDeDatos::getInstancia());

        try {
            //Cargar persona
            $personaDAO->cargar(array($cedula, $nombre, $apellido, $tipoPersona));
            //Cargar usuario
            $usuarioDAO->cargar(array($cedula, $nickname, $contrasena));
            //Cargar contactos
            $contactoDAO->cargar(array($cedula, 1, $correo));  //Correo
            $contactoDAO->cargar(array($cedula, 2, $telefono));  //telefono
            //respuesta
            array_push($respuesta, array(
                "tipo"=>"exito",
                "descripcion"=>"se ha cargado el usuario con exito."
            ));
        }
        catch(DaoException $e) {
            if($e->getDao() == DaoException::PERSONA) {
                array_push($respuesta, array(
                    "tipo"=>"error",
                    "descripcion"=>"Existe un usuario registrado con dicha cédula."
                ));
            }
            else {
                if($e->getDao() == DaoException::CONTACTO) {
                    array_push($respuesta, array(
                        "tipo"=>"error",
                        "descripcion"=>"Existe un usuario registrado con alguno de los contactos."
                    ));
                }
                else if($e->getDao() == DaoException::USUARIO) {
                    array_push($respuesta, array(
                        "tipo"=>"error",
                        "descripcion"=>"Existe un usuario registrado con dicho nickname."
                    ));
                }
                //No tengo forma de saber cuándo es quer 
                $contactoDAO->eliminarCedula(array($cedula));
                $usuarioDAO->eliminar(array($cedula));
                $personaDAO->eliminar(array($cedula));
            }
        }
        catch(Exception $e) {
            //Borrar registros de acuerdo a quien haya arrojado el error PDO
            array_push($respuesta, array(
                "tipo"=>"error",
                "descripcion"=>"ha ocurrido algun error inesperado."
            ));
        }
        finally {
            echo json_encode($respuesta);
        }
    }   
?>