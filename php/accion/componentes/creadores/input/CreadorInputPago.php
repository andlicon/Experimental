<?php
    include_once('CreadorInput.php');
    include_once('../select/CreadorSelectCuenta.php');
    include_once('../select/CreadorSelectTipoPago.php');
    include_once('../select/CreadorSelectDeuda.php');

    final class CreadorInputPago extends CreadorInput {
        private $cedula;

        public function __construct($permiso, $cedula) {
            parent::__construct($permiso);
            $this->cedula = $cedula;
        }

        public function crearItemAtributos($atributos, $id) {
            $creadorSelectCuenta = new CreadorSelectCuenta();
            $selectCuenta = $creadorSelectCuenta->crearItem("cuentaInput");

            $creadorSelectTipoPago = new CreadorSelectTipoPago();
            $selectTipoPago = $creadorSelectTipoPago->crearItem("tipoPagoInput");

            $creadorSelectDeuda = new CreadorSelectDeuda();
            $selectDeuda = $creadorSelectDeuda->crearItemCedula("deudaInput", "", $this->cedula);

            $html = 
                "
                <input class=\"boton\" id=\"cargar\" value=\"cargar\" />
                <div class=\"contenido__bloque\">
	                <label>Deuda</label>
	                $selectDeuda
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"fechaInput\">Fecha</label>
	                <input type=\"date\" id=\"fechaInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"montoInput\">Monto</label>
	                <input type=\"text\" onkeypress=\"return soloNumeros(8, 'montoInput')\" id=\"montoInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"cuentaInput\">Cuenta</label>
	                $selectCuenta
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"tipoPagoInput\">Tipo Pago</label>
	                $selectTipoPago
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"ReferenciaInput\">Referencia</label>
	                <input type=\"text\" onkeypress=\"return soloNumeros(8, 'referenciaInput')\" id=\"referenciaInput\">
                </div>

                <script>
                    $(document).ready(function () {
                        $('#deudaInput').select2();
                        <script src=\"../js/limitador/soloNumeros.js\"></script>
                        <script src=\"../js/limitador/soloTelefono.js\"></script>
                        <script src=\"../js/limitador/soloAlfabeto.js\"></script>
                        <script src=\"../js/limitador/soloAlfaNumerico.js\"></script>
                    });
                </script>
                ";
            return $html;
        }
    }
?>