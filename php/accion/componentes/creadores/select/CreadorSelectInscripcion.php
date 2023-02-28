<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once('CreadorSelect.php');

    class CreadorSelectInscripcion extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(null);
        }

        protected function crearOption($consulta, $seleccion) {
            $seleccionConfirmado = $seleccion==1 ? "selected" : "";
            $seleccionPorConfirmar = $seleccion==0 ? "selected" : "";
            $seleccionInscrito = $seleccion==2 ? "selected" : "";

            $options = "";
            $options = $options."
                <option value=\"0\" $seleccionPorConfirmar>Por confirmar</option>
                <option value=\"1\" $seleccionConfirmado>Confirmado</option>
                <option value=\"2\" $seleccionInscrito>Inscrito</option>";
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