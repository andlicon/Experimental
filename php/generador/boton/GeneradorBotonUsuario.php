<?php
    include_once(GENERADOR_PATH.'/boton/GeneradorBoton.php');

    final class GeneradorBotonUsuario extends GeneradorBoton {

        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();
            $botones = "";

            if($permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsulta();
                $botones = $botones.$this->crearItemValidez();
                $botones = $botones.$this->crearItem("eliminar", "Eliminar");
            }

            echo $botones;
        }

        private function crearItemValidez() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("validez", "Validar");;
            $item = $item.
                '
                <label for="validezInput" class="input__label">Validez</label>
                <select class="input__select" id="validezInput" name="validezInput">
                    <option>valido</option>
                    <option>invalido</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }
    }

?>