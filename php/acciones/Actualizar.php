<?php 
    include_once('../conexion/IConsultor.php');
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');

    class Actualizar {
        private $dao;
        private $pagina;
        private $objSerializar;

        public function __construct(IConsultor $dao, $pagina, $objSerializar) {
            $this->dao = $dao;
            $this->pagina = $pagina;
            $this->objSerializar = $objSerializar;
        }

        public function actualizar() {
            try {
                $resultado = $this->dao->getTodos();

                $serialize = serialize($resultado);

                if( str_contains($this->pagina, "?") ) {
                    header($this->pagina.'&'.$this->objSerializar.'='.urlencode($serialize));
                }
                else {
                    header($this->pagina.'?'.$this->objSerializar.'='.urlencode($serialize));
                }
            }
            catch(Exception $e) {
                $mensaje = new Mensaje(null, false, "No hay ningun ".$this->objSerializar." cargado en la base de datos.");
                mandarMensaje($mensaje, $this->pagina);
            }
        }
    }
?>