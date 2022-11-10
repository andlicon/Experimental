<?php
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');

    class Pagina {
        /*CONSTANTES*/
        const PERSONA = 1;

        /*ATRIBUTOS*/
        private $pagina;
        private $objSerializar;

        public function __construct($pagina) {
            if($pagina==self::PERSONA) {
                $this->pagina = 'Location: personaView.php';
                $this->objSerializar = "personas";
            }
            else {
                throw new Exception("No se introdujo ninguna pagina valida.");
            }
        }

        public function imprimirMensaje($keyLayout, $motivo, $mensaje) {
            $mensaje = new Mensaje($keyLayout, $motivo, $mensaje);
            mandarMensaje($mensaje, $this->pagina);
        }


        public function getPagina() {
            return $this->pagina;
        }
        public function getObjSerializar() {
            return $this->objSerializar;
        }
    }
?>