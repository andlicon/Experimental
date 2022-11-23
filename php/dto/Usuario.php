<?php
    class Usuario {
        private $id;
        private $nickname;        //nombre usuario
        private $contrasena;    //contrasena usuario
        private $idTipoUsuario;   //id tipo usuario
        private $valido;
        private $cedula;

        /*
            Crea a un usuario asignando todos sus atributos

            @param $nombre      nombre del usuario
            @param $contrasena  contrasena del usuario
        */
        public function __construct($id, $nickname, $contrasena, 
                                    $idTipoUsuario, $valido, $cedula) {
            $this->id = $id;
            $this->nickname = $nickname;
            $this->contrasena = $contrasena;
            $this->idTipoUsuario = $idTipoUsuario;
            $this-setValido($valido);
            $this->cedula = $cedula;
        }

        //SETTERS Y GETTERS
        /*
            @return nombre usuario
        */
        public function getNickname() {
            return $this->nickname;
        } 
        public function getCedula() {
            return $this->cedula;
        } 
        public function getValido() {
            return $this->valido;
        }
        public function getId() {
            return $this->id;
        }
        /*
            @param $nombre - nombre del nuevo nombre a asignar
        */
        public function setNickname($nickname) {
            $this->nickname = $nickname;
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
        public function setValido($valido) {
            $this->valido = $valido ? true : false;
        }
        public function setId($id) {
            $this->id = $id;
        }
    }
?>