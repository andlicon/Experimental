$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var nombre = $('#nombreInput'+id).val();
    var apellido = $('#apellidoInput'+id).val();
    var direccionTrabajo = $('#direccionTrabajoInput'+id).val();
    var direccionHogar = $('#direccionHogarInput'+id).val();
    var tipoUsuario = $('#tipoUsuarioInput'+id).val();
    var valido = $('#validoInput'+id).val();

    //VALIDACIÓN
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
    else if(direccionTrabajo.length > 50) {
        mensaje = "El direccion trabajo no puede superar los 50 carácteres";
    }
    else if(direccionTrabajo == "") {
        mensaje = "El direccion trabajo no puede ser vacio";
    }
    else if(direccionHogar.length > 50) {
        mensaje = "El direccion hogar no puede superar los 50 carácteres";
    }
    else if(direccionHogar == "") {
        mensaje = "El direccion hogar no puede ser vacio";
    }

    if(mensaje != "") {
        $('.alerta').html(mensaje);
        $('.alerta').addClass('alerta--mostrar');
        $('.alerta').addClass('alerta--error');
        setTimeout(function() {
            $('.alerta').removeClass('alerta--mostrar');
            $('.alerta').removeClass('alerta--error');
        }, 2000);
    }
    else {
        $.ajax ( {
            url : '../../accion/modificar/ModificarUsuarioAdmin.php',
            type : 'POST',
            data : {id: id,
                    nombre: nombre,
                    apellido: apellido,
                    direccionTrabajo: direccionTrabajo,
                    direccionHogar: direccionHogar,
                    tipoUsuario: tipoUsuario,
                    valido: valido},
            success : function(response) {
                alert(response);
                if(response) {
                    mensaje = "Se ha modificado el usuario con éxito.";
                    clase = 'alerta--exito';
                }
                else {
                    mensaje = "No se ha podido modificar al usuario.";
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

         //Ocultar modificables
        $('.cancelar'+id).addClass("ocultar");
        $('.aceptar'+id).addClass("ocultar");
        $('.modificable'+id).prop('disabled', true);
        $('.modificable'+id).addClass('ocultar');
        $('.modificable--estado'+id).removeClass('ocultar');
    }
});