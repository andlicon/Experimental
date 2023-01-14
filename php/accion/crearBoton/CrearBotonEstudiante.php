<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonEstudiante extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            if($this->permiso!=2) {       //PROFESOR
                if($this->permiso==4) {  //ADMINISTRADOR
                    $botones = $botones.$this->crearItem("consultar", "consultar");
                }
                else {                  //REPRESENTANTE y REPRESENTANTE-PROFESOR
                    $botones = $botones.$this->crearItem("consultar", "consultar");
                    $botones = $botones.$this->crearItem("cargar", "cargar");
                }
            }

            return $botones;
        }
    }
?>