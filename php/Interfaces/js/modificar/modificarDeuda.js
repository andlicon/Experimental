$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var motivo = $('#motivoInput'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var descripcion = $('#descripcionInput'+id).val();
    var montoInicial = $('#montoInicialInput'+id).val();

    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;

    //Verificacion
    var mensaje = "";

    if(descripcion.length > 50) {
        mensaje = "Descripción no puede superar los 50 carácteres";
    }
    else if(descripcion == "") {
        mensaje = "Descripción no puede ser vacio";
    }
    if(montoInicial.length > 8) {
        mensaje = "Monto Inicial no puede superar los 50 carácteres";
    }
    else if(montoInicial == "") {
        mensaje = "Monto inicial no puede ser vacio";
    }

    if(mensaje!="") {
        $('.alerta').html(mensaje);
        $('.alerta').addClass('alerta--mostrar');
        $('.alerta').addClass('alerta--error');
        setTimeout(function() {
            $('.alerta').removeClass('alerta--mostrar');
            $('.alerta').removeClass('alerta--error');
        }, 2000);
        return false;
    }
    else {
        if(permiso==4) {
            $.ajax ( {
                url : '../../accion/modificar/ModificarDeuda.php',
                type : 'POST',
                data : {id: id, motivo: motivo, fecha: fecha, 
                    descripcion: descripcion, montoInicial: montoInicial},
                success : function(response) {
                    var mensaje = "";
                    var clase = "";

                    if(response) {
                        //Modificar los inputs
                        $('#motivo'+id).html($('#motivoInput'+id +' option:selected').text());
                        $('#descripcion'+id).val($('#descripcionInput'+id).val());
                        $('#fecha'+id).val($('#fechaInput'+id).val());
                        $('#montoInicial'+id).val($('#montoInicialInput'+id).val());
                        var monto = parseFloat($('#montoInicial'+id).val());
                        var estado = parseFloat($('#estado'+id).html());
                        $('#debe'+id).html(monto-estado);

                        //Mensaje
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