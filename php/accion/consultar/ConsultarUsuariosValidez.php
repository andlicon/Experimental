<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'/UsuarioDAO.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');
    include_once(CREADORES_PATH.'/select/CreadorSelectValido.php');
    include_once(CREADORES_PATH.'/select/CreadorSelectTipoPersona.php');

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

            //select
            $selectValido = new CreadorSelectValido();
            $selectTipoPersona = new CreadorSelectTipoPersona();

            $html = "";

            for($i=0; $i<count($registros); $i++) {
                $usuario = $registros[$i];
                $cedula = $usuario->getCedula();
                $nickname = $usuario->getNickname();
                $valido = $usuario->getValido();

                //Info persona.
                $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
                $resultados = $personaDAO->getInstancia(array($cedula));
                $persona = $resultados[0];
                $nombre = $persona->getNombre();
                $apellido = $persona->getApellido();
                $idTipoPersona = $persona->getIdTipoPersona();
                $direccionHogar = $persona->getDireccionHogar();
                $direccionTrabajo = $persona->getDireccionTrabajo();

                //Info TipoUsuario
                $tipoPersonaConsul = new TipoPersonaConsul(BaseDeDatos::getInstancia());
                $resultados = $tipoPersonaConsul->getInstancia(array($idTipoPersona));
                $tipoUsuarioId = $resultados[0]->getId();
                $tipoUsuario = $resultados[0]->getDescripcion();

                $validez = $selectValido->crearItemAtributosSeleccion("class=\"modificable modificable$cedula ocultar\"", "validoInput$cedula", $valido);
                $tipoPersona = $selectTipoPersona->crearItemAtributosSeleccion("class=\"modificable modificable\" disabled", "tipoUsuarioInput$cedula", $tipoUsuarioId);

                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$cedula\">";
                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$cedula\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$cedula ocultar\" value=\"$cedula\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$cedula  ocultar\" value=\"$cedula\">";

                $valido = $valido==true ? "valido" : "invalido";

                $html = $html."  
                    <td class=\"output__celda\">
                        $cedula
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"nombre$cedula\" class=\"modificable modificable--estado$cedula\" value=\"$nombre\" disabled>
                        <input id=\"nombreInput$cedula\" type=\"text\" value=\"$nombre\" disabled class=\"modificable modificable$cedula ocultar\" onkeypress=\"return soloAlfabeto(15, 'nombreInput$cedula')\">                    
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"apellido$cedula\" class=\"modificable modificable--estado$cedula\" value=\"$apellido\" disabled>
                        <input id=\"apellidoInput$cedula\" type=\"text\" value=\"$apellido\" disabled class=\"modificable modificable$cedula ocultar\" onkeypress=\"return soloAlfabeto(15, 'apellidoInput$cedula')\">   
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"direccionTrabajo$cedula\" class=\"modificable modificable--estado$cedula\" value=\"$direccionTrabajo\" disabled>
                        <input id=\"direccionTrabajoInput$cedula\" type=\"text\" value=\"$direccionTrabajo\" disabled class=\"modificable modificable$cedula ocultar\" onkeypress=\"return soloAlfaNumerico(50, 'direccionTrabajoInput$cedula')\">
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"direccionHogar$cedula\" class=\"modificable modificable--estado$cedula\" value=\"$direccionHogar\" disabled>
                        <input id=\"direccionHogarInput$cedula\" type=\"text\" value=\"$direccionHogar\" disabled class=\"modificable modificable$cedula ocultar\" onkeypress=\"return soloAlfaNumerico(50, 'direccionHogarInput$cedula')\">
                    </td>
                    <td class=\"output__celda\">
                        <span class=\"modificable modificable--estado\">$tipoUsuario</span>
                    </td>
                    <td class=\"output__celda\">
                       $nickname
                    </td>
                    <td class=\"output__celda\">
                        <span id=\"valido$cedula\" class=\"modificable modificable--estado$cedula\">$valido</span>
                       $validez
                    </td>
                    <td class=\"output__celda\">
                        $eliminador
                        $modificador
                        $aceptar
                        $cancelar
                    </td>TERMINAACA";
            }

            echo $html;
        }
    }    
?>