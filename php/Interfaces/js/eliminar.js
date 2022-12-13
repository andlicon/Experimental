$(".eliminar").click(function() {
        let id = $(this).attr("id");
        let pagina = window.location.pathname;
        let usuario = localStorage.getItem('usuario');

        $.ajax ( {
                url : '../../accion/eliminar/Eliminar.php',
                type : 'POST',
                data : {id: id, pagina: pagina, usuario: usuario},
                success : function(response) {
                        window.location.href = response;
                }
        })
});