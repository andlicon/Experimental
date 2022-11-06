<?php
    class Persona {
        private $cedula;
        private $nombre;
        private $apellido;
        private Contacto $contacto;

        public function __construct($cedula, $nombre, $apellido, Contacto $contacto) {
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->contacto = $contacto;
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
        public function getContacto() {
            return $this->contacto;
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
        public function setContacto($contacto) {
            $this->contacto = $contacto;
        }
    }

?>