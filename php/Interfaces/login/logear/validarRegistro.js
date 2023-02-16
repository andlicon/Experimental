function validarUsuario() {
    var mensaje = "";

    if($('#cedulaInput').val() == "") {
        // $('.alerta').html('Se debe especificar una cédula válida');
        // $('#cedulaInput').focus();
        // $('.alerta').classList.add('alerta--mostrar');
        alert("Se debe especificar una cedula válida");
        $('#cedulaInput').focus();
        return false;
    }
    if($('#nombreInput').val() == "") {
        alert("Se debe especificar un nombre válido");
        $('#nombreInput').focus();
        return false;
    }
    if($('#apellidoInput').val() == "") {
        alert("Se debe especificar un apellido válido");
        $('#apellidoInput').focus();
        return false;
    }
    if($('#correoInput').val() == "") {
        alert("Se debe especificar un correo válido");
        $('#correoInput').focus();
        return false;
    }
    if($('#telefonoInput').val() == "") {
        alert("Se debe especificar un teléfono válido");
        $('#telefonoInput').focus();
        return false;
    }
    if($('#nicknameInput').val() == "" || $('#nicknameInput').val().length < 6)  {
        alert("Se debe especificar un nickname válido");
        $('#nicknameInput').focus();
        return false;
    }
    if($('#contrasenaInput').val() == "") {
        alert("Se debe especificar una contraseña válida");
        $('#contrasenaInput').focus();
        return false;
    }
    if($('#tipoPersonaSelect').val() == "") {
        alert("Se debe especificar un tipo usuario válido");
        $('#tipoPersonaSelect').focus();
        return false;
    }
    if($('#nombreInputEstudiante\\[\\]')) {
        let arregloNombre = $('#nombreInputEstudiante\\[\\]').toArray();
        if(arregloNombre) {
            for(let i=0; i<arregloNombre.length; i++) {
                if(arregloNombre[i].value == "") {
                    alert("Se debe especificar un nombre de alumno valido.");
                    return false;
                }
            }
        }
    }
    if($('#apellidoInputEstudiante\\[\\]')) {
        let arregloApellido = $('#apellidoInputEstudiante\\[\\]').toArray();
        if(arregloApellido) {
            for(let i=0; i<arregloApellido.length; i++) {
                if(arregloApellido[i].value == "") {
                    alert("Se debe especificar un apellido de alumno valido.");
                    return false;
                }
            }
        }
    }
    if($('#lugarNacimientoInputEstudiante\\[\\]')) {
        let arregloApellido = $('#lugarNacimientoInputEstudiante\\[\\]').toArray();
        if(arregloApellido) {
            for(let i=0; i<arregloApellido.length; i++) {
                if(arregloApellido[i].value == "") {
                    alert("Se debe especificar un lugar nacimiento de alumno valido.");
                    return false;
                }
            }
        }
    }
    if($('#fechaNacimientoInputEstudiante\\[\\]')) {
        let arregloApellido = $('#fechaNacimientoInputEstudiante\\[\\]').toArray();
        if(arregloApellido) {
            for(let i=0; i<arregloApellido.length; i++) {
                if(arregloApellido[i].value == "") {
                    alert("Se debe especificar un fecha nacimiento de alumno valido.");
                    return false;
                }
            }
        }
    }

    return true;
}