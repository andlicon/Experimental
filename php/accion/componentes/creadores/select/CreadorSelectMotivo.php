<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once('CreadorSelect.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/MotivoConsul.php');

    class CreadorSelectMotivo extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new MotivoConsul(BaseDeDatos::getInstancia()));
        }



        protected function crearOption($consulta) {
            $options = "";

            for($i=0; $i<count($consulta); $i++) {
                $motivo = $consulta[$i];
                $id = $motivo->getId();
                $descripcion = $motivo->getDescripcion();

                $options = $options."<option value=\"$id\">$descripcion</option>";
            }

            return $options;
        }

        protected function crearOptionConsulta($consulta) {
            $options = "<option value=\"todos\">Todos</option>";

            for($i=0; $i<count($consulta); $i++) {
                $motivo = $consulta[$i];
                $id = $motivo->getId();
                $descripcion = $motivo->getDescripcion();

                $options = $options."<option value=\"$id\">$descripcion</option>";
            }

            return $options;
        }

    }

?>