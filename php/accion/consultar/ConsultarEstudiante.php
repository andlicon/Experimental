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
                $nombreClase = $claseConsul->getInstancia(array($idClase))[0]->getDescripcion($idClase);

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
                     </td>TERMINAACA";
            }

            echo $html;
        }
    }    
?>