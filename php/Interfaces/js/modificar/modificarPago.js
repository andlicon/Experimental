$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var idDeuda = $('#deuda'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var monto = $('#montoInput'+id).val();
    var cuenta = $('#tipoCuentaInput'+id).val();
    var tipoPago = $('#tipoPagoInput'+id).val();
    var referencia = $('#referenciaInput'+id).val();
    var valido = $('#estadoInput'+id).val().includes("por confirmar") ? 0 : 1;

    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;

    if(permiso==4) {
        $.ajax ( {
            url : '../../accion/modificar/ValidarPago.php',
            type : 'POST',
            data : {id: id, valido: valido},
            success : function(response) {
                    if(response) {
                        alert("Se ha validado el pago con éxito");
                    }
                    else {
                        alert("No se ha podido validar el pago.");
                    }
    
                    location.reload();
            }
        });
    }
    else {
        $.ajax ( {
            url : '../../accion/modificar/ModificarPago.php',
            type : 'POST',
            data : {id: id, idDeuda: idDeuda, fecha: fecha, 
                    monto: monto, referencia: referencia, cuenta: cuenta,
                    tipoPago: tipoPago, valido: valido},
            success : function(response) {
                    if(response) {
                        alert("Se ha modficiado el registro con éxito");
                    }
                    else {
                        alert("No se ha podido modificar el registro");
                    }
    
                    location.reload();
            }
        });
    }
    
    //Ocultar modificables
    $('.cancelar'+id).addClass("ocultar");
    $('.aceptar'+id).addClass("ocultar");
    $('.modificable'+id).prop('disabled', true);
    $('.modificable'+id).addClass('ocultar');
    $('.modificable--estado'+id).removeClass('ocultar');
});