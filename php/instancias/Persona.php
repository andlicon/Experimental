<?php
    class Persona {
        private $cedula;
        private $nombre;
        private $apellido;

        public function __construct($cedula, $nombre, $apellido) {
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        }

        public function getCedula() {
            return $this->cedula;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getApellido() {
            return $this->apellido;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }
    }

?>