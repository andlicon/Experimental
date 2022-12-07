<?php 
    include_once(GENERADOR_PATH.'/boton/GeneradorBoton.php');

    final class GeneradorBotonDeuda extends GeneradorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            
            if($permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsulta();
                $botones = $botones.$this->crearItem("modificar", "modificar");
                $botones = $botones.$this->crearItem("eliminar", "eliminar");
                $botones = $botones.$this->crearItem("cargar", "cargar");
            }
            else if($permiso==1 || $permiso==2) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItem("consultar-rep", "consultar");
            }

            echo $botones;
        }

        protected function crearItemConsulta() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("consultar", "Consultar");;
            $item = $item.
                '
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

    }
?>