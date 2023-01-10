$(document).ready(function () {
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;
    let cedula = usuario.cedula;
    let pagina = window.location.pathname;

    $.ajax ( {
        url : '../../accion/componentes/creadores/input/CrearInputJs.php',
        type : 'POST',
        data : {permiso: permiso, pagina: pagina, cedula: cedula},
        success : function(response) {
            $('#input').html(response);
        }
    })
});