$(document).on('click', '#iniciarSesion', function() {
    let nickname = $("#nicknameEntrar").val();
    let contrasena = $("#contrasenaEntrar").val();
    $.ajax ( {
            url : '../../accion/login/iniciarSesion.php',
            type : 'POST',
            data : {nickname: nickname, contrasena: contrasena},
            success : function(response) {
                let respuesta = JSON.parse(response);

                if(respuesta.hasOwnProperty('error')) {
                    alert(respuesta.error);
                }
                else {
                    let jsonString = '{"cedula":' + respuesta.cedula + 
                                       ',"nickname:"' + respuesta.nickname +
                                       ',"valido:"' + respuesta.valido +
                                       ',"permiso:"' + respuesta.permiso;
                    localStorage.setItem('usuario', jsonString);

                    
                }
            }
    })
});