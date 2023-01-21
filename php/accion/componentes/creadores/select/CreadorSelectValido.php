<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once('CreadorSelect.php');

    class CreadorSelectValido extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(null);
        }



        protected function crearOption($consulta) {
            $options = "";
            $options = $options."
                <option value=\"1\">Valido</option>
                <option value=\"0\">Invalido</option>";
                
            return $options;
        }

        public function crearItemAtributos($atributos, $id) {
            $html = "";

            $html = "<div class=\"input__grupo\">
                        <select $atributos id=\"$id\" name=\"tipoPago\" $atributos>";
            $html = $html.$this->crearOption(null);
            $html = $html."
                        </select>
                    </div>";

            return $html;
        }

    }

?>