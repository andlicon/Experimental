$(document).on('click', '.boton--menu', function() {
    let pagina = $(this).attr('id');

    $.ajax ( {
            url : '../../accion/redireccion.php',
            type : 'POST',
            data : {pagina: pagina},
            success : function(response) {
                alert(response);
                $(location).attr('href', response)
            }
    })
});