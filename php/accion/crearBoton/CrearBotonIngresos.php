<?php 
    include_once('CreadorBoton.php');

    final class CrearBotonIngresos extends CreadorBoton {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function crearBotones() {
            $botones = '';
            if($this->permiso==4) {
                $botones = $botones.'<h2 class="botones__titulo">Consultar</h2>';
                $botones = $botones.'<div class="input__grupo">';
                $botones = $botones.$this->itemFecha();
            }

            return $botones;
        }
    }
?>