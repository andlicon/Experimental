<?php 
    include_once(GENERADOR_PATH.'/GeneradorItems.php');

    abstract class GeneradorBoton extends GeneradorItems {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        protected function crearItem($name, $texto) {
            return
            '<button class="boton" name="'.$name.'">
                        <span class="boton__span">'.
                            $texto
                        .'</span>
            </button>';
        }
        
    }
?>