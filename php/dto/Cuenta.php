<?php
    class Cuenta {
        private $id;
        private $descripcion;
        private $banco;
        private $rif;

        public function __construct($id, $descripcion, $banco, $rif) {
            $this->id = $id;
            $this->descripcion = $descripcion;
            $this->banco = $banco;
            $this->rif = $rif;
        }

        public function getId() {
            return $this->id;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getBanco() {
            return $this->banco;
        }
        public function getRif() {
            return $this->rif;
        }

        
        public function setId($id) {
            $this->id = $id;
        }
        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
        public function setBanco($banco) {
            $this->banco = $banco;
        }
        public function setRif($rif) {
            $this->rif = $rif;
        }
    }
?>