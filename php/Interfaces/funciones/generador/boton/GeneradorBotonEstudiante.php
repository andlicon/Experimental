<?php 
    include_once(FUNCIONES_IG_PATH.'generador/boton/GeneradorBoton.php');

    final class GeneradorBotonEstudiante extends GeneradorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $botones = "";
            if($permiso!=2) {       //PROFESOR
                if($permiso==4) {  //ADMINISTRADOR
                    $botones = $botones.$this->crearItem("consultar-all", "consultar");
                    $botones = $botones.$this->crearItem("modificar", "modificar");
                    $botones = $botones.$this->crearItem("eliminar", "eliminar");
                    $botones = $botones.$this->crearItem("cargar", "cargar");
                }
                else {                  //REPRESENTANTE y REPRESENTANTE-PROFESOR
                    $botones = $botones.$this->crearItem("consultar-rep", "consultar");
                }
            }

            echo $botones;
        }
    }
?>