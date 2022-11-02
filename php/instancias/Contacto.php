<?php
    class Contacto {
       private $idTipo;
       private $descripcion;
       private $contacto;

        public function __construct($idTipo, $contacto, $descripcion) {
            $this->idTipo = $idTipo;
            $this->contacto = $contacto;
            $this->descripcion = $descripcion;
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
    }

?>