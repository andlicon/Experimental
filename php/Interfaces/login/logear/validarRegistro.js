function validarUsuario() {
    if($('#cedulaInput').val() == "") {
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
    if($('#nicknameInput').val() == "") {
        alert("Se debe especificar un teléfono válido");
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

    return true;
}