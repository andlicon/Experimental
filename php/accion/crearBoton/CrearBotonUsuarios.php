<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonUsuarios extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            if($this->permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsultatipoUsuario();
            }

            return $botones;
        }

        protected function crearItemConsultatipoUsuario() {
            $item = 
            '<div class="input__grupo">';
            $item = $item.$this->crearItem("consultar", "Consultar");;
            $item = $item.
                '
                <label for="tipoUsuarioInput" class="input__label">tipoUsuario(s)</label>
                <select class="input__select" id="tipoUsuarioInput" name="tipoUsuarioInput">
                    <option value="todos">todos</option>
                    <option value="validos">validos</option>;
                    <option value="invalidos">invalidos</option>';
            $item = $item.
                '</select>
            </div>';
            return $item;
        }
    }
?>