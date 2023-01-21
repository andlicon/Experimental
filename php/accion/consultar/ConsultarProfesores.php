<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(CREADORES_PATH.'/select/CreadorSelectProfesor.php');

    final class ConsultarProfesores implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new ClaseConsul(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {

            $html = "";

            $registros = $this->dao->getTodos();
            $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());

            //modificadores
            $selectProfe = new CreadorSelectProfesor();

            for($i=0; $i<count($registros); $i++) {
                $clase = $registros[$i];
                $idClase = $clase->getId();
                $salonClase = $clase->getSalon();
                $descripcionClase = $clase->getDescripcion();
                $cedulaProfe = $clase->getCedulaProfesor();

                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$idClase\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$idClase ocultar\" value=\"$idClase\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$idClase  ocultar\" value=\"$idClase\">";

                $html = $html."
                    <td class=\"output__celda\">
                        $descripcionClase
                    </td>
                    <td class=\"output__celda\">
                        <input  id=\"salon$idClase\" class=\"modificable modificable--estado$idClase\" value=\"$salonClase\" disabled>
                        <input id=\"salonInput$idClase\" type=\"text\" value=\"$salonClase\" disabled class=\"modificable modificable$idClase ocultar\">
                    </td>
                ";

                $profe = $selectProfe->crearItemAtributos("class=\"modificable modificable$idClase ocultar\"", "cedulaInput$idClase");

                if($cedulaProfe!=null) {
                    $resultado = $personaDAO->getInstancia(array($cedulaProfe));
                    $persona = $resultado[0];
                    $cedula = $persona->getCedula();
                    $nombre = $persona->getNombre();
                    $apellido = $persona->getApellido();

                    //acciones
                    $html = $html."
                    <td class=\"output__celda\">
                        <span class=\"modificable modificable--estado$idClase\">$cedula</span>
                        $profe
                    </td>
                    <td class=\"output__celda\">
                        $nombre
                    </td>
                    <td class=\"output__celda\">
                        $apellido
                    </td>
                    <td class=\"output__celda\">
                        CONTACTO
                    </td>";
                }
                else {
                    $html = $html."
                    <td class=\"output__celda\">
                        $profe
                    </td>
                    <td class=\"output__celda\">
                        
                    </td>
                    <td class=\"output__celda\">
                        
                    </td>
                    <td class=\"output__celda\">
                        
                    </td>";
                    ;
                }

                $html = $html."
                    <td class=\"output__celda\">
                        $modificador
                        $aceptar
                        $cancelar
                    </td>TERMINAACA";


            }

            echo $html;
        }
    }      
    
?>