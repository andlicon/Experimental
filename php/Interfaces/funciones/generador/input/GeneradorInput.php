<?php 
    include_once(FUNCIONES_IG_PATH.'generador/GeneradorItems.php');

    abstract class GeneradorInput extends GeneradorItems {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        //Por defecto crea tipo texto
        protected function crearItem($name, $texto) {
            echo '
            <div class="input__grupo">
                    <label for="'.$name.'" class="input__label">'.$texto.'</label>
                    <input type="text" id="'.$name.'" name="'.$name.'" class="input__input input__input--texto">
            </div>';
        }

        protected function crearItemTipo($name, $texto, $tipo) {
            echo '
            <div class="input__grupo">
                    <label for="'.$name.'" class="input__label">'.$texto.'</label>
                    <input type="'.$tipo.'" id="'.$name.'" name="'.$name.'" class="input__input input__input--texto">
            </div>';
        }


        
    }
?>