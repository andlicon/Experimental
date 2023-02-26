<?php
    class Persona {
        private $cedula;
        private $nombre;
        private $apellido;
        private $idTipoPersona;
        private $direccionHogar;
        private $direccionTrabajo;

        public function __construct($cedula, 
                                    $nombre, 
                                    $apellido, 
                                    $idTipoPersona,
                                    $direccionHogar,
                                    $direccionTrabajo) {
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;    
            $this->idTipoPersona = $idTipoPersona;
            $this->direccionHogar = $direccionHogar;
            $this->direccionTrabajo = $direccionTrabajo;
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
        public function getDireccionHogar() {
            return $this->direccionHogar;
        }
        public function getDireccionTrabajo() {
            return $this->direccionTrabajo;
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
        public function setDireccionHogar($dirreccionHogar) {
            $this->direccionHogar = $dirreccionHogar;
        }
        public function setDireccionTrabajo($direccionTrabajo) {
            $this->direccionTrabajo = $direccionTrabajo;
        }
    }

?>