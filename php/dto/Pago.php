<?php
    class Pago {
        private $id;
        private $idDeuda;
        private $fecha;
        private $cedula;
        private $monto;
        private $idCuenta;
        private $idTipoPago;
        private $ref;

        public function __construct($id, $idDeuda, $fecha, $cedula, 
                                    $monto, $idCuenta, $idTipoPago, 
                                    $ref) {
            $this->id = $id;
            $this->idDeuda = $idDeuda;
            $this->fecha = $fecha;
            $this->cedula = $cedula;
            $this->monto = $monto;
            $this->idCuenta = $idCuenta;
            $this->idTipoPago = $idTipoPago;
            $this->ref = $ref;
        }

        public function getId() {
            return $this->id;
        }
        public function getIdDeuda() {
            return $this->idDeuda;
        }
        public function getFecha() {
            return $this->fecha;
        }
        public function getCedula() {
            return $this->cedula;
        }
        public function getMonto() {
            return $this->monto;
        }
        public function getIdCuenta() {
            return $this->idCuenta;
        }
        public function getIdTipoPago() {
            return $this->idTipoPago;
        }
        public function getRef() {
            return $this->ref;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
        public function setIdDeuda($idDeuda) {
            $this->idDeuda = $idDeuda;
        }
        public function setFecha($fecha) {
            $this->fecha = $fecha;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setMonto($monto) {
            $this->monto = $monto;
        }
        public function setIdCuenta($idCuenta) {
            $this->idCuenta = $idCuenta;
        }
        public function setIdTipoPago($idTipoPago) {
            $this->idTipoPago = $idTipoPago;
        }
        public function setRef($ref) {
            $this->ref = $ref;
        }
    }
?>