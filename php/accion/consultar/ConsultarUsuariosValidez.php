<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');

    final class ConsultarUsuariosValidez implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new UsuarioDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $filtro) {
            $registros;

            if(str_contains($filtro[0], "invalidos")) {
                $registros = $this->dao->getInstancia(array(0));
            }
            else if(str_contains($filtro[0], "validos")) {
                $registros = $this->dao->getInstanciaValidez(array(1));
            }
            else {
                $registros = $this->dao->getTodos();
            }

            for($i=0; $i<count($registros); $i++) {
                $usuario = $registros[$i];
                $cedula = $usuario->getCedula();
                $nickname = $usuario->getNickname();
                $valido = $usuario->getValido();
                $valido = $valido==true ? "valido" : "invalido";

                //Info persona.
                $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
                $resultados = $personaDAO->getInstancia(array($cedula));
                $persona = $resultados[0];
                $nombre = $persona->getNombre();
                $apellido = $persona->getApellido();
                $idTipoPersona = $persona->getIdTipoPersona();

                //Info TipoUsuario
                $tipoPersonaConsul = new TipoPersonaConsul(BaseDeDatos::getInstancia());
                $resultados = $tipoPersonaConsul->getInstancia(array($idTipoPersona));
                $tipoUsuario = $resultados[0]->getDescripcion();
                $html = $html."  
                     <td class=\"output__celda\">
                         $cedula
                     </td>
                     <td class=\"output__celda\">
                         $nombre
                     </td>
                     <td class=\"output__celda\">
                         $apellido
                     </td>
                     <td class=\"output__celda\">
                        $tipoUsuario
                     </td>
                     <td class=\"output__celda\">
                        $nickname
                     </td>
                     <td class=\"output__celda\">
                        $valido
                     </td>TERMINAACA";
            }

            echo $html;
        }
    }    
?>