<?php
    include_once(OPTIONS_IG_PATH.'/GenerarOption.php');
    include_once(DAO_PATH.'IConsultor.php');

    class GenerarOptionTipoPersona extends GenerarOption {

        public function __construct(IConsultor $consultor) {
            parent::__construct($consultor);
        }

        function generar($name, $text) {
            $opciones = $this->consultor->getTodos();
            $options = '';
            $options = '<div class="input__grupo">
                            <label for="'.$name.'" class="input__label">'.$text.'</label>
                            <select class="input__select" id="'.$name.'" name="'.$name.'">';
            for($i=0; $i<count($opciones); $i++) {
                $opcion = $opciones[$i];
                $idOpcion = $opcion->getId();
                $descripcionOpcion = $opcion->getDescripcion();
                $options = $options. 
                    "
                        <option value=\"$idOpcion\" class=\"input__select\">$descripcionOpcion</option>
                    ";
            }
            
            $options = $options.'</select> </div>';
            return $options;
        }
    }

?>