<?php 
    include_once('../conexion/IConsultor.php');
    include_once('../formulario/Mensaje.php');
    include_once('../general/mandarMensaje.php');

    class Consultar {
        private $dao;
        private $pagina;
        private $objSerializar;

        public function __construct(IConsultor $dao, $pagina, $objSerializar) {
            $this->dao = $dao;
            $this->pagina = $pagina;
            $this->objSerializar = $objSerializar;
        }

        public function consultar($parametros) {
            try {
                $resultado = $this->dao->getInstancia($parametros);

                $serialize = serialize($resultado);
                header($this->pagina.'?'.$this->objSerializar.'='.urlencode($serialize));
            }
            catch(Exception $e) {
                $mensaje = new Mensaje(null, false, "Cedula no pertenece a ningun ".$this->objSerializar.".");
                mandarMensaje($mensaje, $this->pagina);
            }
        }
    }
?>