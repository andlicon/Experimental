<?php 
    include_once('../conexion/IConsultor.php');

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
                header($this->pagina.'?'.$this->objSerializar.'='.urlencode($serialize));
            }
            catch(Exception $e) {
                echo $e;
            }
        }
    }
?>