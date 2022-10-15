<?php
    class Usuario {
        //ATRIBUTOS
        private $nombre;        //nombre usuario
        private $contrasena;    //contrasena usuario

        //CONSTRUCTOR
        public function __construct($nombre, $contrasena) {
            $this->nombre = $nombre;
            $this->contrasena = $contrasena;
        }

        //SETTERS Y GETTERS
        public function getNombre() {
            return $this->nombre;
        } 
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function getContrasena() {
            return $this->contrasena;
        }
        public function setContrasena($contrasena) {
            $this->contrasena = $contrasena;
        }
    }
?>