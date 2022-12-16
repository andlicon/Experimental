<?php
    class Clase {
        private $id;
        private $descripcion;
        private $salon;
        private $cedulaProfesor;

        public function __construct($id, $descripcion, $salon, $cedulaProfesor) {
            $this->id = $id;
            $this->descripcion = $descripcion;
            $this->salon = $salon;
            $this->cedulaProfesor = $cedulaProfesor;
        }

        public function getId() {
            return $this->id;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getSalon() {
            return $this->salon;
        }
        public function getCedulaProfesor() {
            return $this->cedulaProfesor;
        }

        public function setId($id) {
            $this->id = $id;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
        public function setSalon($salon) {
            $this->salon = $salon;
        }
        public function setCedulaProfesor($cedulaProfesor) {
            $this->cedulaProfesor = $cedulaProfesor;
        }
    }
?>