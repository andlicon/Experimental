$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var idDeuda = $('#deuda'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var monto = $('#montoInput'+id).val();
    var cuenta = $('#tipoCuentaInput'+id).val();
    var tipoPago = $('#tipoPagoInput'+id).val();
    var referencia = $('#referenciaInput'+id).val();
    var valido = $('#validoInput'+id).val();

    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;
    
    //VALIDACIÓN
    var mensaje = "";

    if(monto!= null && monto.length > 8) {
        mensaje = "El monto no puede superar los 8 carácteres";
    }
    else if(monto!= null && monto == "") {
        mensaje = "El monto no puede ser vacio";
    }
    else if(referencia!= null && referencia.length > 15) {
        mensaje = "La referencia no puede superar los 15 carácteres";
    }
    else if(referencia!= null && referencia == "") {
        mensaje = "La referencia no puede ser vacio";
    }
    
    if(mensaje!="") {
        $('.alerta').html(mensaje);
        $('.alerta').addClass('alerta--mostrar');
        $('.alerta').addClass('alerta--error');
        setTimeout(function() {
            $('.alerta').removeClass('alerta--mostrar');
            $('.alerta').removeClass('alerta--error');
        }, 2000);
    }
    else {
        if(permiso==4) {
            $.ajax ( {
                url : '../../accion/modificar/ValidarPago.php',
                type : 'POST',
                data : {id: id, valido: valido},
                success : function(response) {
                    if(response) {
                        //Modificar los inputs
                        $('#fecha'+id).val($('#fechaInput'+id).val());
                        $('#monto'+id).val($('#montoInput').val());
                        $('#referencia'+id).val($('#referenciaInput').val());
                        $('#tipoCuenta'+id).html($('#tipoCuentaInput'+id +' option:selected').text());
                        $('#tipoPago'+id).html($('#tipoPagoInput'+id +' option:selected').text());
                        $('#estadoInput'+id).val($('#validoInput'+id +' option:selected').text());

                        mensaje = "Se ha modificado la deuda con éxito.";
                        clase = 'alerta--exito';
                    }
                    else {
                        mensaje = "No se ha podido modificar la deuda.";
                        clase = 'alerta--error';
                    }

                    $('.alerta').html(mensaje);
                    $('.alerta').addClass('alerta--mostrar');
                    $('.alerta').addClass(clase);
                    setTimeout(function() {
                        $('.alerta').removeClass('alerta--mostrar');
                        $('.alerta').removeClass(clase);
                    }, 2000);
                }
            });
        }
        else {
            valido = 0;
            
            $.ajax ( {
                url : '../../accion/modificar/ModificarPago.php',
                type : 'POST',
                data : {id: id, idDeuda: idDeuda, fecha: fecha, 
                        monto: monto, referencia: referencia, cuenta: cuenta,
                        tipoPago: tipoPago, valido: valido},
                success : function(response) {
                    var mensaje = "";
                    var clase = "";

                    if(response) {
                        //Modificar los inputs
                        $('#fecha'+id).val($('#fechaInput'+id).val());
                        $('#monto'+id).val($('#montoInput'+id).val());
                        $('#referencia'+id).val($('#referenciaInput'+id).val());
                        $('#tipoCuenta'+id).html($('#tipoCuentaInput'+id +' option:selected').text());
                        $('#tipoPago'+id).html($('#tipoPagoInput'+id +' option:selected').text());
                        $('#estadoInput'+id).val($('#validoInput'+id +' option:selected').text());

                        mensaje = "Se ha modificado la deuda con éxito.";
                        clase = 'alerta--exito';
                    }
                    else {
                        mensaje = "No se ha podido modificar la deuda.";
                        clase = 'alerta--error';
                    }
    
                    $('.alerta').html(mensaje);
                    $('.alerta').addClass('alerta--mostrar');
                    $('.alerta').addClass(clase);
                    setTimeout(function() {
                        $('.alerta').removeClass('alerta--mostrar');
                        $('.alerta').removeClass(clase);
                    }, 2000);
                }
            });
        }

        //Ocultar modificables
        $('.cancelar'+id).addClass("ocultar");
        $('.aceptar'+id).addClass("ocultar");
        $('.modificable'+id).prop('disabled', true);
        $('.modificable'+id).addClass('ocultar');
        $('.modificable--estado'+id).removeClass('ocultar');
    }
});