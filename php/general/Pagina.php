<?php
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');
    include_once('../instancias/usuario.php');

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
    
        const USUARIO_OBJ = "usuario";


        /*ATRIBUTOS*/
        private $pagina;
        private $objSerializar;

        
        public function __construct($pagina) {
            if(isset($_GET['usuario'])) {
                $usuarioGet = $_GET['usuario'];
                $usuario = unserialize($usuarioGet);
            }

            if($pagina==self::PERSONA) {
                $this->pagina = 'Location: /php/interfazPersona/personaView.php';
                $this->objSerializar = "personas";
            }
            else if($pagina==self::ESTUDIANTE) {
                $this->pagina = "Location: /php/interfazEstudiante/estudianteView.php";
                $this->objSerializar = "estudiantes";
            }
            else if($pagina==self::DEUDA) {
                $this->pagina = "Location: /php/interfazDeuda/deudaView.php";
                $this->objSerializar = "deudas";
            }
            else if($pagina==self::CONTACTO) {
                $this->pagina = "Location: /php/interfazContacto/contactoView.php";
                $this->objSerializar = "contactos";
            }
            else if($pagina==self::LOGIN) {
                $this->pagina = "Location: /php/interfazLogin/loginView.php";
                $this->objSerializar = "usuarios";
            }
            else if($pagina==self::OPCION) {
                $this->pagina =  "Location: /php/interfazOpcion/opcionView.php";
                $this->objSerializar = "tipo_usuario";
            }
            else if($pagina==self::PROFESOR) {
                $this->pagina =  "Location: /php/interfazProfesor/profesorView.php";
                $this->objSerializar = "personas";
            }
            else if($pagina==self::CLASE) {
                $this->pagina =  "Location: /php/interfazClase/claserView.php";
                $this->objSerializar = "estudiantes";
            }
            else {
                throw new Exception("No se introdujo ninguna pagina valida.");
            }

            $this->setUsuario($usuario);
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
            }
            else {
                header($this->pagina);
            }
            die();
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