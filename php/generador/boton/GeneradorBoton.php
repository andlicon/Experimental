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

        protected function crearItemConsulta() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("consultar", "Consultar");;
            $item = $item.
                '
                <label for="tipoConsulta" class="input__label">Tipo consulta</label>
                <select class="input__select" id="tipoConsulta" name="tipoConsulta">
                    <option>todos</option>
                    <option>validos</option>
                    <option>invalidos</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }
        
    }
?>