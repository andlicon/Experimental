<?php
    class Contacto {
       private $id;
       private $cedula;
       private $idTipo;
       private $contacto;

        public function __construct($id, $cedula, $idTipo, $contacto) {
            $this->id = $id;
            $this->cedula = $cedula;
            $this->idTipo = $idTipo;
            $this->contacto = $contacto;
        }

        public function getId() {
            return $this->id;
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
        public function setIdTipo($idTipo) {
            $this->idTipo = $idTipo;
        }
        public function setContacto($contacto) {
            $this->contacto = $contacto;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setId($id) {
            $this->id = $id;
        }
    }

?>