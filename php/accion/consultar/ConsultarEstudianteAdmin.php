<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'ClaseConsul.php');

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
                        //ESTA NO ME FUNCIONA
                        $registros = $this->dao->getInstanciaCedulaValidez(array($representante, $validez));
                    }
                }
                else {
                    if(str_contains($validez, "todas")) {
                        //cedula = especifica
                        //validez = todas
                        //clase = especifica
                        $registros = $this->dao->getInstanciaCedulaClase(array($representante, $clase));
                    }
                    else {
                        //cedula = especifica
                        //validez = especifica
                        //clase = especifica
                        $registros = $this->dao->getInstanciaCedulaValidezClase(array($representante, $validez, $clase));
                    }
                }
            }
            
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