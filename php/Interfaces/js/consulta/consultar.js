$(document).on('click','.boton',function(){
    let pagina = window.location.pathname;
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    let texto = $(this).val();

    $.ajax ( {
            url : '../../accion/consultar/Consultar.php',
            type : 'POST',
            data : {pagina: pagina, cedula: cedula, texto: texto},
            success : function(response) {
                    alert(response);
            }
    })
});