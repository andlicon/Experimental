<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'UsuarioDAO.php');
    include_once(DAO_PATH.'ContactoDAO.php');

    final class ConsultarPerfil implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new PagoDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {
            $cedula = $_POST['cedula'];
            
            $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
            $usuarioDAO = new UsuarioDAO(BaseDeDatos::getInstancia());
            $contactoDAO = new ContactoDAO(BaseDeDatos::getInstancia());

            $respuesta = "";

            try {
                //Persona
                $registro = $personaDAO->getInstancia(array($cedula));
                $persona = $registro[0];
                $nombre = $persona->getNombre();
                $apellido = $persona->getApellido();
                //Usuario
                $registro = $usuarioDAO->getInstancia(array($cedula));
                $usuario = $registro[0];
                $nickname = $usuario->getNickname();
                //Contactos
                $registro = $contactoDAO->getInstanciaCedula(array($cedula));
                $correo = $registro[0]->getContacto();
                $telefono = $registro[1]->getContacto();
                
                $respuesta = array(
                            "nickname"=>$nickname,
                            "nombre"=>$nombre,
                            "apellido"=>$apellido,
                            "correo"=>$correo,
                            "telefono"=>$telefono);

            }
            catch(Exception $e) {
                $respuesta = array("error"=>"Ha ocurrido un error");
            }
            finally {
                echo json_encode($respuesta);
            }
        }
    }      
    
?>