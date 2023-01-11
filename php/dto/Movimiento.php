<?php
    class Movimiento {
        private $referencia;
        private $fecha;
        private $descripcion;
        private $monto;

        public function __construct($referencia, $fecha, $descripcion, $monto) {
            $this->referencia = $referencia;
            $this->fecha = $fecha;
            $this->descripcion = $descripcion;
            $this->monto = $monto;
        }

        public function getReferencia() {
            return $this->referencia;
        }
        public function getFecha() {
            return $this->fecha;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getMonto() {
            return $this->monto;
        }
    }
?>