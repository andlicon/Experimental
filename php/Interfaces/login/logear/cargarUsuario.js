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
        var nombresEstudiantes = $('#nombreInputEstudiante\\[\\]').toArray();
        var apellidosEstudiantes = $('#apellidoInputEstudiante\\[\\]').toArray();
        var lugarNacimientosEstudiantes = $('#lugarNacimientoInputEstudiante\\[\\]').toArray();
        var fechaNacimientoEstudiantes = $('#fechaNacimientoInputEstudiante\\[\\]').toArray();

        var nombresE = [];
        var apellidosE = [];
        var lugarNacimientoE = [];
        var fechaNacimientoE = [];

        for(let i=0; i<nombresEstudiantes.length; i++) {
            nombresE.push(nombresEstudiantes[i].value);
            apellidosE.push(apellidosEstudiantes[i].value);
            lugarNacimientoE.push(lugarNacimientosEstudiantes[i].value);
            fechaNacimientoE.push(fechaNacimientoEstudiantes[i].value);
        }

        $.ajax ( {
            url : '../../accion/cargar/CargarUsuario.php',
            type : 'POST',
            data : {cedula: cedulaFinal, nombre: nombre, apellido: apellido, 
                nickname: nickname, contrasena: contrasena, 
                correo: correo, telefono: telefono,
                nombresEstudiantes: nombresE, 
                apellidosEstudiantes: apellidosE,
                lugarNacimientosEstudiantes: lugarNacimientoE, 
                fechaNacimientoEstudiantes: fechaNacimientoE},
            success : function(response) {
                alert(response);
            }
         });
    }
});