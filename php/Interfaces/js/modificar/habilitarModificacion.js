$(document).on('click', '.habilitarModif', function(){
    let pagina = window.location.pathname;
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    let texto = $(this).val();

    alert('a');
    
});