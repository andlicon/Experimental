<?php
    include_once('../ICreador.php');

    abstract class CreadorInput implements ICreador {
        protected $permiso;

        public function __construct($permiso) {
            $this->permiso = $permiso;
        }

        public function crearItem($id) {
            return $this->crearItemAtributos("", $id);
        }
    }
?>