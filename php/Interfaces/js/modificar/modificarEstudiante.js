$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var nombre = $('#nombreInput'+id).val();
    var apellido = $('#apellidoInput'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var clase = $('#claseInput'+id).val();
    var valido = $('#validoInput'+id).val();
    var lugarNacimiento = $('#lugarNacimientoInput'+id).val();

    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;

    //validación
    var mensaje = "";

    if(nombre.length > 15) {
        mensaje = "El nombre no puede superar los 15 carácteres";
    }
    else if(nombre == "") {
        mensaje = "El nombre no puede ser vacio";
    }
    else if(apellido.length > 15) {
        mensaje = "El apellido no puede superar los 15 carácteres";
    }
    else if(apellido == "") {
        mensaje = "El apellido no puede ser vacio";
    }
    else if(lugarNacimiento.length > 50) {
        mensaje = "Lugar de nacimiento no puede ser mayor de 50 caráceteres";
    }
    else if(lugarNacimiento == "") {
        mensaje = "Lugar de nacimiento no puede ser vacio";
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
        if(permiso==4 || permiso==5) {
            $.ajax ( {
                url : '../../accion/modificar/ModificarEstudianteAdmin.php',
                type : 'POST',
                data : {id: id, nombre: nombre, apellido: apellido, 
                        fecha: fecha, clase: clase, valido: valido,
                        lugarNacimiento: lugarNacimiento},
                success : function(response) {
                    if(response) {
                        //Modificar los inputs
                        $('#nombre'+id).val($('#nombreInput'+id).val());
                        $('#apellido'+id).val($('#apellidoInput'+id).val());
                        $('#lugarNacimiento'+id).val($('#lugarNacimientoInput'+id).val());
                        $('#fecha'+id).val($('#fechaInput'+id).val());
                        $('#validez'+id).html($('#validoInput'+id +' option:selected').text());
                        $('#clase'+id).html($('#claseInput'+id +' option:selected').text());

                        mensaje = "Se ha modificado el estudiante con éxito.";
                        clase = 'alerta--exito';
                    }
                    else {
                        mensaje = "No se ha podido modificar el estudiante.";
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
    }
});