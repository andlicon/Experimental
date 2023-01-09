<?php
    include_once('../../../rutaAcciones.php');
    include_once('CreadorSelect.php');
    include_once(DAO_PATH.'/TipoPagoConsul.php');

    class CreadorSelectTipoPago extends CreadorSelect {
        private $dao;
        
        public function __construct() {
            parent::__construct(new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', ''));
            $this->dao = new TipoPagoConsul($this->bd);
        }

        public function crearItemAtributos($atributos, $id) {
            $consulta = $this->dao->getTodos();

            $html = "<div class=\"input__grupo\">
                        <select $atributos id=\"$id\" name=\"tipoPago\" $atributos>";
            $html = $html.$this->crearOption($consulta);

            return $html;
        }

        public function crearItem($id) {
            return $this->crearItemAtributos($id);
        }
    }
?>