<?php
    class TipoUsuario {
        private $id;
        private $nombre;
        private $permiso;

        public function __construct($id, $nombre, $permiso) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->permiso = $permiso;
        }

        public function getId() {
            return $this->id;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getPermiso() {
            return $this->permiso;
        }

        public function setId($id) {
            $this->id = $id;
        }
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        public function setPermiso($permiso) {
            $this->permiso = $permiso;
        }
    }
?>