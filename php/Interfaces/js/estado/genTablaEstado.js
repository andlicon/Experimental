$(function() { 
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    let nickname = usuario.nickname;

    $.ajax ( {
        url : 'tablaEstado.php',
        type : 'POST',
        data : {cedula: cedula, nickname: nickname},
        success : function(response) {
                $('#tablaEstado').html(response);
        }
    })
});