<?php
    include_once('CreadorInput.php');
    include_once('../select/CreadorSelectMotivo.php');
    include_once('../select/CreadorSelectEstudiante.php');

    final class CreadorInputDeuda extends CreadorInput {

        public function __construct($permiso) {
            parent::__construct($permiso);
        }

        public function crearItemAtributos($atributos, $id) {
            //selects
            $creadorSelectMotivo= new CreadorSelectMotivo();
            $selectMotivo = $creadorSelectMotivo->crearItem("motivoInput");
            $creadorSelectEstudiante = new CreadorSelectEstudiante();
            $selectEstudiante = $creadorSelectEstudiante->crearItem("estudianteInput");

            $html = 
                "
                <input class=\"boton\" id=\"cargar\" value=\"cargar\" />

                <div class=\"contenido__bloque\">
	                <label for=\"estudianteInput\">Estudiante</label>
	                $selectEstudiante
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"motivoInput\">Motivo</label>
	                $selectMotivo
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"descripcionInput\">Descripcion</label>
	                <input type=\"text\" id=\"descripcionInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"fechaInput\">fecha</label>
	                <input type=\"date\" id=\"fechaInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"montoInicialInput\">Monto:</label>
	                <input type=\"text\" id=\"montoInicialInput\">
                </div>

                <script>
                    $(document).ready(function () {
                        $('#estudianteInput').select2();
                    });
                </script>
                ";
            return $html;
        }
    }
?>