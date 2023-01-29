$(document).on('click', '.boton[id*="enviar"]', function(){
    var valido;
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    var correo = $('#correo-input').val();
    var telefono = $('#telefono-input').val();
    var nickname = $('#nickname-input').val();
    var nombre = $('#nombre-input').val();
    var apellido = $('#apellido-input').val();
    var contrasena = $('#contrasena1-input').val();
    var contrasenaSegunda = $('#contrasena2-input').val();

    $.ajax ( {
        url : 'php/isDatosRepetidos.php',
        type : 'POST',
        data : {cedula: cedula, correo: correo, telefono: telefono, 
            nickname: nickname, contrasena: contrasena, 
            contrasenaDos: contrasenaSegunda},
        success : function(response) {
            valido = response == 1 ? true : false;

            if(valido) {
                $.ajax ( {
                    url : 'php/ModificiarUsuario.php',
                    type : 'POST',
                    data : {cedula: cedula, correo: correo, telefono: telefono, 
                        nickname: nickname, nombre: nombre, apellido: apellido,
                        contrasena: contrasena},
                    success : function(response) {
                        alert(response);
                        windows.reload();
                    }
                });
            }
        }
    });
});