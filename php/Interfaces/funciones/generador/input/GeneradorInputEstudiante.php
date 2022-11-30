<?php 
    include_once(FUNCIONES_IG_PATH.'generador/input/GeneradorInput.php');

    final class GeneradorInputEstudiante extends GeneradorInput {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $inputs = "";
            if($permiso!=2) {       //PROFESOR
                if($permiso==4) {  //ADMINISTRADOR
                    $inputs = $inputs.$this->crearItem("nombreInput", "Nombre");
                    $inputs = $inputs.$this->crearItem("apellidoInput", "Apellido");
                    $inputs = $inputs.$this->crearItemTipo("fechaInput", "Fecha nacimiento", "date");
                    //$inputs = $inputs.$this->generarOptionClases();
                }
                else {                  //REPRESENTANTE y REPRESENTANTE-PROFESOR
                    $inputs = $inputs.$this->crearItem("consultar-rep", "consultar");
                }
            }

            echo $inputs;
        }

        private function generarOptionClases() {
            $options = "";
            
            $options = $options.'
                <div class="input__grupo">
                        <label for="claseInput" class="input__label">Clase</label>
                        <select class="input__select" id="claseInput" name="claseInput">';
                            //optionClases();
        $options = '</select>
                </div>';
        
            return $option;
        }

    }
?>