<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonEstudiante extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '';
            if($this->permiso==4) {
                $botones = $botones.'<h2 class="botones__titulo">Consultar</h2>';
            }

            return $botones;
        }
    }
?>