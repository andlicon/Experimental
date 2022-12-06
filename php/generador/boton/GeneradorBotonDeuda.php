<?php 
    include_once(GENERADOR_PATH.'/boton/GeneradorBoton.php');

    final class GeneradorBotonDeuda extends GeneradorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            
            if($permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsulta();
                $botones = $botones.$this->crearItem("modificar", "modificar");
                $botones = $botones.$this->crearItem("eliminar", "eliminar");
                $botones = $botones.$this->crearItem("cargar", "cargar");
            }

            echo $botones;
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
                    <option>cedula</option>
                ';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }

    }
?>