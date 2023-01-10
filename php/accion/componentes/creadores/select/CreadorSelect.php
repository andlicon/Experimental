<?php
    include_once('../../../rutaAcciones.php');
    include_once(CREADORES_PATH.'ICreador.php');

    abstract class CreadorSelect implements ICreador {
        protected $dao;

        public function __construct($dao) {
            $this->dao = $dao;
        }

        public function crearItemAtributos($atributos, $id) {
            $consulta = $this->dao->getTodos();

            $html = "<div class=\"input__grupo\">
                        <select $atributos id=\"$id\" name=\"tipoPago\" $atributos>";
            $html = $html.$this->crearOption($consulta);
            $html = $html."
                        </select>
                    </div>";

            return $html;
        }

        public function crearItem($id) {
            return $this->crearItemAtributos("", $id);
        }

        protected function crearOption($consulta) {
            $options = "";

            for($i=0; $i<count($consulta); $i++) {
                $opcion = $consulta[$i];
                $idOpcion = $opcion->getId();
                $descripcionOpcion = $opcion->getDescripcion();
                
                $options = $options."<option value=\"$idOpcion\">$descripcionOpcion</option>";
            }

            return $options;
        }
    }
?>