<?php
    class Estudiante {
        private $id;
        private $nombre;
        private $apellido;
        private $fechaNacimiento;
        private $idRepresentante;
        private $cedulaRepresentante;
        private $idClase;

        public function __construct($id, $nombre, $apellido, $fechaNacimiento, 
                                    $idRepresentante, $cedulaRepresentante,
                                    $idClase) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->fechaNacimiento = $fechaNacimiento;
            $this->idRepresentante = $idRepresentante;
            $this->cedulaRepresentante = $cedulaRepresentante;
            $this->idClase = $idClase;
        }

        public function getId() {
            return $id;
        }
        public function getNombre() {
            return $nombre;
        }
        public function getApellido() {
            return $apellido;
        }
        public function getFecha_nacimiento() {
            return $fechaNacimiento;
        }
        public function getIdRepresentante() {
            return $idRepresentante;
        }
        public function getCedulaRepresentante() {
            return $cedulaRepresentante;
        }
        public function getIdClase() {
            return $idClase;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }
        public function setFechaNacimiento($fechaNacimiento) {
            $this->fechaNacimiento = $fechaNacimiento;
        }
        public function setIdRepresentante($idRepresentante) {
            $this->idRepresentante = $idRepresentante;
        }
        public function setCedulaRepresentante($cedulaRepresentante) {
            $this->cedulaRepresentante = $cedulaRepresentante;
        }
        public function setIdClase($idClase) {
            $this->idClase = $idClase;
        }
    }
?>