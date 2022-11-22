<?php
    class Cuenta {
        private $id;
        private $nombre;
        private $banco;

        public function __construct($id, $nombre, $banco) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->banco = $banco;
        }

        public function getId() {
            return $this->id;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getBanco() {
            return $this->banco;
        }

        
        public function setId($id) {
            $this->id = $id;
        }
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        public function setBanco($banco) {
            $this->banco = $banco;
        }
    }
?>