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
                <h2>Cargar pago</h2>
                <div class=\"contenido__bloque\">
	                <label>Elegir deuda</label>
	                $selectDeuda
                </div>
                <div id=\"datos-deuda\">
                
                </div>
                <h4 class=\"popOver__informacion\">Pago a cargar<h4>
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
                <input class=\"boton\" id=\"cargar\" value=\"cargar\" />

                <script>
                    $(document).ready(function () {
                        $('#deudaInput').select2();
                    });
                </script>
                <script>    
                    $('#deudaInput').change(function() {
                        let deudaId = $('#deudaInput').val();

                        if(deudaId==0) {
                            $('#datos-deuda').html('');
                        }
                        else {
                            $.ajax ( {
                                url : '../../accion/consultar/cDeuda.php',
                                type : 'POST',
                                data : {deudaId: deudaId},
                                async: false,
                                success : function(response) {
                                    let json = JSON.parse(response);
                                
                                    let id = json[0].id;
                                    let cedula = json[0].cedula;
                                    let descripcion = json[0].descripcion;
                                    let montoInicial = json[0].montoInicial;
                                    let montoEstado = json[0].montoEstado;
                                    let debe = json[0].debe;
                                    let motivo = json[0].motivo;
                                    let nombreEstudiante = json[0].nombreEstudiante;
                                    let fecha = json[0].fecha;
                                
                                    $('#datos-deuda').html('<h4 class=\"popOver__informacion\">Informacion deuda<h4>'+
                                                            '<p class=\"popOver__elemento\"><span class=\"negrita\">Estudiante: </span>'+nombreEstudiante+'</p>'+
                                                           '<p class=\"popOver__elemento\"><span class=\"negrita\">Motivo: </span>'+motivo+'</p>'+
                                                           '<p class=\"popOver__elemento\"><span class=\"negrita\">Descripcion: </span>'+descripcion+'</p>'+
                                                           '<p class=\"popOver__elemento\"><span class=\"negrita\">Fecha: </span>'+fecha+'</p>'+
                                                           '<p class=\"popOver__elemento\"><span class=\"negrita\">Deuda: </span>'+debe+'</p>'
                                                            );
                                }
                            })
                        }
                    });
                </script>
                <script src=\"../js/limitador/soloNumeros.js\"></script>
                <script src=\"../js/limitador/soloTelefono.js\"></script>
                <script src=\"../js/limitador/soloAlfabeto.js\"></script>
                <script src=\"../js/limitador/soloAlfaNumerico.js\"></script>
                ";
            return $html;
        }
    }
?>