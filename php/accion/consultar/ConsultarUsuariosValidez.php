<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');

    final class ConsultarUsuariosValidez implements Consultor {
        private $dao;
        private $validez;

        public function __construct($validez) {
            $this->dao = new UsuarioDAO(BaseDeDatos::getInstancia());
            $this->validez = $validez;
        }

        public function consultar(array $filtro) {
            $registros;

            $tipoPersona = $_POST['tipoPersona'];

            //Acá debo mejorar la query para que consulte por cada caso QUE LADILLA
            if(str_contains($this->validez, "todos")) {
                if(str_contains($tipoPersona, "todos")) { 
                    $registros = $this->dao->getTodos();
                }
                else {
                    $registros = $this->dao->getTodosTipoPersona(array($tipoPersona));
                }
            }
            else {
                $valido = str_contains($this->validez, "invalido") ? 0 : 1;

                if(str_contains($tipoPersona, "todos")) { 
                    $registros = $this->dao->getInstanciaValidez(array($valido));
                }
                else {
                    $registros = $this->dao->getTodosTipoPersonaValidez(array($tipoPersona, $valido));
                }
            }

            $html = "";

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

                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$cedula\">";

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
                    </td>
                    <td class=\"output__celda\">
                        $eliminador
                    </td>TERMINAACA";
            }

            echo $html;
        }
    }    
?>