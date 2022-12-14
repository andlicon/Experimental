$(document).ready(function () {
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;

    $.ajax ( {
        url : '../../accion/crearBoton/CrearBoton.php',
        type : 'POST',
        data : {permiso: permiso, pagina: "menu"},
        success : function(response) {
                $('#menu').html(response);
        }
    })
});