$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var idDeuda = $('#deuda'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var monto = $('#montoInput'+id).val();
    var cuenta = $('#tipoCuentaInput'+id).val();
    var tipoPago = $('#tipoPagoInput'+id).val();
    var referencia = $('#referenciaInput'+id).val();
    var valido = 0;

    //Enviar la informacion a php
    $.ajax ( {
        url : '../../accion/modificar/ModificarPago.php',
        type : 'POST',
        data : {id: id, idDeuda: idDeuda, fecha: fecha, 
                monto: monto, referencia: referencia, cuenta: cuenta,
                tipoPago: tipoPago, valido: valido},
        success : function(response) {
                if(response) {
                    $('#consultar-rep').click();
                    alert("Se ha modficiado el registro con éxito");
                }
                else {
                    alert("No se ha podido modificar el registro");
                }
        }
    });
    //Ocultar modificables
    $('.cancelar'+id).addClass("ocultar");
    $('.aceptar'+id).addClass("ocultar");
    $('.modificable'+id).prop('disabled', true);
    $('.modificable'+id).addClass('ocultar');
    $('.modificable--estado'+id).removeClass('ocultar');
});