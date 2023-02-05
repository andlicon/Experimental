<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'ClaseConsul.php');

    final class ConsultarEstudiante implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new EstudianteDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {
            $registros = $this->dao->getInstanciaCedula($cedula);

            $html = "";

            //Generador popOver
            $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
            $claseConsul = new ClaseConsul(BaseDeDatos::getInstancia());
        
            for($i=0; $i<count($registros); $i++) {
                $estudiante = $registros[$i];

                //Informacion Estudiante
                $idEstudiante = $estudiante->getId();
                $nombre = $estudiante->getNombre();
                $apellido = $estudiante->getApellido();
                $fechaNacimiento = $estudiante->getFechaNacimiento();
                $idClase = $estudiante->getIdClase();
                $cedulaRepresentante = $estudiante->getCedulaRepresentante();
                $valido = $estudiante->getValido() == 0 ? "Por validar" : "Inscrito";
                //Informacion clase
                $nombreClase = $idClase!=null ? $claseConsul->getInstancia(array($idClase))[0]->getDescripcion($idClase) : "Aun no asignada";

                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$idEstudiante\">";
                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$idEstudiante\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$idEstudiante ocultar\" value=\"$idEstudiante\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$idEstudiante  ocultar\" value=\"$idEstudiante\">";

                $html = $html."  
                    <td class=\"output__celda\">
                        $nombre
                    </td>
                    <td class=\"output__celda\">
                        $apellido
                    </td>
                    <td class=\"output__celda\">
                        $fechaNacimiento
                    </td>
                    <td class=\"output__celda\">
                        $nombreClase
                    </td>
                    <td class=\"output__celda\">
                        $valido
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