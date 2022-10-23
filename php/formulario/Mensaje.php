<?php
    /* 
        Es un mensaje a ser enviado a traves de las paginas de la aplicacion.
        Es una representacion del exito o error de los procesos.
    */
    class Mensaje { 

        private $keyInput;      //Key input, permite relacionar el mensaje con un elemento HTML.
        private $motivo;        //true:exito    false:error
        private $mensaje;       //Mensaje que sera impreso

        /*
            Constructor, permite crear un nuevo mensaje

            @param $keyInput    Representa el objeto HTML.
            @param $motivo      Motivo del mensaje.
                                <ul>
                                    <li>true: exito</li>
                                    <li>false: error</li>
                                </ul>
            @param mensaje      Es el mensaje a ser enviado.
        */
        public function __construct($keyInput, $motivo, $mensaje) {
            $this->keyInput = $keyInput;
            $this->motivo = $motivo;
            $this->mensaje = $mensaje;
        }

        /*
            Retorna String que representa el KeyInput

            @return keyInput
        */
        public function getKeyInput() {
            return $this->keyInput;
        }
        /*
            Asigna un key input.

            @param $keyInput key input a ser asignado
        */
        public function setKeyInput($keyInput) {
            $this->keyInput = $keyInput;
        }
        /*
            retorna el motivo del mensaje.

            @return motivo mensaje.
        */
        public function getMotivo() {
            return $this->motivo;
        }
        /*
            Asigna un motivo

            @param #motivo nuevo motivo a asignar
        */
        public function setMotivo($motivo) {
            $this->motivo = $motivo;
        }
        /*
            retorna el mensaje.

            @return mensaje
        */
        public function getMensaje() {
            return $this->mensaje;
        }
        /*
            Asigna un nuevo mensaje

            @param nuevo mensaje
        */
        public function setMensaje($mensaje) {
            $this->mensaje = $mensaje;
        }
    }
?>