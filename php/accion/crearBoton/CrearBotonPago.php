<?php 
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once('CreadorBoton.php');

    final class CrearBotonPago extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = "";
            $botones = $botones.'<h2 class="botones__titulo">Consultar</h2>';

            $botones = $botones.'<div class="input__grupo">';
            if($this->permiso==4) {   //administrador
                $botones = $botones.$this->crearItemGestionPago();
            }
            $botones = $botones.$this->itemFecha();
            $botones = $botones.'</div>';

            return $botones;
        }

        protected function crearItemConsulta() {
            $item = 
            '<div class="input__grupo">';
            // $item = $item.$this->crearItem("consultar", "Consultar");
            $item = $item.'
                <label for="representanteInput" class="input__label">Representante(s)</label>
                <select class="input__select" id="representanteInput" name="representanteInput">
                    <option value="todos">todos</option>';

                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $personaDAO = new PersonaDAO($bd);
                    $resultados = $personaDAO->getTodosRepresentantes();

                    for($i=0; $i<count($resultados); $i++) {
                        $rep = $resultados[$i];
                        $nombre = $rep->getNombre();
                        $apellido = $rep->getApellido();
                        $cedula = $rep->getCedula();

                        $item = $item."<option value=\"$cedula\">$cedula - $nombre - $apellido</option>";

                    }

            $item = $item.
                '</select>
            </div>';
            return $item;
        }

        protected function crearItemGestionPago() {
            $item = 
            '<div class="input__grupo">';
            // $item = $item.$this->crearItem("consultar", "Consultar");
            $item = $item.'
                <label for="validezPagoInput" class="input__label">Validez del pago</label>
                <select class="input__select consultor" id="validezPagoInput" name="validezPagoInput">
                    <option value="todos">todos</option>
                    <option value="1">validos</option>
                    <option value="0">invalidos</option>
                </select>
                <label for="representanteInput" class="input__label">Representante</label>
                <select class="input__select consultor"  id="representanteInput" name="representanteInput">';

            $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
            $resultados = $personaDAO->getTodosRepresentantes();
            
            $item = $item."<option value=\"todos\">todos</option>";

            for($i=0; $i<count($resultados); $i++) {
                $rep = $resultados[$i];
                $nombre = $rep->getNombre();
                $apellido = $rep->getApellido();
                $cedula = $rep->getCedula();
                $item = $item."<option value=\"$cedula\">$cedula - $nombre - $apellido</option>";
            }

            $item = $item.
                '</select>
                <script>
                    $(document).ready(function () {
                        $("#representanteInput").select2();
                    });
                </script>
            </div>';
            return $item;
        }

    }
?>