<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once(DAO_PATH.'TipoPersonaConsul.php');
    include_once('CreadorSelect.php');

    class CreadorSelectTipoPersona extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new TipoPersonaConsul(BaseDeDatos::getInstancia()));
        }

        public function crearItemAtributosSeleccion($atributos, $id, $seleccion) {
            $consulta = $this->dao->getTodos();

            $html = "";
            $html = "<div class=\"input__grupo\">
                        <select $atributos id=\"$id\" name=\"tipoPago\" $atributos>";
            $html = $html.$this->crearOption($consulta, $seleccion);
            $html = $html."
                        </select>
                    </div>";

            return $html;
        }

    }

?>