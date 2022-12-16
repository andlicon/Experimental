<?php
    class Deuda {
        private $id;
        private $cedula;
        private $idEstudiante;
        private $idMotivo;
        private $descripcion;
        private $fecha;
        private $montoInicial;
        private $montoEstado;
        private $deuda;

        public function __construct($id, $cedula, $idEstudiante, $idMotivo, 
                                    $descripcion, $fecha, $montoInicial, 
                                    $montoEstado, $deuda) {
            $this->id = $id;
            $this->cedula = $cedula;
            $this->idEstudiante = $idEstudiante;
            $this->idMotivo = $idMotivo;
            $this->descripcion = $descripcion;
            $this->fecha = $fecha;
            $this->montoInicial = $montoInicial;
            $this->montoEstado = $montoEstado;
            $this->deuda = $deuda;                  
        } 

        public function getId() {
            return $this->id;
        }
        public function getCedula() {
            return $this->cedula;
        }
        public function getidMotivo() {
            return $this->idMotivo;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getFecha() {
            return $this->fecha;
        }
        public function getMontoInicial() {
            return $this->montoInicial;
        }
        public function getMontoEstado() {
            return $this->montoEstado;
        }
        public function getDeuda() {
            return $this->deuda;
        }
        public function getIdEstudiante() {
            return $this->idEstudiante;
        }

        public function setId($id) {
            $this->id = $id;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setidMotivo($idMotivo) {
            $this->idMotivo = $idMotivo;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
        public function setMontoInicial($montoInicial) {
           $this->montoInicial = $montoInicial;
        }
        public function setMontoEstado($montoEstado) {
            $this->montoEstado = $montoEstado;
        }
        public function setDeuda($deuda) {
            $this->deuda = $deuda;
        }
        public function setIdEstudiante($idEstudiante) {
            $this->idEstudiante = $idEstudiante;
        }
    }
?>