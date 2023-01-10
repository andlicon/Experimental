<?php
    abstract class CreadorBoton {
        protected $permiso;

        public function __construct($permiso) {
            $this->permiso = $permiso;
        }

        public abstract function crearBotones();

        protected function crearItem($name, $texto) {
            return
            '<input type="button" class="boton consultar" value="'.$texto.'" id="'.$name.'">';
        }

        protected function crearItemConsulta() {
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

        protected function crearItemValidez() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("validez", "Validar");;
            $item = $item.
                '
                <label for="validezInput" class="input__label">Validez</label>
                <select class="input__select" id="validezInput" name="validezInput">
                    <option value="1">valido</option>
                    <option value="0">invalido</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }
    }
?>