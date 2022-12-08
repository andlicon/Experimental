<?php
    include_once(GENERADOR_PATH.'/boton/GeneradorBoton.php');

    final class GeneradorBotonUsuario extends GeneradorBoton {

        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();
            $botones = "";

            if($permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItemConsulta();
                $botones = $botones.$this->crearItemValidez();
                $botones = $botones.$this->crearItem("eliminar", "Eliminar");
            }

            echo $botones;
        }
        
    }

?>