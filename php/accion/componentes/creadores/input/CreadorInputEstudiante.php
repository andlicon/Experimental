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
                <h2>Registrar nuevo estudiante</h2>
            <div class=\"marco-deuda\">
                <div class=\"formu\">
	                <input type=\"text\" onkeypress=\"return soloAlfabeto(15, 'nombreInput')\"  id=\"nombreInput\">
                    <span></span>
                    <label for=\"nombreInput\">Nombre</label>
                </div>
                <div class=\"formu\">
	                <input type=\"text\" onkeypress=\"return soloAlfabeto(15, 'apellidoInput')\"  id=\"apellidoInput\">
                    <span></span>
                    <label for=\"apellidoInput\">Apellido</label>
                </div>
                <div class=\"formu\">
                    <input type=\"date\" id=\"fechaInput\">
                    <span></span>
	                <label for=\"fechaInput\">Fecha nacimiento</label>
                </div>
                <div class=\"formu\">
                    <textarea id=\"lugarInput\" onkeypress=\"return soloAlfaNumerico(50, 'lugarInput')\" class=\"textarea\"></textarea>
                    <span></span>
                    <label for=\"lugarInput\">Lugar nacimiento</label>
                </div>
                <div class=\"formu\">
	                $selectClase
                    <span></span>
                    <label for=\"claseInput\">Clase</label>
                </div>
            </div>

                <input class=\"boton btn\" id=\"cargar\" value=\"cargar\" />

                <script src=\"../js/limitador/soloNumeros.js\"></script>
                <script src=\"../js/limitador/soloTelefono.js\"></script>
                <script src=\"../js/limitador/soloAlfabeto.js\"></script>
                <script src=\"../js/limitador/soloAlfaNumerico.js\"></script>
                ";

            return $html;
        }
    }
?>

<!-- 
<script>
    $(document).ready(function () {
        $('#deudaInput').select2();
        <script src=\"../js/limitador/soloNumeros.js\"></script>
        <script src=\"../js/limitador/soloTelefono.js\"></script>
        <script src=\"../js/limitador/soloAlfabeto.js\"></script>
        <script src=\"../js/limitador/soloAlfaNumerico.js\"></script>
    });
</script>
"; -->