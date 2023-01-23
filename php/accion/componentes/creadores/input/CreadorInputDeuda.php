<?php
    include_once('CreadorInput.php');
    include_once('../select/CreadorSelectMotivo.php');


    final class CreadorInputDeuda extends CreadorInput {

        public function __construct($permiso) {
            parent::__construct($permiso);
        }

        public function crearItemAtributos($atributos, $id) {
            $creadorSelectMotivo= new CreadorSelectMotivo();
            $selectMotivo = $creadorSelectMotivo->crearItem("motivoInput");

            $html = 
                "
                <input class=\"boton\" id=\"cargar\" value=\"cargar\" />

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
                        $('#deudaInput').select2();
                    });
                </script>
                ";
            return $html;
        }
    }
?>

<!--
    <div class=\"contenido__bloque\">
	    <label for=\"claseInput\">Clase</label>
	    $selectClase
    </div> 
-->