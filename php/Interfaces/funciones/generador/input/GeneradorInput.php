<?php 
    include_once(FUNCIONES_IG_PATH.'generador/GeneradorItems.php');

    abstract class GeneradorInput extends GeneradorItems {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        //Por defecto crea tipo texto
        protected function crearItem($name, $texto) {
            return '
            <div class="input__grupo">
                    <label for="'.$name.'" class="input__label">'.$texto.'</label>
                    <input type="text" id="'.$name.'" name="'.$name.'" class="input__input input__input--texto">
            </div>';
        }

        protected function crearItemTipo($name, $texto, $tipo) {
            return '
            <div class="input__grupo">
                    <label for="'.$name.'" class="input__label">'.$texto.'</label>
                    <input type="'.$tipo.'" id="'.$name.'" name="'.$name.'" class="input__input input__input--texto">
            </div>';
        }

        protected function crearItemCedula() {
            return '
            <div class="input__grupo">
                <label for="nacionalidadInput" class="input__label">Nacionalidad</label>
                <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                    <option value="V-" class="input__select">V-</option>
                    <option value="E-" class="input__select">E-</option>
                </select>
                <label for="cedulaInput" class="input__label">Cedula</label>
                <input type="text" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto">
            </div>';
        }
        
    }
?>