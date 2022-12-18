$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var idDeuda = $('#deuda'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var monto = $('#montoInput'+id).val();
    var cuenta = 1;
    var tipoPago = 1;
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
                    alert("Se ha modficiado el registro con éxito");
                    //Cambiar los inputs a los valores nuevos
                    $('#deuda'+id).attr("value", idDeuda);
                    $('#fecha'+id).attr("value", fecha);
                    $('#monto'+id).attr("value", monto);
                    $('#referencia'+id).attr("value", referencia);
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