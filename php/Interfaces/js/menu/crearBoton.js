$(document).ready(function () {
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    let permiso = usuario.permiso;
    let pagina = window.location.pathname;

    $.ajax ( {
        url : '../../accion/crearBoton/CrearBoton.php',
        type : 'POST',
        data : {permiso: permiso, pagina: pagina, cedula: cedula},
        success : function(response) {
                $('#botones').html(response);
        }
    })
});