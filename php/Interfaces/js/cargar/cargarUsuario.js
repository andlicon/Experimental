$(document).on('click', '#botonRegistrar', function(){
    //datos
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

    alert("cedula: " + cedulaFinal + "\n" +
    "nombre: " + nombre + "\n" +
    "apellido: " + apellido + "\n" +
    "correo: " + correo + "\n" +
    "telefono: " + telefono + "\n" + 
    "nickname: " + nickname + "\n" +
    "correo: " + correo + "\n" +
    "contrasena: " + contrasena + "\n" + 
    "tipo Persona: " + tipoPersona);

    //Enviar la informacion a php
    if(seguir) {
        $.ajax ( {
            url : '../../accion/cargar/CargarJs.php',
            type : 'POST',
            data : {nacionalidad: nacionalidad, cedula: cedulaFinal,
                nombre: nombre, apellido: apellido, correo: correo, 
                nickname: nickname, contrasena: contrasena, 
                tipoPersona: tipoPersona, telefono: telefono},
            success : function(response) {
                alert(response);
                location.reload();
            }
        });
    }
});