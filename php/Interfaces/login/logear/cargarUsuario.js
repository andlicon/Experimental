$(document).on('click', '.boton[id*="botonRegistrar"]', function(){
    let valido = validarUsuario();

    if(valido) {
        //info de persona
        var nacionalidad = $('#nacionalidadInput').val();
        var cedula = $('#cedulaInput').val();
        var cedulaFinal = nacionalidad+cedula;
        var nombre = $('#nombreInput').val();
        var apellido = $('#apellidoInput').val();
        var direccionHogar = $('#direccionInput').val();
        var direccionTrabajo = $('#lugarTrabajoInput').val();

        //info contacto
        var correo = $('#correoInput').val();
        var telefono = $('#telefonoInput').val();
        //info usuario
        var nickname = $('#nicknameInput').val();
        var contrasena = $('#contrasenaInput').val();
        //info estudiantes
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
            dataType: 'json',
            data : {cedula: cedulaFinal, 
                    nombre: nombre, 
                    apellido: apellido, 
                    nickname: nickname, 
                    contrasena: contrasena, 
                    correo: correo, 
                    telefono: telefono,
                    direccionHogar: direccionHogar,
                    direccionTrabajo, direccionTrabajo,
                    nombresEstudiantes: nombresE, 
                    apellidosEstudiantes: apellidosE,
                    lugarNacimientosEstudiantes: lugarNacimientoE, 
                    fechaNacimientoEstudiantes: fechaNacimientoE},
            success : function(response) {
                var tipoRespuesta = response[0].tipo;
                var descripcionRespuesta = response[0].descripcion;
                var clase = tipoRespuesta == 'exito' ? 'alerta--exito' : 'alerta--error';

                $('.alerta').html(descripcionRespuesta);
                $('.alerta').addClass('alerta--mostrar');
                $('.alerta').addClass(clase);
                setTimeout(function() {
                    $('.alerta').removeClass('alerta--mostrar');
                    $('.alerta').removeClass(clase);
                }, 2000);
            }
         });
    }
});