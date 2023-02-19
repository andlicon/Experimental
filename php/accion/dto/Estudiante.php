<?php
    class Estudiante {
        private $id;
        private $nombre;
        private $apellido;
        private $fechaNacimiento;
        private $cedulaRepresentante;
        private $lugarNacimiento;
        private $idClase;
        private $valido;

        public function __construct($id, $nombre, $apellido, $fechaNacimiento, 
                                    $cedulaRepresentante, $idClase, $valido,
                                    $lugarNacimiento) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->fechaNacimiento = $fechaNacimiento;
            $this->cedulaRepresentante = $cedulaRepresentante;
            $this->idClase = $idClase;
            $this->valido = $valido;
            $this->lugarNacimiento = $lugarNacimiento;
        }

        public function getId() {
            return $this->id;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getApellido() {
            return $this->apellido;
        }
        public function getFechaNacimiento() {
            return $this->fechaNacimiento;
        }
        public function getCedulaRepresentante() {
            return $this->cedulaRepresentante;
        }
        public function getIdClase() {
            return $this->idClase;
        }
        public function getValido() {
            return $this->valido;
        }
        public function getLugarNacimiento() {
            return $this->lugarNacimiento;
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
        public function setCedulaRepresentante($cedulaRepresentante) {
            $this->cedulaRepresentante = $cedulaRepresentante;
        }
        public function setClase($idClase) {
            $this->idClase = $idClase;
        }
        public function setLugarNacimiento($idLugarNacimiento) {
            $this->idLugarNacimiento = $idLugarNacimiento;
        }
    }
?>