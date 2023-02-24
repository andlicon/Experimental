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
                <input class=\"boton\" id=\"cargar\" value=\"cargar\" />
                <div class=\"contenido__bloque\">
	                <label for=\"nombreInput\">Nombre</label>
	                <input type=\"text\" onkeypress=\"return soloAlfabeto(15, 'nombreInput')\"  id=\"nombreInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"apellidoInput\">Apellido</label>
	                <input type=\"text\" onkeypress=\"return soloAlfabeto(15, 'apellidoInput')\"  id=\"apellidoInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"fechaInput\">Fecha nacimiento</label>
	                <input type=\"date\" id=\"fechaInput\">
                </div>
                <div class=\"contenido__bloque\">
                    <label for=\"lugarInput\">Lugar nacimiento</label>
                    <input type=\"text\" id=\"lugarInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"claseInput\">Clase</label>
	                $selectClase
                </div>

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