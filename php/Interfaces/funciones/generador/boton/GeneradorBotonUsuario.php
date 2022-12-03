<?php
    include_once(FUNCIONES_IG_PATH.'generador/boton/GeneradorBoton.php');

    final class GeneradorBotonUsuario extends GeneradorBoton {

        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();
            $botones = "";

            if($permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItem("validar", "Validar");
                $botones = $botones.$this->crearItem("invalidar", "Invalidar");
                $botones = $botones.$this->crearItem("cambiar-tipo", "Modificar");
                $botones = $botones.$this->crearItem("eliminar", "Eliminar");
            }

            echo $botones;
        }

    }
?>