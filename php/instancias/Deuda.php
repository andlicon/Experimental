<?php
    class Deuda {
        private $id;
        private $cedula;
        private Motivo $motivo;
        private $fecha;
        private $montoInicial;
        private $montoEstado;

        public function __construct($id, $cedula, Motivo $motivo, $fecha, 
                                    $montoInicial, $montoEstado) {
            $this->id = $id;
            $this->cedula = $cedula;
            $this->motivo = $motivo;
            $this->montoInicial = $montoInicial;
            $this->montoEstado = $montoEstado;                   
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
        public function getMontoInicial() {
            return $this->montoInicial;
        }
        public function geMontoEstado() {
            return $this->montoEstado;
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
        public function setMontoInicial($montoInicial) {
            $this->montoInicial = $montoInicial;
        }
        public function setMontoEstado($montoEstado) {
            $this->montoEstado = $montoEstado;
        }
    }
?>