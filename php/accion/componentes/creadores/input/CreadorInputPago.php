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
                <div class=\"contenido__bloque\" style=\"display:flex; justify-content:center;\">
	                <label>Elegir deuda</label>
	                $selectDeuda
                </div>
            <div class=\"ladito\">
                <div id=\"datos-deuda\" class=\"ocultar ladito--contenido\">
            
                </div>
                <div class=\"marco-deuda ladito--contenido\">
                    <h4 class=\"popOver__informacion formu--titulo\">Pago a cargar</h4>
                    <div class=\"formu\">
	                    <input type=\"date\" id=\"fechaInput\">
                        <span></span>
                        <label for=\"fechaInput\">Fecha</label>
                    </div>
                    <div class=\"formu\">
                        <span></span>
	                    <input type=\"text\" onkeypress=\"return soloNumeros(8, 'montoInput')\" id=\"montoInput\">
                        <label for=\"montoInput\">Monto</label>
                    </div>
                    <div class=\"formu\">
                        <span></span>
                        $selectCuenta
	                    <label for=\"cuentaInput\">Cuenta</label>
                    </div>
                    <div class=\"formu\">
                        <span></span>
                        $selectTipoPago
	                    <label for=\"tipoPagoInput\">Tipo Pago</label>
                    </div>
                    <div class=\"formu\">
                        <span></span>
	                    <input type=\"text\" onkeypress=\"return soloNumeros(8, 'referenciaInput')\" id=\"referenciaInput\">
                        <label for=\"ReferenciaInput\">Referencia</label>
                    </div>
                </div>
            </div>
            <input class=\"boton btn\" id=\"cargar\" value=\"cargar\" />
                <script>
                    $(document).ready(function () {
                        $('#deudaInput').select2();
                    });
                </script>
                <script>    
                    $('#deudaInput').change(function() {
                        let deudaId = $('#deudaInput').val();

                        if(deudaId==0) {
                            $('#datos-deuda').removeClass('marco-deuda');
                            $('#datos-deuda').addClass('ocultar');
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
                                
                                    $('#datos-deuda').html('<h4 class=\"popOver__informacion formu--titulo\">Información deuda seleccionada<h4>'+
                                                            '<div class=\"formu\">'+
                                                                '<input type=\"text\" value='+nombreEstudiante+' disabled>'+
                                                                '<span></span>'+
                                                                '<label class=\"negrita\">Estudiante</label>'+
                                                            '</div>'+
                                                            '<div class=\"formu\">'+
                                                                '<input type=\"text\" value='+motivo+' disabled>'+
                                                                '<span></span>'+
                                                                '<label class=\"negrita\">Motivo</label>'+
                                                            '</div>'+
                                                            '<div class=\"formu\">'+
                                                                '<input type=\"text\" value='+descripcion+' disabled>'+
                                                                '<span></span>'+
                                                                '<label class=\"negrita\">Descripcion</label>'+
                                                            '</div>'+
                                                            '<div class=\"formu\">'+
                                                                '<input type=\"text\" value='+fecha+' disabled>'+
                                                                '<span></span>'+
                                                                '<label class=\"negrita\">Fecha</label>'+
                                                            '</div>'+
                                                            '<div class=\"formu\">'+
                                                                '<input type=\"text\" value='+debe+' disabled>'+
                                                                '<span></span>'+
                                                                '<label class=\"negrita\">Deuda</label>'+
                                                            '</div>'
                                                            );
                                    $('#datos-deuda').addClass('marco-deuda');
                                    $('#datos-deuda').removeClass('ocultar');
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