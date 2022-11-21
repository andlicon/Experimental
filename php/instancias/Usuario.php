<?php
    class Usuario {
        private $nombre;        //nombre usuario
        private $contrasena;    //contrasena usuario
        private $idTipoUsuario;   //id tipo usuario
        private $cedula;

        /*
            Crea a un usuario asignando todos sus atributos

            @param $nombre      nombre del usuario
            @param $contrasena  contrasena del usuario
        */
        public function __construct($nombre, $contrasena, $idTipoUsuario, $cedula) {
            $this->nombre = $nombre;
            $this->contrasena = $contrasena;
            $this->idTipoUsuario = $idTipoUsuario;
            $this->cedula = $cedula;
        }

        //SETTERS Y GETTERS
        /*
            @return nombre usuario
        */
        public function getNombre() {
            return $this->nombre;
        } 
        public function getCedula() {
            return $this->cedula;
        } 
        /*
            @param $nombre - nombre del nuevo nombre a asignar
        */
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        /*
            @return contrasena del usuario
        */
        public function getContrasena() {
            return $this->contrasena;
        }
         /*
            @param $contrasena - es el nueva nombre a asignar
        */
        public function setContrasena($contrasena) {
            $this->contrasena = $contrasena;
        }
        /*
            @return tipo usuario
        */
        public function getIdTipoUsuario() {
            return $this->idTipoUsuario;
        }
         /*
            @param $contrasena - es el nueva nombre a asignar
        */
        public function setIdTipoUsuario($tipoUsuario) {
            $this->idTipoUsuario = $idTipoUsuario;
        }
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
    }
?>