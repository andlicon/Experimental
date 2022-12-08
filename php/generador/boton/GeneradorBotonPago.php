<?php 
    include_once(GENERADOR_PATH.'/boton/GeneradorBoton.php');

    final class GeneradorBotonPago extends GeneradorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();

            $botones = '<h2 class="botones__titulo">Acciones</h2>';
            
            if($permiso==3 || $permiso==1) {  //Profesor y representante - representante
                $botones = $botones.$this->crearItem("consultar", "consultar");
                $botones = $botones.$this->crearItem("modificar", "modificar");
                $botones = $botones.$this->crearItem("eliminar", "eliminar");
                $botones = $botones.$this->crearItem("cargar", "cargar");
            }
            else if($permiso==4) {   //administrador
                $botones = $botones.$this->crearItemValidez();
                $botones = $botones.$this->crearItem("modificar", "modificar");
                $botones = $botones.$this->crearItem("eliminar", "eliminar");
            }

            echo $botones;
        }

    }
?>