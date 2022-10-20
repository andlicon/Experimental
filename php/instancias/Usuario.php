<?php
    class Usuario {
        private $nombre;        //nombre usuario
        private $contrasena;    //contrasena usuario
        private $tipoUsuario;   //id tipo usuario
        private $permiso;       //descripcion permisos

        /*
            Crea a un usuario asignando todos sus atributos

            @param $nombre      nombre del usuario
            @param $contrasena  contrasena del usuario
        */
        public function __construct($nombre, $contrasena, $tipoUsuario, $permiso) {
            $this->nombre = $nombre;
            $this->contrasena = $contrasena;
            $this->tipoUsuario = $tipoUsuario;
            $this->permiso = $permiso;
        }

        //SETTERS Y GETTERS
        /*
            @return nombre usuario
        */
        public function getNombre() {
            return $this->nombre;
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
        public function getTipoUsuario() {
            return $this->tipoUsuario;
        }
         /*
            @param $contrasena - es el nueva nombre a asignar
        */
        public function setTipoUsuario($tipoUsuario) {
            $this->tipoUsuario = $tipoUsuario;
        }
        /*
            @return descripcion de permisos
        */
        public function getPermiso() {
            return $this->Permiso;
        }
         /*
            @param $contrasena - es el nueva nombre a asignar
        */
        public function setPermisos($Permiso) {
            $this->Permiso = $Permiso;
        }
    }
?>