<?php
    class Representante {
        private $id;
        private $cedula;        //Cedula del representante
        private $nombre;        //noombre del representante
        private $apellido;      //apellido del representante
        private $idTipoContacto; //id del tipo contacto
        private $tipoContacto;  //Descripcion de tipo de contacto
        private $contacto;      //correo del representante

        /*
            Crea una instancia representante asignando todos sus atributos.

            @param $cedula          cedula del representante
            @param $nombre          nombre del representante
            @param $apellido        apellido del representante
            @param $tipoContacto    tipo de contacto (tlf o correo)
            @param $contacto        contacto del representante
        */
        public function __construct($id, $cedula, $nombre, $apellido, 
                                    $idTipoContacto, $tipoContacto, $contacto) {
            $this->id = $id;
            $this->cedula = $cedula;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->idTipoContacto = $idTipoContacto;
            $this->tipoContacto = $tipoContacto;
            $this->contacto = $contacto;
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
            retorna el tipo de contacto.

            @return tipo de contacto
        */
        public function getTipoContacto() {
            return $this->tipoContacto;
        }
        /*
            Asigna un nuevo tipo de contacto

            @param $tipoContacto es el nuevo tipo de contacto
        */
        public function setTipoContacto($tipoContacto) {
            $this->tipoContacto = $tipoContacto;
        }
        /*
            @return contacto del representante
        */
        public function getContacto() {
            return $this->contacto;
        }
        /*
            @param $contacto - es el nuevo contacto del usuario
        */
        public function setContacto($contacto) {
            $this->contacto = $contacto;
        }

         /*
            @return id del tipo contacto
        */
        public function getidTipoContacto() {
            return $this->idTipoContacto;
        }
        /*
            @param $idTipoContacto - es el nuevo idTipoContacto
        */
        public function setidTipoContacto($idTipoContacto) {
            $this->idTipoContacto = $idTipoContacto;
        }
        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }
    }
?>