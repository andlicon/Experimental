$(document).on('click', '.eliminar', function() {
        let id = $(this).attr("id");
        let pagina = window.location.pathname;
        let usuario = JSON.parse(localStorage.getItem('usuario'));
        let cedula = usuario.cedula;

        $.ajax ( {
                url : '../../accion/eliminar/Eliminar.php',
                type : 'POST',
                data : {id: id, pagina: pagina, cedula: cedula},
                success : function(response) {
                        alert(response);
                }
        })
});