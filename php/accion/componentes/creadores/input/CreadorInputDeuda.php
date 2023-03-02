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
            <div class=\"marco-deuda margin--top\">
                <h4 class=\"popOver__informacion formu--titulo corregir\">Cargar Deuda</h4>
                <div id=\"papa\" class=\"formu\">
                    <div class=\"input__grupo\">$selectEstudiante</div>
                    <span></span>
	                <label class=\"negrita\" for=\"estudianteInput\">Estudiante</label>
                </div>
                <div class=\"formu\">
                    $selectMotivo
                    <span></span>
	                <label class=\"negrita\" for=\"motivoInput\">Motivo</label>
                </div>
                <div class=\"formu\">
                    <input type=\"text\" onkeypress=\"return soloAlfaNumerico(50, 'descripcionInput')\" id=\"descripcionInput\">
                    <span></span>
	                <label class=\"negrita\" for=\"descripcionInput\">Descripcion</label>
                </div>
                <div class=\"formu\">
                    <input type=\"date\" id=\"fechaInput\">
                    <span></span>
	                <label class=\"negrita\" for=\"fechaInput\">fecha</label>
                </div>
                <div class=\"formu\">
                    <input onkeypress=\"return soloNumeros(8, 'montoInicialInput')\" type=\"text\" id=\"montoInicialInput\">
                    <span></span>
	                <label class=\"negrita\" for=\"montoInicialInput\">Monto:</label>
                </div>
            </div>

            <input class=\"boton btn\" id=\"cargar\" value=\"cargar\" />

            <script>
                $(document).ready(function () {
                    $('#estudianteInput').select2();
                });
            </script>
            <script>
                $(document).ready(function () {
                    $('#deudaInput').select2();
                });
            </script>
            <script src=\"../js/limitador/soloNumeros.js\"></script>
            <script src=\"../js/limitador/soloTelefono.js\"></script>
            <script src=\"../js/limitador/soloAlfabeto.js\"></script>
            <script src=\"../js/limitador/soloAlfaNumerico.js\"></script>";



            return $html;
        }
    }
?>