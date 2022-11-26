<?php
    include_once(MENSAJE_PATH.'/Mensaje.php');
    include_once(MENSAJE_PATH.'/mandarMensaje.php');
    include_once(DTO_PATH.'/usuario.php');

    class Pagina {
        /*CONSTANTES*/
        const PERSONA = 1;
        const ESTUDIANTE = 2;
        const DEUDA = 3;
        const CONTACTO = 4;
        const LOGIN = 5;
        const OPCION = 6;
        const PROFESOR = 7;
        const CLASE = 8;
        const PAGO = 9;
    
        const USUARIO_OBJ = "usuario";


        /*ATRIBUTOS*/
        private $pagina;
        private $objSerializar;

        
        public function __construct($pagina) {
            $usuario = null;
            if(isset($_GET['usuario'])) {
                $usuarioGet = $_GET['usuario'];
                $usuario = unserialize($usuarioGet);
            }

            if($pagina==self::LOGIN) {
                $this->pagina = "Location: /php/interfaces/login/view.php";
                $this->objSerializar = "usuarios";
            }
            else {
                if($pagina==self::PERSONA) {
                    $this->pagina = 'Location: /php/interfaces/persona/view.php';
                    $this->objSerializar = "personas";
                }
                else if($pagina==self::ESTUDIANTE) {
                    $this->pagina = "Location: /php/interfaces/estudiante/view.php";
                    $this->objSerializar = "estudiantes";
                }
                else if($pagina==self::DEUDA) {
                    $this->pagina = "Location: /php/interfaces/deuda/view.php";
                    $this->objSerializar = "deudas";
                }
                else if($pagina==self::CONTACTO) {
                    $this->pagina = "Location: /php/interfaces/contacto/view.php";
                    $this->objSerializar = "contactos";
                }
                else if($pagina==self::OPCION) {
                    $this->pagina =  "Location: /php/interfaces/opcion/view.php";
                    $this->objSerializar = "tipo_usuario";
                }
                else if($pagina==self::PROFESOR) {
                    $this->pagina =  "Location: /php/interfaces/profesor/view.php";
                    $this->objSerializar = "personas";
                }
                else if($pagina==self::CLASE) {
                    $this->pagina =  "Location: /php/interfaces/clase/view.php";
                    $this->objSerializar = "estudiantes";
                }
                else if($pagina==self::PAGO) {
                    $this->pagina =  "Location: /php/interfaces/pago/view.php";
                    $this->objSerializar = "pagos";
                }
                else {
                    throw new Exception("No se introdujo ninguna pagina valida.");
                }

                $this->setUsuario($usuario);
            }
        }

        public function imprimirMensaje($keyLayout, $motivo, $mensaje) {
            $mensaje = new Mensaje($keyLayout, $motivo, $mensaje);
            mandarMensaje($mensaje, $this->pagina);
        }

        public function actualizarPagina($parametros) {
            if($parametros==null) {
                header($this->pagina);
                die();
            }

            $serialize = serialize($parametros);
            if(str_contains($this->pagina, "?")) {
                header($this->pagina.'&'.$this->objSerializar.'='.urlencode($serialize));
            }
            else {
                header($this->pagina.'?'.$this->objSerializar.'='.urlencode($serialize));
            }

            die();
            
            // if($parametros!=null) {
            //     $serialize = serialize($parametros);
            //     if( str_contains($this->pagina, "?") ) {
            //         header($this->pagina.'&'.$this->objSerializar.'='.urlencode($serialize));
            //     }
            //     else {
            //         header($this->pagina.'?'.$this->objSerializar.'='.urlencode($serialize));
            //     }
            // }
            // else {
            //     header($this->pagina);
            // }
            // die();
        }

        public function setUsuario($usuario) {
            if($usuario!=null) {
                $serialize = serialize($usuario);

                $this->pagina = $this->pagina.'?'.self::USUARIO_OBJ.'='.urlencode($serialize);
            }
        }
        public function getPagina() {
            return $this->pagina;
        }
        public function getObjSerializar() {
            return $this->objSerializar;
        }
    }
?>