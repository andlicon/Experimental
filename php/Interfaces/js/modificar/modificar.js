$(document).on('click', '.modificar', function(){
    let pagina = window.location.pathname;
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    let texto = $(this).val();

    alert('a');

    $.ajax ( {
            url : '../../accion/modificar/Modificar.php',
            type : 'POST',
            data : {pagina: pagina, cedula: cedula, texto: texto},
            async: false,
            success : function(response) {
                    alert('a');
            }
    })
});