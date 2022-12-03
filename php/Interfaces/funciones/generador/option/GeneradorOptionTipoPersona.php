<?php 
    include_once(FUNCIONES_IG_PATH.'generador/option/GeneradorOption.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');

    final class GeneradorOptionTipoPersona extends GeneradorOption {
        public function __construct() {
            parent::__construct(0);
        }

        public function generarItems() {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $tipoPersona = new TipoPersonaConsul($bd);
            $resultado = $tipoPersona->getTodos();

            $options = 
            '<div class="input__grupo">
                <label for="tipoPersonaInput" class="input__label">Persona</label>
                <select class="input__select" id="tipoPersonaInput" name="tipoPersonaInput">';

            for($i=0; $i<count($resultado); $i++) {
                $opcion = $resultado[$i];
                $idOpcion = $opcion->getId();
                $descripcionOpcion = $opcion->getDescripcion();
                $options = $options.$this->crearItem($idOpcion, $descripcionOpcion);
            }
            
            $options = $options.
                '</select> 
            </div>';

            echo $options;
        }
    }
?>