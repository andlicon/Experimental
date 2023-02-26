<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once('CreadorSelect.php');

    class CreadorSelectValido extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(null);
        }

        protected function crearOption($consulta, $seleccion) {
            $seleccionValido = $seleccion ? "selected" : "";
            $seleccionInvalido = !$seleccion ? "selected" : "";

            $options = "";
            $options = $options."
                <option value=\"1\" $seleccionValido>Valido</option>
                <option value=\"0\" $seleccionInvalido>Invalido</option>";
            return $options;
        }

        public function crearItemAtributosSeleccion($atributos, $id, $seleccion) {
            $html = "";

            $html = "<div class=\"input__grupo\">
                        <select $atributos id=\"$id\" name=\"tipoPago\" $atributos>";
            $html = $html.$this->crearOption(null, $seleccion);
            $html = $html."
                        </select>
                    </div>";

            return $html;
        }

    }

?>