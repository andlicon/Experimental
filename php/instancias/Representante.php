<?php
    class Representante {
        private $cedula;        //Cedula del representante
        private $nombre;        //noombre del representante
        private $apellido;      //apellido del representante
        private $correo;        //correo del representante

        /*
            Crea una instancia representante asignando todos sus atributos.

            @param $cedula      cedula del representante
            @param $nombre      nombre del representante
            @param $apellido    apellido del representante
            @param $correo      correo del representante
        */
        public function construct($cedula, $nombre, $apellido, $correo) {
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->correo = $correo;
        }

        //GETTERS y SETTERS
        /*
            @return cedula del usuario
        */
        public function getCedula() {
            return $this->cedula;
        }
        /*
            $cedula $cedula - nueva cedula del representante
        */
        public function setCedula($cedula) {
            $this->cedula = $cedula;
        }
        /*
            @return nombre del representante
        */
        public function getNombre() {
            return $this->nombre;
        } 
        /*
            @param $nombre - es el nuevo nombre a asignar
        */
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        /*
            @return apellido del representante
        */
        public function getApellido() {
            return $this->apellido;
        }
        /*
            @param $apellido - nuevo apellido del representante
        */
        public function setApellido($apellido) {
            $this->apellido = $apellido;
        }
        /*
            @return correo del representante
        */
        public function getCorreo() {
            return $this->correo;
        }
        /*
            @param $correo - es el nuevo correo del usuario
        */
        public function setCorreo($correo) {
            $this->correo = $correo;
        }
    }
?>