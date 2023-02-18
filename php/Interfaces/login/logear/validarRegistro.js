function validarUsuario() {
    var mensaje = "";

    //U S U A R I O
    if($('#nicknameInput').val() == "")  {
        mensaje = "Nickname de representante no puede ser vacío";
        $('#nicknameInput').focus();
    }
    else if($('#nicknameInput').val().length < 6) {
        mensaje = "Nickname de representante debe contener al menos 6 carácteres.";
        $('#nicknameInput').focus();
    }
    else if($('#nicknameInput').val().length > 15) {
        mensaje = "Nickname de representante debe contener menos de 15 carácteres.";
        $('#nicknameInput').focus();
    }
    else if($('#contrasenaInput').val() == "") {
        mensaje = "Contraseña de representante no puede ser vacío";
        $('#contrasenaInput').focus();
    }
    else if($('#contrasenaInput').val().length < 4) {
        mensaje = "Contraseña de representante debe contener al menos 4 carácteres";
        $('#contrasenaInput').focus();
    }
    else if($('#contrasenaInput').val().length > 15) {
        mensaje = "Contraseña de representante debe contener menos de 15 carácteres.";
        $('#contrasenaInput').focus();
    }   //R E P R E S E N T A N T E
    else if($('#cedulaInput').val() == "") {
        mensaje = "Cédula de representante no puede ser vacío.";
        $('#cedulaInput').focus();
    }
    else if($('#cedulaInput').val().length > 8) {
        mensaje = "Cédula de representante no puede ser mayor de 8 carácteres.";
        $('#cedulaInput').focus();
    }
    else if($('#nombreInput').val() == "") {
        mensaje = "Nombre de representante no puede ser vacío";
    }
    else if($('#nombreInput').val().length > 15) {
        mensaje = "Nombre de representante no puede superar los 15 carácteres";
    }
    else if($('#apellidoInput').val() == "") {
        mensaje = "Apellido de representante no puede ser vacío";
        $('#apellidoInput').focus();
    }
    else if($('#direccionInput').val() == "") {
        mensaje = "Direccion de hogar no puede ser vacio";
        $('#direccionInput').focus();
    }
    else if($('#direccionInput').val().length > 50) {
        mensaje = "Dirección hogar no puede superar los 50 carácteres";
        $('#direccionInput').focus();
    }
    else if($('#lugarTrabajoInput').val() == "") {
        mensaje = "Dirección trabajo no puede ser vacio";
        $('#lugarTrabajoInput').focus();
    }
    else if($('#lugarTrabajoInput').val().length > 50) {
        mensaje = "Dirección trabajo no puede superar los 50 carácteres";
        $('#lugarTrabajoInput').focus();
    }   //C O N T A C T O
    else if($('#correoInput').val() == "") {
        mensaje = "Correo de representante no puede ser vacío.";
        $('#correoInput').focus();
    }
    else if($('#correoInput').val().match('[\w]+[@][a-zA-Z]+[\.].') != null) {
        mensaje = "Formato del correo incorrecto.";
        $('#correoInput').focus();
    }
    else if($('#telefonoInput').val() == "") {
        mensaje = "Teléfono de representante no puede ser vacío";
        $('#telefonoInput').focus();
    }
    else if($('#telefonoInput').val().length < 11) {
        mensaje = "Teléfono de representante debe contener 10 dígitos";
        $('#telefonoInput').focus();
    }
    else if($('#tipoPersonaSelect').val() == "") {
        mensaje = "Tipo usuario no puede ser vacío";
        $('#tipoPersonaSelect').focus();
    }
    else if($('#nombreInputEstudiante\\[\\]')) {
        let arregloNombre = $('#nombreInputEstudiante\\[\\]').toArray();
        if(arregloNombre) {
            for(let i=0; i<arregloNombre.length; i++) {
                if(arregloNombre[i].value == "") {
                    mensaje = "Nombre de alumno no puede ser vacío";
                }
            }
        }
    }
    else if($('#apellidoInputEstudiante\\[\\]')) {
        let arregloApellido = $('#apellidoInputEstudiante\\[\\]').toArray();
        if(arregloApellido) {
            for(let i=0; i<arregloApellido.length; i++) {
                if(arregloApellido[i].value == "") {
                    mensaje = "Apellido de alumno no puede ser vacío";
                }
            }
        }
    }
    else if($('#lugarNacimientoInputEstudiante\\[\\]')) {
        let arregloApellido = $('#lugarNacimientoInputEstudiante\\[\\]').toArray();
        if(arregloApellido) {
            for(let i=0; i<arregloApellido.length; i++) {
                if(arregloApellido[i].value == "") {
                    mensaje = "Lugar de nacimiento de alumno no puede ser vacío";
                }
            }
        }
    }
    else if($('#fechaNacimientoInputEstudiante\\[\\]')) {
        let arregloApellido = $('#fechaNacimientoInputEstudiante\\[\\]').toArray();
        if(arregloApellido) {
            for(let i=0; i<arregloApellido.length; i++) {
                if(arregloApellido[i].value == "") {
                    mensaje = "Fecha de nacimiento de alumno no puede ser vacío";
                }
            }
        }
    }

    if(mensaje=="") {
        return true;
    }
    else {
        $('.alerta').html(mensaje);
        $('.alerta').addClass('alerta--mostrar');
        $('.alerta').addClass('alerta--error');
        setTimeout(function() {
            $('.alerta').removeClass('alerta--mostrar');
            $('.alerta').removeClass('alerta--error');
        }, 2000);
        return false;
    } 
}