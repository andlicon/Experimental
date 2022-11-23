<?php
    class Persona {
        private $cedula;
        private $nombre;
        private $apellido;
        private $idTipoPersona;

        public function __construct($cedula, $nombre, $apellido, $idTipoPersona) {
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;    
            $this->idTipoPersona = $idTipoPersona;
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
        public function getIdTipoPersona() {
            return $this->idTipoPersona;
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
        public function setIdTipoPersona($idTipoPersona) {
            $this->idTipoPersona = $idTipoPersona;
        }
    }

?>