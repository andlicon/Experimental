<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonUsuarios extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            if($this->permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItem("consultar", "consultar");
            }

            return $botones;
        }
    }
?>