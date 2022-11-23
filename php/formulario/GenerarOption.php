<?php
    include_once(DAO_PATH.'IConsultor.php');

    class GenerarOption {
        private IConsultor $consultor;

        public function __construct(IConsultor $consultor) {
            $this->consultor = $consultor;
        }

        function generar() {
            $opciones = $this->consultor->getTodos();
    
            for($i=0; $i<count($opciones); $i++) {
                $opcion = $opciones[$i];
                $idOpcion = $opcion->getId();
                $descripcionOpcion = $opcion->getDescripcion();
                echo 
                    "
                        <option value=\"$idOpcion\" class=\"input__select\">$descripcionOpcion</option>
                    ";
            }
        }
    }
?>