<?php
    class TipoPersona {
        private $id;
        private $descripcion;
        private $permiso;

        public function __construct($id, $descripcion, $permiso) {
            $this->id = $id;
            $this->descripcion = $descripcion;
            $this->permiso = $permiso;
        }

        public function getId() {
            return $this->id;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getPermiso() {
            return $this->permiso;
        }

        public function setId($id) {
            $this->id = $id;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
        public function setPermiso($permiso) {
            $this->permiso = $permiso;
        }
    }
?>