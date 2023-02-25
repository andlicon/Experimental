<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'ClaseConsul.php');
    include_once(CREADORES_PATH.'/select/CreadorSelectValido.php');
    include_once(CREADORES_PATH.'/select/CreadorSelectClase.php');

    final class ConsultarEstudianteAdmin implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new EstudianteDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {
            $validez = $_POST['validez'];
            $representante = $_POST['representante'];
            $clase = $_POST['clase'];

            $registros = null;

            if(str_contains($representante, "todos")) {
                if(str_contains($clase, "todas")) { 
                    if(str_contains($validez, "todas")) {
                        $registros = $this->dao->getTodos();
                    }
                    else {
                        $registros = $this->dao->getTodosValidez(array($validez));
                    }
                }
                else {
                    if(str_contains($validez, "todas")) {
                        $registros = $this->dao->getTodosClase(array($clase));
                    }
                    else {
                        $registros = $this->dao->getTodosClaseValidez(array($clase, $validez));
                    }
                }
            }
            else { 
                if(str_contains($clase, "todas")) {
                    if(str_contains($validez, "todas")) {
                        $registros = $this->dao->getInstanciaCedula(array($representante));
                    }
                    else {
                        $registros = $this->dao->getInstanciaCedulaValidez(array($representante, $validez));
                    }
                }
                else {
                    if(str_contains($validez, "todas")) {
                        $registros = $this->dao->getInstanciaCedulaClase(array($representante, $clase));
                    }
                    else {
                        $registros = $this->dao->getInstanciaCedulaValidezClase(array($representante, $validez, $clase));
                    }
                }
            }
            
            $html = "";
            //Generador popOver
            $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
            $claseConsul = new ClaseConsul(BaseDeDatos::getInstancia());

            $selectValido = new CreadorSelectValido();
            $selectClase = new CreadorSelectClase();
        
            for($i=0; $i<count($registros); $i++) {
                $estudiante = $registros[$i];

                //Informacion Estudiante
                $idEstudiante = $estudiante->getId();
                $nombre = $estudiante->getNombre();
                $apellido = $estudiante->getApellido();
                $fechaNacimiento = $estudiante->getFechaNacimiento();
                $idClase = $estudiante->getIdClase();
                $cedulaRepresentante = $estudiante->getCedulaRepresentante();
                $valido = $estudiante->getValido();
                $lugarNacimiento = $estudiante->getLugarNacimiento()==null? "NO ESPECIFICADO" : $estudiante->getLugarNacimiento();
                //Informacion clase
                $nombreClase = $idClase!=null ? $claseConsul->getInstancia(array($idClase))[0]->getDescripcion($idClase) : "Sin asignar";

                $validez = $selectValido->crearItemAtributosSeleccion("class=\"modificable modificable$idEstudiante ocultar\"", "validoInput$idEstudiante", $valido);
                $clase = $selectClase->crearItemAtributosSeleccion("class=\"modificable modificable$idEstudiante ocultar\"", "claseInput$idEstudiante", $idClase);
                
                $valido = $estudiante->getValido() == 0 ? "Por validar" : "Inscrito";

                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$idEstudiante\">";
                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$idEstudiante\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$idEstudiante ocultar\" value=\"$idEstudiante\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$idEstudiante  ocultar\" value=\"$idEstudiante\">";

                $html = $html."  
                    <td class=\"output__celda\">
                        <input  id=\"nombre$idEstudiante\" class=\"modificable modificable--estado$idEstudiante\" value=\"$nombre\" disabled>
                        <input id=\"nombreInput$idEstudiante\" type=\"text\" value=\"$nombre\" disabled class=\"modificable modificable$idEstudiante ocultar\" onkeypress=\"return soloAlfabeto(15, 'nombreInput$idEstudiante')\">
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"apellido$idEstudiante\" class=\"modificable modificable--estado$idEstudiante\" value=\"$apellido\" disabled>
                        <input id=\"apellidoInput$idEstudiante\" type=\"text\" value=\"$apellido\" disabled class=\"modificable modificable$idEstudiante ocultar\" onkeypress=\"return soloAlfabeto(15, 'apellidoInput$idEstudiante')\">
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"fecha$idEstudiante\" class=\"modificable modificable--estado$idEstudiante\" value=\"$fechaNacimiento\" disabled>
                        <input id=\"fechaInput$idEstudiante\" type=\"date\" value=\"$fechaNacimiento\" disabled class=\"modificable modificable$idEstudiante ocultar\">
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"lugarNacimiento$idEstudiante\" class=\"modificable modificable--estado$idEstudiante\" value=\"$lugarNacimiento\" disabled>
                        <input id=\"lugarNacimientoInput$idEstudiante\" type=\"text\" value=\"$lugarNacimiento\" disabled class=\"modificable modificable$idEstudiante ocultar\" onkeypress=\"return soloAlfaNumerico(50, 'lugarNacimientoInput$idEstudiante')\">
                    </td>
                    <td class=\"output__celda\">
                        <span class=\"modificable modificable--estado$idEstudiante\">$nombreClase</span>
                        $clase
                    </td>
                    <td class=\"output__celda\">
                        <span class=\"modificable modificable--estado$idEstudiante\">$valido</span>
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