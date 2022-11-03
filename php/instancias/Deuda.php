<?php
    class Deuda {
        private $id;
        private $cedula;
        private Motivo $motivo;
        private $fecha;
        private $debe;

        public function __construct($id, $cedula, Motivo $motivo, 
                                    $fecha, $debe) {
            $this->id = $id;
            $this->cedula = $cedula;
            $this->motivo = $motivo;
            $this->fecha = $fecha;
            $this->debe = $debe;                  
        } 

        public function getId() {
            return $this->id;
        }
        public function getCedula() {
            return $this->cedula;
        }
        public function getMotivo() {
            return $this->motivo;
        }
        public function getFecha() {
            return $this->fecha;
        }
        public function getDebe() {
            return $this->debe;
        }

        public function setId($id) {
            $this->id = $id;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setMotivo($motivo) {
            $this->motivo = $motivo;
        }
        public function setDebe($debe) {
            $this->debe = $debe;
        }
    }
?>