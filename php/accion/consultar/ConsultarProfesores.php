<?php
    include_once('Consultor.php');
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/ClaseConsul.php');

    final class ConsultarProfesores implements Consultor {
        private $dao;

        public function __construct() {
            $this->dao = new PersonaDAO(BaseDeDatos::getInstancia());
        }

        public function consultar(array $cedula) {

            $html = "";

            $registros = $this->dao->getTodosRepresentantes();

            for($i=0; $i<count($registros); $i++) {
                $profesor = $registros[$i];
                $cedula = $profesor->getCedula();
                $nombre = $profesor->getNombre();
                $apellido = $profesor->getApellido();
            
                $eliminador = "<input type=\"button\" class=\"eliminar\" value=\"$cedula\">";
                $modificador = "<input type=\"button\" class=\"modificar habilitarModif\" value=\"$cedula\">";
                $aceptar = "<input type=\"button\" class=\"aceptar aceptar$cedula ocultar\" value=\"$cedula\">";
                $cancelar = "<input type=\"button\" class=\"cancelar cancelar$cedula  ocultar\" value=\"$cedula\">";

                //acciones
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
                        clase
                    </td>
                    <td class=\"output__celda\">
                        contactos
                    </td>TERMINAACA";
            }

            echo $html;
        }
    }      
    
?>