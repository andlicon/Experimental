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
            $selectTipoPago = $creadorSelectTipoPago->crearItem("tipoCuentaInput");

            $creadorSelectDeuda = new CreadorSelectDeuda();
            $selectDeuda = $creadorSelectDeuda->crearItemCedula("deudaInput", "", $this->cedula);

            $html = 
                "
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
	                <input type=\"text\" id=\"montoInput\">
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"cuentaInput\">Cuenta</label>
	                $selectCuenta
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"tipoCuentaInput\">Tipo Pago</label>
	                $selectTipoPago
                </div>
                <div class=\"contenido__bloque\">
	                <label for=\"ReferenciaInput\">Referencia</label>
	                <input type=\"text\" id=\"referenciaInput\">
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