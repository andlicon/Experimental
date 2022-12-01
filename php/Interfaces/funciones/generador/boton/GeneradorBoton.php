<?php 
    include_once(FUNCIONES_IG_PATH.'generador/GeneradorItems.php');

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