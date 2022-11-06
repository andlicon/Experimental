<?php
    class Contacto {
       private $cedula;
       private $idTipo;
       private $descripcion;
       private $contacto;

        public function __construct($cedula, $idTipo, $descripcion, $contacto) {
            $this->cedula = $cedula;
            $this->idTipo = $idTipo;
            $this->contacto = $contacto;
            $this->descripcion = $descripcion;
        }

        public function getCedula() {
            return $this->cedula;
        }
        public function getIdTipo() {
            return $this->idTipo;
        }
        public function getContacto() {
            return $this->contacto;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function setIdTipo($idTipo) {
            $this->idTipo = $idTipo;
        }
        public function setContacto($contacto) {
            $this->contacto = $contacto;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
    }

?>