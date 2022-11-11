<?php
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');

    class Pagina {
        /*CONSTANTES*/
        const PERSONA = 1;
        const ESTUDIANTE = 2;
        const DEUDA = 3;
        const CONTACTO = 4;

        /*ATRIBUTOS*/
        private $pagina;
        private $objSerializar;

        public function __construct($pagina) {
            if($pagina==self::PERSONA) {
                $this->pagina = 'Location: personaView.php';
                $this->objSerializar = "personas";
            }
            else if($pagina==self::ESTUDIANTE) {
                $this->pagina = "Location: estudianteView.php";
                $this->objSerializar = "estudiantes";
            }
            else if($pagina==self::DEUDA) {
                $this->pagina = "Location: deudaView.php";
                $this->objSerializar = "deudas";
            }
            else if($pagina==self::CONTACTO) {
                $this->pagina = "Location: contactoView.php";
                $this->objSerializar = "contactos";
            }
            else {
                throw new Exception("No se introdujo ninguna pagina valida.");
            }
        }

        public function imprimirMensaje($keyLayout, $motivo, $mensaje) {
            $mensaje = new Mensaje($keyLayout, $motivo, $mensaje);
            mandarMensaje($mensaje, $this->pagina);
        }

        public function actualizarPagina($parametros) {

            if($parametros!=null) {
                $serialize = serialize($parametros);

                if( str_contains($this->pagina, "?") ) {
                    header($this->pagina.'&'.$this->objSerializar.'='.urlencode($serialize));
                }
                else {
                    header($this->pagina.'?'.$this->objSerializar.'='.urlencode($serialize));
                }

                die();
            }

            header($this->pagina);
        }

        public function extenderPagina($pagina) {
            $this->pagina = $this->pagina.$pagina;
        }
        public function getPagina() {
            return $this->pagina;
        }
        public function getObjSerializar() {
            return $this->objSerializar;
        }
    }
?>