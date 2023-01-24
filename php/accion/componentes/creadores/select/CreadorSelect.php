<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once(CREADORES_PATH.'ICreador.php');

    abstract class CreadorSelect implements ICreador {
        protected $dao;

        public function __construct($dao) {
            $this->dao = $dao;
        }

        public function crearItemAtributos($atributos, $id) {
            return $this->crearItemAtributosSeleccion($atributos, $id, null);
        }

        public function crearItemAtributosSeleccion($atributos, $id, $seleccion) {
            $consulta = $this->dao->getTodos();

            $html = "<div class=\"input__grupo\">
                        <select id=\"$id\" name=\"$id\" $atributos>";
            $html = $html.$this->crearOption($consulta, $seleccion);
            $html = $html."
                        </select>
                    </div>";

            return $html;
        }

        public function crearItem($id) {
            return $this->crearItemAtributos("", $id);
        }

        protected function crearOption($consulta, $seleccion) {
            $options = "";

            for($i=0; $i<count($consulta); $i++) {
                $opcion = $consulta[$i];
                $idOpcion = $opcion->getId();
                $descripcionOpcion = $opcion->getDescripcion();
                
                $seleccionar = $seleccion==$idOpcion ? "selected" : "";
                
                $options = $options."<option value=\"$idOpcion\" $seleccionar>$descripcionOpcion</option>";
            }

            return $options;
        }
        
    }
?>