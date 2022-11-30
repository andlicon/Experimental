<?php 
    include_once(FUNCIONES_IG_PATH.'generador/boton/GeneradorBoton.php');

    final class GeneradorInputEstudiante extends GeneradorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $inputs = "";
            if($permiso!=2) {       //PROFESOR
                if($permiso==4) {  //ADMINISTRADOR
                    $inputs = $inputs.$this->crearItem("consultar-all", "consultar");
                    $inputs = $inputs.$this->crearItem("modificar", "modificar");
                    $inputs = $inputs.$this->crearItem("eliminar", "eliminar");
                    $inputs = $inputs.$this->crearItem("cargar", "cargar");
                }
                else {                  //REPRESENTANTE y REPRESENTANTE-PROFESOR
                    $inputs = $inputs.$this->crearItem("consultar-rep", "consultar");
                }
            }

            echo $inputs;
        }
    }
?>