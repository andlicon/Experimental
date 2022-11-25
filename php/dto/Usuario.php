<?php
    class Usuario {
        private $cedula;
        private $nickname;        //nombre usuario
        private $contrasena;    //contrasena usuario
        private $valido;

        /*
            Crea a un usuario asignando todos sus atributos

            @param $nombre      nombre del usuario
            @param $contrasena  contrasena del usuario
        */
        public function __construct($cedula, $nickname, $contrasena, $valido) {
            $this->cedula = $cedula;
            $this->nickname = $nickname;
            $this->contrasena = $contrasena;
            $this->valido = $valido ? true : false;
        }


        //SETTERS Y GETTERS
        public function getCedula() {
            return $this->cedula;
        } 
        public function getNickname() {
            return $this->nickname;
        } 
        public function getContrasena() {
            return $this->contrasena;
        }
        public function getValido() {
            return $this->valido;
        }

        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        public function setNickname($nickname) {
            $this->nickname = $nickname;
        }
        public function setContrasena($contrasena) {
            $this->contrasena = $contrasena;
        }
        public function setValido($valido) {
            $this->valido = $valido ? true : false;
        }
    }
?>