<?php
    class Contacto {
       private $cedula;
       private $idTipo;
       private $contacto;

        public function _constrct($cedula, $idTipo, $contacto) {
            $this->cedula = $cedula;
            $this->idTipo = $idTipo;
            $this->contacto = $contacto;
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
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setIdTipo($idTipo) {
            $this->idTipo = $idTipo;
        }
        public function setContacto($contacto) {
            $this->contacto = $contacto;
        }
    }

?>