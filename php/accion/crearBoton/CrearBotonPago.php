<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonPago extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            
            if($this->permiso==3 || $this->permiso==1) {  //Profesor y representante - representante
                $botones = $botones.$this->crearItem("consultar-rep", "deudas no confirmadas");
                $botones = $botones.$this->crearItem("cargar", "cargar");
                $botones = $botones.$this->crearItem("modificar", "modificar");
                $botones = $botones.$this->crearItem("eliminar", "eliminar");
            }
            else if($this->permiso==4) {   //administrador
                $botones = $botones.$this->crearItemConsulta();
                $botones = $botones.$this->crearItemValidez();
                $botones = $botones.$this->crearItem("modificar", "modificar");
                $botones = $botones.$this->crearItem("eliminar", "eliminar");
            }

            return $botones;
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