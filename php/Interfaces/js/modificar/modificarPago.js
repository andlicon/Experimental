$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var fecha = $('#fechaInput'+id).val();
    var monto = $('#montoInput'+id).val();
    var referencia = $('#referenciaInput'+id).val();

    //Enviar la informacion a php
    $.ajax ( {
        url : '../../accion/modificar/ModificarPago.php',
        type : 'POST',
        data : {id: id, fecha: fecha, monto: monto, referencia: referencia},
        success : function(response) {
                console.log(response);
        }
    });
    //Ocultar modificables
    $('.cancelar'+id).addClass("ocultar");
    $('.aceptar'+id).addClass("ocultar");
    $('.modificable'+id).prop('disabled', true);
    $('.modificable'+id).addClass('ocultar');
    $('.modificable--estado'+id).removeClass('ocultar');
});