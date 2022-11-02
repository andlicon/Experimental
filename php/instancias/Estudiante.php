<?php
    include_once('Clase.php');

    class Estudiante {
        private $id;
        private $nombre;
        private $apellido;
        private $fechaNacimiento;
        private $cedulaRepresentante;
        private Clase $clase;

        public function __construct($id, $nombre, $apellido, $fechaNacimiento, 
                                    $cedulaRepresentante, $clase) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->fechaNacimiento = $fechaNacimiento;
            $this->cedulaRepresentante = $cedulaRepresentante;
            $this->clase = $clase;
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
        public function getClase() {
            return $this->clase;
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
        public function setClase($clase) {
            $this->clase = $clase;
        }
    }
?>