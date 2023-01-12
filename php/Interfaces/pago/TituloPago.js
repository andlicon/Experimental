$(document).ready(function(){
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;

    $.ajax ( {
        url : 'crearTitulo.php',
        type : 'POST',
        data : {permiso: permiso},
        success : function(response) {
            $('.vista__titulo').html(response);
        }
})
})