<?php
    include_once('CreadorInput.php');
    include_once('../select/CreadorSelectClase.php');


    final class CreadorInputEstudiante extends CreadorInput {
        private $cedula;

        public function __construct($permiso, $cedula) {
            parent::__construct($permiso);
            $this->cedula = $cedula;
        }

        public function crearItemAtributos($atributos, $id) {
            $creadorSelectClase = new CreadorSelectClase();
            $selectClase = $creadorSelectClase->crearItem("claseInput");

            $html = 
                "
                <div class=\"contenido__bloque\">
	                <label for=\"nombreInput\">Nombre</label>
	                <input type=\"text\" id=\"nombreInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"apellidoInput\">Apellido</label>
	                <input type=\"text\" id=\"apellidoInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"fechaInput\">Fecha nacimiento</label>
	                <input type=\"date\" id=\"fechaInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"claseInput\">Clase</label>
	                $selectClase
                </div>

                <script>
                    $(document).ready(function () {
                        $('#deudaInput').select2();
                    });
                </script>
                ";
            return $html;
        }
    }
?>