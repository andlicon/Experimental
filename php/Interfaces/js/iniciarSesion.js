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
                    localStorage.setItem('usuario', response);

                    window.location.replace('../inicio/view.php');
                }
            }
    })
});