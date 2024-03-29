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

            $representante = $_POST['representante'];
            $fecha = $_POST['fecha'];

            if($fecha=="") {            //NO HAY FECHA
                if(str_contains($representante, "todos")) {    
                    if(str_contains($this->validez, "todos")) {
                        $registros = $this->dao->getTodos();
                    }
                    else {                                   
                        $valido = str_contains($this->validez, "invalidos") ? 0 : 1;
                        $registros = $this->dao->getInstanciaValidez(array($valido));
                    }
                }
                else {                                          
                    if(str_contains($this->validez, "todos")) { 
                        $registros = $this->dao->getTodosCedula(array($representante));
                    }
                    else {          
                        $valido = str_contains($this->validez, "invalidos") ? 0 : 1;
                        $registros = $this->dao->getInstanciaValidezRepresentante(array($valido, $representante));
                    }
                }
            }
            else {                     
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
                if(str_contains($representante, "todos")) {     
                    if(str_contains($this->validez, "todos")) { 
                        $registros = $this->dao->getTodosFecha(array($anio, $mes));
                    }
                    else {                                
                        $valido = str_contains($this->validez, "invalidos") ? 0 : 1;
                        $registros = $this->dao->getTodosValidezFecha(array($valido, $anio, $mes));
                    }
                }
                else {                                         
                    if(str_contains($this->validez, "todos")) { 
                        //FECHA REPRESENTANTE validez
                        $registros = $this->dao->getInstanciaFechaRep(array($representante, $anio, $mes));
                    }
                    else {                                     
                        $valido = str_contains($this->validez, "invalidos") ? 0 : 1;
                        $registros = $this->dao->getInstanciaValidezRepresentanteFecha(array($valido, $representante, $anio, $mes));
                    }
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
                $fechaRegistro = $usuario->getFechaRegistro();

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

                $valido = $valido==true ? "Confirmado" : "Por confirmar";

                $html = $html."  
                    <td class=\"output__celda\">
                        $fechaRegistro
                    </td>
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
                        <textarea name=\"direccionTrabajo$cedula\" id=\"direccionTrabajo$cedula\" disabled class=\"modificable modificable--estado$cedula textarea\" cols=\"14\" rows=\"5\">$direccionTrabajo</textarea>
                        <textarea name=\"direccionTrabajoInput$cedula\" id=\"direccionTrabajoInput$cedula\" disabled class=\"modificable modificable$cedula ocultar textarea\" cols=\"14\" rows=\"5\"onkeypress=\"return soloAlfaNumerico(50, 'direccionTrabajoInput$cedula')\">$direccionTrabajo</textarea>
                    </td>
                    <td class=\"output__celda\">
                        <textarea name=\"direccionHogar$cedula\" id=\"direccionHogar$cedula\" disabled class=\"modificable modificable--estado$cedula textarea\" cols=\"14\" rows=\"5\">$direccionHogar</textarea>
                        <textarea name=\"direccionHogarInput$cedula\" id=\"direccionHogarInput$cedula\" disabled class=\"modificable modificable$cedula ocultar textarea\" cols=\"14\" rows=\"5\" onkeypress=\"return soloAlfaNumerico(50, 'direccionHogarInput$cedula')\">$direccionHogar</textarea>
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