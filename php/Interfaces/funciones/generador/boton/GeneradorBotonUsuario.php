<?php
    include_once(FUNCIONES_IG_PATH.'generador/boton/GeneradorBoton.php');

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


        private function crearItemConsulta() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("consultar", "Consultar");;
            $item = $item.
                '
                <label for="tipoConsulta" class="input__label">Tipo consulta</label>
                <select class="input__select" id="tipoConsulta" name="tipoConsulta">
                    <option>todos</option>
                    <option>validos</option>
                    <option>invalidos</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
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