$(document).on('click', '.boton[id*="botonRegistrar"]', function(){
    let valido = validarUsuario();
    if(valido) {
        var nacionalidad = $('#nacionalidadInput').val();
        var cedula = $('#cedulaInput').val();
        var cedulaFinal = nacionalidad+cedula;
        var nombre = $('#nombreInput').val();
        var apellido = $('#apellidoInput').val();
        var correo = $('#correoInput').val();
        var telefono = $('#telefonoInput').val();
        var nickname = $('#nicknameInput').val();
        var contrasena = $('#contrasenaInput').val();
        var tipoPersona = $('#tipoPersonaSelect').val();

        $.ajax ( {
            url : '../../accion/cargar/CargarUsuario.php',
            type : 'POST',
            data : {cedula: cedulaFinal, nombre: nombre, apellido: apellido, 
                nickname: nickname, contrasena: contrasena, 
                tipoPersona: tipoPersona, correo: correo, telefono: telefono},
            success : function(response) {
                alert(response);
            }
         });
    }
});