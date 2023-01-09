<?php
    include_once('../../../rutaAcciones.php');
    include_once(CREADORES_PATH.'Creador.php');

    abstract class CreadorSelect extends Creador {

        public function __construct($bd) {
            parent::__construct($bd);
        }

        protected function crearOption($consulta) {
            $options = "";

            for($i=0; $i<count($consulta); $i++) {
                $opcion = $consulta[$i];
                $idOpcion = $opcion->getId();
                $descripcionOpcion = $opcion->getDescripcion();
                
                $options = "<option value=\"$idOpcion\">$descripcionOpcion</option>";
            }

            return $options;
        }
    }
?>